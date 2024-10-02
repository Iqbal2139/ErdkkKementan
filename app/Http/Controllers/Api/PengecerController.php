<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Models\Retailer;
use Carbon\Carbon;

class PengecerController extends Controller
{
    public function index(Request $request)
    {
        $data = Retailer::join('areas', 'retailers.sub_district_code', '=', 'areas.sub_district_code')
                            ->select
                            (
                                'retailers.id',
                                'retailers.pihc_code',
                                'retailers.name',
                                'areas.sub_district_code',
                                'areas.sub_district',
                                'areas.district_code',
                                'areas.district',
                                'areas.city',
                                'areas.province'
                            );

        if (!is_null(districtCode())) $data->where('areas.district_code', districtCode());

        $search = $request->input('search')['value'] ?? null;
        $limit          = $request->get('length');
        $offset         = $request->get('start');
        $subdistrict      = $request->get('subdistrict');
        $result["draw"] = $request->get('draw');
        $currentDate    = Carbon::now();

        if (!empty($subdistrict)) {
            $data->where('areas.sub_district_code', $subdistrict);
        }

        if (!empty($search)) {
            $data->where(function($query) use ($search) {
                $query->where('retailers.pihc_code', 'LIKE', '%' . $search . '%')
                    ->orWhere('retailers.name', 'LIKE', '%' . $search . '%')
                    ->orWhere('areas.sub_district', 'LIKE', '%' . $search . '%')
                    ->orWhere('areas.district', 'LIKE', '%' . $search . '%')
                    ->orWhere('areas.city', 'LIKE', '%' . $search . '%')
                    ->orWhere('areas.province', 'LIKE', '%' . $search . '%');
            });
        }

        $result["recordsFiltered"] = $data->count();

        if (isset($limit) && null != $limit) {
            $data->limit($limit);
        }

        if (isset($offset) && null != $offset) {
            $data->offset($offset);
        }

        $total = Retailer::join('areas', 'retailers.sub_district_code', '=', 'areas.sub_district_code');

        $result["data"] = $data->orderBy('retailers.id', 'desc')->get();

        if (!is_null(districtCode())) $total->where('areas.district_code', districtCode());
        $result["recordsTotal"] = $total->count();

        echo json_encode($result);
    }

    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'pihc_code' => 'required|string|max:50',
                'sub_district_code' => 'required|string|max:50',
                'is_active' => 'required|in:1,2',
            ]);

            $retailer = new Retailer;
            $retailer->name = $validatedData['name'];
            $retailer->pihc_code = $validatedData['pihc_code'];
            $retailer->sub_district_code = $validatedData['sub_district_code'];
            $retailer->is_active = $validatedData['is_active'];

            $retailer->save();

            return response()->json([
                'status' => 200,
                'message' => 'Retailer berhasil ditambahkan',
                'data' => $retailer
            ], 200);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'status' => 400,
                'message' => 'Validasi gagal',
                'errors' => $e->errors()
            ], 400);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => 'Terjadi kesalahan saat menyimpan data',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function show($id)
    {
        try {
            $retailer = Retailer::select(
                    'id',
                    'pihc_code',
                    'name',
                    'sub_district_code',
                    'is_active'
                )
                ->where('id', $id)
                ->first();

            if (!$retailer) {
                return response()->json(['status' => 404, 'message' => 'Retailer not found'], 404);
            }

            return response()->json(['status' => 200, 'data' => $retailer], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => 500, 'message' => 'Internal Server Error', 'error' => $e->getMessage()], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'pihc_code' => 'required|string|max:50',
                'sub_district_code' => 'required|string|max:50',
                'is_active' => 'required|in:1,2',
            ]);

            $retailer = Retailer::find($id);
            if (!$retailer) {
                return response()->json([
                    'status' => 404,
                    'message' => 'Retailer tidak ditemukan',
                ], 404);
            }

            $retailer->name = $validatedData['name'];
            $retailer->pihc_code = $validatedData['pihc_code'];
            $retailer->sub_district_code = $validatedData['sub_district_code'];
            $retailer->is_active = $validatedData['is_active'];

            $retailer->save();

            return response()->json([
                'status' => 200,
                'message' => 'Retailer berhasil diperbarui',
                'data' => $retailer
            ], 200);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'status' => 400,
                'message' => 'Validasi gagal',
                'errors' => $e->errors()
            ], 400);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => 'Terjadi kesalahan saat memperbarui data',
                'error' => $e->getMessage()
            ], 500);
        }
    }

}

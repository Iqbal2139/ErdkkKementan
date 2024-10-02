<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Area;

class WilayahController extends Controller
{
    public function index(Request $request)
    {
        $data = Area::select("*")->latest()->distinct();

        $search = $request->input('search')['value'] ?? null;
        $limit = $request->get('length');
        $offset = $request->get('start');
        $city_code = $request->get('city_code');
        $province_code = $request->get('province_code');
        $district_code = $request->get('district_code');
        $result["draw"] = $request->get('draw');

        if (!empty($province_code)) {
            $data->where('province_code', $province_code);
        }

        if (!empty($city_code)) {
            $data->where('city_code', $city_code);
        }

        if (!empty($district_code)) {
            $data->where('district_code', $district_code);
        }

        if (!empty($search)) {
            $data->where(function ($query) use ($search) {
                $query->where('sub_district', 'LIKE', '%' . $search . '%')
                    ->orWhere('district', 'LIKE', '%' . $search . '%')
                    ->orWhere('city', 'LIKE', '%' . $search . '%')
                    ->orWhere('province', 'LIKE', '%' . $search . '%');
            });
        }

        $result["recordsFiltered"] = $data->count();

        if (isset($limit) && null != $limit) {
            $data->limit($limit);
        }

        if (isset($offset) && null != $offset) {
            $data->offset($offset);
        }

        $total = Area::query();
        $result["recordsTotal"] = $total->count();

        $result["data"] = $data->get();

        return response()->json($result);
    }

    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'thn' => 'required|string|max:4',
                'sub_district_code' => 'required|string|max:10',
                'sub_district' => 'required|string|max:255',
                'district_code' => 'required|string|max:6',
                'district' => 'required|string|max:255',
                'city_code' => 'required|string|max:4',
                'city' => 'required|string|max:255',
                'province_code' => 'required|string|max:50',
                'province' => 'required|string|max:255',
            ]);

            $area = new Area();
            $area->thn = $validatedData['thn'];
            $area->sub_district_code = $validatedData['sub_district_code'];
            $area->sub_district = $validatedData['sub_district'];
            $area->district_code = $validatedData['district_code'];
            $area->district = $validatedData['district'];
            $area->city_code = $validatedData['city_code'];
            $area->city = $validatedData['city'];
            $area->province_code = $validatedData['province_code'];
            $area->province = $validatedData['province'];

            $area->save();

            return response()->json([
                'status' => 200,
                'message' => 'Wilayah berhasil ditambahkan',
                'data' => $area,
            ], 200);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'status' => 400,
                'message' => 'Validasi gagal',
                'errors' => $e->errors(),
            ], 400);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => 'Terjadi kesalahan saat menyimpan data',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function show($id)
    {
        $area = Area::find($id);

        if (!$area) {
            return response()->json([
                'status' => 404,
                'message' => 'Wilayah tidak ditemukan',
            ], 404);
        }

        return response()->json([
            'status' => 200,
            'data' => $area,
        ], 200);
    }

    public function update(Request $request, $id)
    {
        try {
            $validatedData = $request->validate([
                'thn' => 'required|string|max:4',
                'sub_district_code' => 'required|string|max:50',
                'sub_district' => 'required|string|max:255',
                'district_code' => 'required|string|max:50',
                'district' => 'required|string|max:255',
                'city_code' => 'required|string|max:50',
                'city' => 'required|string|max:255',
                'province_code' => 'required|string|max:50',
                'province' => 'required|string|max:255',
            ]);

            $area = Area::find($id);

            if (!$area) {
                return response()->json([
                    'status' => 404,
                    'message' => 'Wilayah tidak ditemukan',
                ], 404);
            }

            $area->thn = $validatedData['thn'];
            $area->sub_district_code = $validatedData['sub_district_code'];
            $area->sub_district = $validatedData['sub_district'];
            $area->district_code = $validatedData['district_code'];
            $area->district = $validatedData['district'];
            $area->city_code = $validatedData['city_code'];
            $area->city = $validatedData['city'];
            $area->province_code = $validatedData['province_code'];
            $area->province = $validatedData['province'];

            $area->save();

            return response()->json([
                'status' => 200,
                'message' => 'Wilayah berhasil diupdate',
                'data' => $area,
            ], 200);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'status' => 400,
                'message' => 'Validasi gagal',
                'errors' => $e->errors(),
            ], 400);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => 'Terjadi kesalahan saat memperbarui data',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}

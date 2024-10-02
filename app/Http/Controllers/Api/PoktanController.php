<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Models\FarmerGroup;
use Carbon\Carbon;

class PoktanController extends Controller
{
    public function index(Request $request)
    {
        $data = FarmerGroup::join('areas', 'farmer_groups.sub_district_code', '=', 'areas.sub_district_code')
                            ->select(
                                'farmer_groups.id',
                                'farmer_groups.name',
                                'areas.sub_district_code',
                                'areas.province',
                                'areas.city',
                                'areas.district',
                                'areas.sub_district'
                            );

        if (!is_null(districtCode())) {
            $data->where('areas.district_code', districtCode());
        }

        $search         = $request->input('search')['value'] ?? null;
        $limit          = $request->get('length');
        $offset         = $request->get('start');
        $subdistrict    = $request->get('subdistrict');
        $result["draw"] = $request->get('draw');

        if (!empty($subdistrict)) {
            $data->where('areas.sub_district_code', $subdistrict);
        }

        if (!empty($search)) {
            $data->where(function($query) use ($search) {
                $query->where('farmer_groups.name', 'LIKE', '%' . $search . '%')
                    ->orWhere('areas.sub_district', 'LIKE', '%' . $search . '%')
                    ->orWhere('areas.district', 'LIKE', '%' . $search . '%')
                    ->orWhere('areas.city', 'LIKE', '%' . $search . '%')
                    ->orWhere('areas.province', 'LIKE', '%' . $search . '%');
            });
        }

        $result["recordsFiltered"] = $data->count();

        if (isset($limit) && $limit !== null) {
            $data->limit($limit);
        }

        if (isset($offset) && $offset !== null) {
            $data->offset($offset);
        }

        $result["data"] = $data->orderBy('farmer_groups.id', 'desc')->get();

        $total = FarmerGroup::join('areas', 'farmer_groups.sub_district_code', '=', 'areas.sub_district_code');

        if (!is_null(districtCode())) {
            $total->where('areas.district_code', districtCode());
        }

        $result["recordsTotal"] = $total->count();

        return response()->json($result);
    }

}

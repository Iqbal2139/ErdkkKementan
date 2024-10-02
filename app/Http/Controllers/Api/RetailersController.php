<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Retailer;

class RetailersController extends Controller
{
    public function index(Request $request){
        $data = Retailer::join('areas', 'retailers.sub_district_code','=','areas.sub_district_code')
                ->where('areas.sub_district_code', districtCode())->limit(10);

        $search = $request->get('search');
        $limit = $request->get('length');
        $offset = $request->get('start');
        $isActive = $request->get('is_active');

        if (isset($isActive) && null != $isActive) {
            $data->where('is_active', $isActive);
        }

        if (isset($search) && null != $search){
            $data->where('areas.sub_district_code', 'like', '%' .$request->get('search'). '%');
        }

        $areasCount = $data->count('areas.sub_district_code');

        if (isset($limit) && null != $limit) {
            $data->limit($limit);
        }

        if (isset($offset) && null != $offset) {
            $data->offset($offset);
        }

        $areas = $data->orderBy('areas.sub_district_code','ASC')->get();

        if (count($areas) < 0) {
            $respon ['message'] = [
                'responseMessage' => ' Success! ',
                'data' => $areas,
                'recordsTotal' => $areasCount,
                'recordsFiltered' => $areasCount,
                'status' => 200
            ];

            return response()->json($areas);

        }else{
            $respon ['message'] = [
                'responseMessage' => ' Data Tidak Ditemukan! ',
                'status' => 404
            ];

            return response()->json($respon);
        }

    }
}

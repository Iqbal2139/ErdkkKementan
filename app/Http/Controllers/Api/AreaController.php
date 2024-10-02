<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Area;

class AreaController extends Controller
{
    public function index(Request $request){
        $search = $request->get('search');
        $limit = $request->get('length');
        $offset = $request->get('start');

        $data = Area::select('province_code', 'province', 'district_code','sub_district_code','sub_district')
            ->distinct()
            ->where('sub_district_code', districtCode())
            ->paginate(10);

        if (count($search) > 1){
            $data->whereRaw("lower(sub_district) like ?", '%'.strtolower($search['term']).'%');
        }

        $areasCount = $data->count('sub_district_code');

        if (isset($limit) && null != $limit) {
            $data->limit($limit);
        }

        if (isset($offset) && null != $offset) {
            $data->offset($offset);
        }

        $areas = $data->orderBy('sub_district_code','ASC')->get();

        return $this->generateResponse($areas, $areasCount);
    }

    public function filterProvince(Request $request) {
        $search = $request->get('search', []);
        $limit = $request->get('length');
        $offset = $request->get('start');

        $data = Area::select('province_code', 'province')
            ->distinct();

        if (is_array($search) && array_key_exists('term', $search) && !empty($search['term'])) {
            $data->whereRaw("lower(province) like ?", '%' . strtolower($search['term']) . '%');
        }

        return $this->getFilteredAreas($data, $limit, $offset, 'province_code');
    }

    public function filterCity(Request $request) {
        $search = $request->get('search', []);
        $limit = $request->get('length');
        $offset = $request->get('start');
        $province_code = $request->get('province_code');

        $data = Area::select('city_code', 'city')
            ->distinct();

        if (!empty($province_code)) {
            $data->where('province_code', $province_code);
        }

        if (is_array($search) && array_key_exists('term', $search) && !empty($search['term'])) {
            $data->whereRaw("lower(city) like ?", '%' . strtolower($search['term']) . '%');
        }

        return $this->getFilteredAreas($data, $limit, $offset, 'city_code');
    }

    public function filterDistrict(Request $request)
    {
        $search = $request->get('search', []);
        $limit = $request->get('length');
        $offset = $request->get('start');
        $city_code = $request->get('city_code');
        $province_code = $request->get('province_code');

        $data = Area::select('district_code', 'district')
            ->distinct();

        if (!empty($city_code)) {
            $data->where('city_code', $city_code);
        }

        if (!empty($province_code)) {
            $data->where('province_code', $province_code);
        }

        if (is_array($search) && array_key_exists('term', $search) && !empty($search['term'])) {
            $data->whereRaw("lower(district) like ?", '%' . strtolower($search['term']) . '%');
        }

        return $this->getFilteredAreas($data, $limit, $offset, 'district_code');
    }

    public function filterSubDistrict(Request $request)
    {
        $search = $request->get('search', []);
        $limit = $request->get('length');
        $offset = $request->get('start');

        $data = Area::select(DB::raw('MIN(sub_district_code) as sub_district_code'), 'sub_district')
        ->groupBy('sub_district');


        if (is_array($search) && array_key_exists('term', $search) && !empty($search['term'])) {
            $data->whereRaw("lower(sub_district) like ?", '%' . strtolower($search['term']) . '%');
        }

        return $this->getFilteredAreas($data, $limit, $offset, 'sub_district_code');
    }

    private function getFilteredAreas($data, $limit, $offset, $field)
    {
        $areasCount = $data->count();

        if (isset($limit) && $limit != null) {
            $data->limit($limit);
        }

        if (isset($offset) && $offset != null) {
            $data->offset($offset);
        }

        $areas = $data->orderBy($field, 'ASC')->get();


        return $this->generateResponse($areas, $areasCount);
    }

    private function generateResponse($areas, $areasCount)
    {
        if ($areas->count() > 0) {
            $response = [
                'responseMessage' => 'Success!',
                'data' => $areas,
                'recordsTotal' => $areasCount,
                'recordsFiltered' => $areasCount,
                'status' => 200,
            ];
            return response()->json($response);
        } else {
            $response = [
                'responseMessage' => 'Data Tidak Ditemukan!',
                'status' => 400,
            ];
            return response()->json($response);
        }
    }
}

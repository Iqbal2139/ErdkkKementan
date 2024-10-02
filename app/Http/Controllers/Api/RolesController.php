<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Roles;

class RolesController extends Controller
{
    public function index(Request $request){
        $search = $request->get('search');
        $limit = $request->get('length');
        $offset = $request->get('start');
        $result["draw"] = $request->get('draw');

        $data = Roles::select('users.id', 'users.username', 'users.name', 'areas.province', 'areas.city', 'areas.district', 'roles.name as roleName')
        ->distinct()
        ->join('roles', 'roles.id', '=', 'users.role_id')
        ->leftJoin('areas', function($join) {
            $join->on('users.province_code', 'areas.province_code');
            $join->on('users.city_code', 'areas.city_code');
            $join->on('users.district_code', 'areas.district_code');
        });

        if (count($search) > 1){
            // $data->whereRaw("lower(sub_district) like ?", '%'.strtolower($search['term']).'%');
        }

        $data->groupBy('users.id', 'users.username', 'users.name', 'areas.province', 'areas.city', 'areas.district', 'roles.name');
        $result['recordsFiltered'] = $data->count();

        if (isset($limit) && null != $limit) {
            $data->limit($limit);
        }

        if (isset($offset) && null != $offset) {
            $data->offset($offset);
        }

        $result["data"] = $data->get();

        $total = Roles::select('users.id', 'users.username', 'users.name', 'areas.province', 'areas.city', 'areas.district', 'roles.name as roleName')
        ->distinct()
        ->join('roles', 'roles.id', '=', 'users.role_id')
        ->leftJoin('areas', function($join) {
            $join->on('users.province_code', 'areas.province_code');
            $join->on('users.city_code', 'areas.city_code');
            $join->on('users.district_code', 'areas.district_code');
        })
        ->groupBy('users.id', 'users.username', 'users.name', 'areas.province', 'areas.city', 'areas.district', 'roles.name')
        ->get();
        $result["recordsTotal"] = count($total);

        if (is_null($search['value'])) {
            $result['recordsFiltered'] = count($total);
        }

        return response()->json($result);
    }

    public function store(Request $request) {
        $res = [
            'status' => 200,
            'message' => 'Berhasil tambah user'
        ];

        return response()->json($res);
    }

    public function getData() {
        $data = Roles::get();

        $res = [
            'status' => 200,
            'message' => 'Berhasil load data',
            'data' => $data
        ];

        return response()->json($res);
    }

    public function getDataById(Request $request) {
        $data = Roles::where('id', $request->get('id'))
        ->first();

        $res = [
            'status' => 200,
            'message' => 'Berhasil load data',
            'data' => $data
        ];

        return response()->json($res);
    }
}

<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index(Request $request){
        $search = $request->get('search');
        $limit = $request->get('length');
        $offset = $request->get('start');
        $result["draw"] = $request->get('draw');

        $data = User::select('users.id', 'users.username', 'users.name', 'province_code as province', 'city_code as city', 'district_code as district', 'roles.name as roleName')
        // $data = User::select('users.id', 'users.username', 'users.name', 'p.province', 'c.city', 'd.district', 'roles.name as roleName')
        ->distinct()
        ->join('roles', 'roles.id', '=', 'users.role_id');
        // ->leftJoin('areas as p', 'users.province_code', '=', 'p.province_code')
        // ->leftJoin('areas as c', function($join) {
        //     $join->on('users.province_code', 'c.province_code');
        //     $join->on('users.city_code', 'c.city_code');
        // })
        // ->leftJoin('areas as d', function($join) {
        //     $join->on('users.province_code', 'd.province_code');
        //     $join->on('users.city_code', 'd.city_code');
        //     $join->on('users.district_code', 'd.district_code');
        // });

        if (count($search) > 1){
            // $data->whereRaw("lower(sub_district) like ?", '%'.strtolower($search['term']).'%');
        }

        $data->groupBy('users.id', 'users.username', 'users.name', 'province_code', 'city_code', 'district_code', 'roles.name');
        // $data->groupBy('users.id', 'users.username', 'users.name', 'p.province', 'c.city', 'd.district', 'roles.name');
        $result['recordsFiltered'] = $data->count();

        if (isset($limit) && null != $limit) {
            $data->limit($limit);
        }

        if (isset($offset) && null != $offset) {
            $data->offset($offset);
        }

        $result["data"] = $data->get();

        // $total = User::select('users.id', 'users.username', 'users.name', 'd.province', 'd.city', 'd.district', 'roles.name as roleName')
        $total = User::select('id')
        ->count();
        $result["recordsTotal"] = $total;

        if (is_null($search['value'])) {
            $result['recordsFiltered'] = $total;
        }

        return response()->json($result);
    }

    public function store(Request $request) {
        try {
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'username' => 'required|string|max:80',
                'password' => 'required|string',
                'role_id' => 'required|integer|exists:roles,id',
                'province_code' => 'required|string|max:2',
                'city_code' => 'required|string|max:4',
                'district_code' => 'required|string|max:6',
            ]);


            $user = new User;
            $user->name = $validatedData['name'];
            $user->username = $validatedData['username'];
            $user->password = Hash::make($validatedData['password']);
            $user->role_id = $validatedData['role_id'];
            $user->province_code = $validatedData['province_code'];
            $user->city_code = $validatedData['city_code'];
            $user->district_code = $validatedData['district_code'];
            $user->role_type = 0;

            $user->save();

            return response()->json([
                'status' => 200,
                'message' => 'User berhasil ditambahkan',
                'data' => $user
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


    public function getDataById($id) {
        $data = User::where('id', $id)
        ->first();

        $res = [
            'status' => 200,
            'message' => 'Berhasil load data',
            'data' => $data
        ];

        return response()->json($res);
    }

    public function update(Request $request, $id) {
        try {
            $user = User::findOrFail($id);

            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'username' => 'required|string|max:80',
                'password' => 'nullable|string',
                'role_id' => 'required|integer|exists:roles,id',
                'province_code' => 'required|string|max:2',
                'city_code' => 'required|string|max:4',
                'district_code' => 'required|string|max:6',
            ]);

            $user->name = $validatedData['name'];
            $user->username = $validatedData['username'];

            if (isset($validatedData['password']) && !empty($validatedData['password'])) {
                $user->password = Hash::make($validatedData['password']);
            }

            $user->role_id = $validatedData['role_id'];
            $user->province_code = $validatedData['province_code'];
            $user->city_code = $validatedData['city_code'];
            $user->district_code = $validatedData['district_code'];

            $user->save();

            return response()->json([
                'status' => 200,
                'message' => 'User berhasil diperbarui',
                'data' => $user
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


    public function resetPassword(Request $request) {
        $id = $request->get('id');

        $up = User::where('id', $id)
        ->update(['is_default' => 1]);

        if ($up) {
            $res = [
                'status' => 200,
                'message' => 'Berhasil reset password'
            ];
        } else {
            $res = [
                'status' => 400,
                'message' => 'Gagal resset password'
            ];
        }

        return response()->json($res);
    }
}

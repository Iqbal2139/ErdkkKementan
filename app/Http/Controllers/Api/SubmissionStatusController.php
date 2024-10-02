<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SubmissionStatus;

class SubmissionStatusController extends Controller
{
    public function index(Request $request){
        $data = SubmissionStatus::limit(10);

        $search = $request->get('search');
        $limit = $request->get('length');
        $offset = $request->get('start');

        if (isset($search) && null != $search){
            $data->where('name', 'like', '%' .$request->get('search'). '%');
        }

        $statusCount = $data->count('id');

        if (isset($limit) && null != $limit) {
            $data->limit($limit);
        }

        if (isset($offset) && null != $offset) {
            $data->offset($offset);
        }

        $status = $data->orderBy('id','ASC')->get();

        if (count($status) > 0) {
            $respon ['message'] = [
                'responseMessage' => ' Success! ',
                'data' => $status,
                'recordsTotal' => $statusCount,
                'recordsFiltered' => $statusCount,
                'status' => 200
            ];

            return response()->json($status);

        }else{
            $respon ['message'] = [
                'responseMessage' => ' Data Tidak Ditemukan! ',
                'status' => 404
            ];

            return response()->json($respon);
        }

    }
}

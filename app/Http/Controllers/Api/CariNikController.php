<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SubmissionSimluhtan;
use Illuminate\Support\Facades\DB;

class CariNikController extends Controller
{
    public function getDataErdkk(Request $request){
        $nik    = $request->get('nik');
        $tahun  = $request->get('tahun');
        $check  = true;

        if (empty($nik) || empty($tahun)) {
            $result = [
                'draw' => $request->get('draw'),
                'recordsFiltered' => 0,
                'data' => [],
                'recordsTotal' => 0
            ];

            $check = false;
        }

        if ($check) {
            $data = SubmissionSimluhtan::select(
                'farmer_nik',
                'farmer_name',
                DB::raw('sum(mt1_urea + mt2_urea + mt3_urea) as urea'),
                DB::raw('sum(mt1_npk + mt2_npk + mt3_npk) as npk'),
                DB::raw('sum(mt1_za + mt2_za + mt3_za) as za'),
                DB::raw('sum(mt1_sp36 + mt2_sp36 + mt3_sp36) as sp36'),
                DB::raw('sum(mt1_organic + mt2_organic + mt3_organic) as organic'),
                'areas.province',
                'areas.city',
                'areas.district',
                'areas.sub_district',
                DB::raw('count(submissions_simluhtan.id) as baris')
            )->join('areas', 'submissions_simluhtan.sub_district_code', '=', 'areas.sub_district_code')
            ->where('farmer_nik', $nik)
            ->where('year', $tahun)
            ->groupBy('farmer_nik', 'farmer_name', 'areas.province', 'areas.city', 'areas.district', 'areas.sub_district');

            $result["draw"] = $request->get('draw');

            // total filter
            $result["recordsFiltered"] = $data->count();

            if (isset($limit) && null != $limit) {
                $data->limit($limit);
            }

            if (isset($offset) && null != $offset) {
                $data->offset($offset);
            }

            // detail data
            $result["data"] = $data->get();

            // total data
            $result["recordsTotal"] = $data->count();
        }

        return response()->json($result);
    }

    public function getDetailDataErdkk(Request $request) {
        $nik    = $request->get('nik');
        $tahun  = $request->get('tahun');
        $check  = true;

        if (empty($nik) || empty($tahun)) {
            $result = [
                'draw' => $request->get('draw'),
                'recordsFiltered' => 0,
                'data' => [],
                'recordsTotal' => 0
            ];

            $check = false;
        }

        if ($check) {
            $data = SubmissionSimluhtan::select(
                'submissions_simluhtan.id as ss_id',
                DB::raw('NULL as penyuluh'),
                'submissions_simluhtan.farmer_nik',
                'r.pihc_code',
                'r.name as nama_kios',
                'submissions_simluhtan.farmer_name',
                'a.province',
                'a.city',
                'a.district',
                'a.sub_district',
                'fg.name as poktan',
                'st.name as ss_status',
                DB::raw("concat(mt1_planting_area, '-', mt2_planting_area, '-', mt3_planting_area) as planting_area"),
                DB::raw("concat(mt1_commodity, '-', mt2_commodity, '-', mt3_commodity) as komoditas"),
                DB::raw("concat(mt1_urea, '-', mt2_urea, '-', mt3_urea) as urea"),
                DB::raw("concat(mt1_npk, '-', mt2_npk, '-', mt3_npk) as npk"),
                DB::raw("concat(mt1_sp36, '-', mt2_sp36, '-', mt3_sp36) as sp36"),
                DB::raw("concat(mt1_za, '-', mt2_za, '-', mt3_za) as za"),
                DB::raw("concat(mt1_organic, '-', mt2_organic, '-', mt3_organic) as organic"),
                DB::raw("concat(mt1_npk_formula, '-', mt2_npk_formula, '-', mt3_npk_formula) as npk_formula"),
                DB::raw("concat(mt1_poc, '-', mt2_poc, '-', mt3_poc) as poc"),
                'submissions_simluhtan.created_at',
                'submissions_simluhtan.updated_at'
            )->join('retailers as r', 'submissions_simluhtan.retailer_id', 'r.id')
            ->join('areas as a', 'submissions_simluhtan.sub_district_code', 'a.sub_district_code')
            ->join('farmer_groups as fg', 'submissions_simluhtan.farmer_group_id', 'fg.id')
            ->join('submission_status as st', 'submissions_simluhtan.status', 'st.id')
            ->where('farmer_nik', $nik)
            ->where('year', $tahun);

            $result["draw"] = $request->get('draw');

            // total filter
            $result["recordsFiltered"] = $data->count();

            if (isset($limit) && null != $limit) {
                $data->limit($limit);
            }

            if (isset($offset) && null != $offset) {
                $data->offset($offset);
            }

            // detail data
            $result["data"] = $data->get();

            // total data
            $result["recordsTotal"] = $data->count();
        }

        return response()->json($result);
    }
}


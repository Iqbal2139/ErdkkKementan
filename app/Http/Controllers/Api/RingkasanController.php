<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SubmissionStatus;
use App\Models\SubmissionSimluhtan;
use App\Models\Area;
use DB;

class RingkasanController extends Controller
{
    public function index(Request $request){
        $provinceCode = session('provinceCode');
        $cityCode = session('cityCode');

        if($provinceCode != 'null'){
            $wilayah = $provinceCode;
        }elseif($cityCode != 'null'){
            $wilayah = $cityCode;
        }

       $data =    SubmissionStatus::select( 'submission_status.id AS id_status',
                        'submission_status.name AS nama_status',
                        DB::raw('COUNT(submissions_simluhtan.status) AS status_count'),
                        DB::raw('COUNT(DISTINCT submissions_simluhtan.farmer_nik) AS jumnik')
                    )
                    ->leftJoin('submissions_simluhtan', function($join) use ($wilayah) {
                        $join->on('submissions_simluhtan.status', '=', 'submission_status.id')
                             ->where('submissions_simluhtan.district_code', 'LIKE', $wilayah . '%');
                    })
                    ->whereNotIn('submission_status.id', [6, 8, 15, 20, 999])  // Exclude specific status IDs
                    ->groupBy('submission_status.id', 'submission_status.name')
                    ->orderBy('submission_status.id', 'ASC');

        // params
         $search         = $request->get('search');
         $limit          = $request->get('length');
         $offset         = $request->get('start');
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

        echo json_encode($result);
    }

    public function detail(Request $request){
        $id = $request->input('id');

        $provinceCode = session('provinceCode');
        $cityCode = session('cityCode');
       
        
        if($cityCode != ''){
            $wilayah = $cityCode;
             $district_code = 'district_code';
             $data = DB::select("SELECT b.city, b.district, b.district_code, 
                                    COALESCE(a.jum_baris, 0) AS jum_baris,
                                    COALESCE(a.jumnik, 0) AS jumnik,
                                    COALESCE(a.jum_urea, 0) AS jum_urea,
                                    COALESCE(a.jum_npk, 0) AS jum_npk, 
                                    COALESCE(a.jum_npk_formula, 0) AS jum_npk_formula,
                                    COALESCE(a.jum_organic, 0) AS jum_organic,
                                    '2025' AS year,
                                    COALESCE(a.rencana_tanam, 0) AS rencana_tanam
                                FROM (
                                    SELECT 
                                        COUNT(id) AS jum_baris,
                                        COUNT(DISTINCT farmer_nik) AS jumnik,
                                        SUM(mt1_planting_area + mt2_planting_area + mt3_planting_area) AS rencana_tanam,
                                        SUM(mt1_urea + mt2_urea + mt3_urea) AS jum_urea, 
                                        SUM(mt1_npk + mt2_npk + mt3_npk) AS jum_npk, 
                                        SUM(mt1_npk_formula + mt2_npk_formula + mt3_npk_formula) AS jum_npk_formula,
                                        SUM(mt1_organic + mt2_organic + mt3_organic) AS jum_organic,
                                        district_code 
                                    FROM submissions_simluhtan 
                                    WHERE YEAR = 2025 
                                    AND district_code LIKE '$wilayah%' 
                                    AND status = $id
                                    GROUP BY district_code 
                                ) a 
                                RIGHT JOIN (
                                    SELECT DISTINCT city, district, district_code 
                                    FROM areas 
                                    WHERE district_code LIKE '$wilayah%'
                                ) b ON a.district_code = b.district_code
                            ");
        }else{  
            if($provinceCode != 'null'){
                $wilayah = $provinceCode;
                $district_code = 'district_code';
                $data = DB::select("SELECT b.city as district,
                                    COALESCE(a.jum_baris, 0) AS jum_baris,
                                    COALESCE(a.jumnik, 0) AS jumnik,
                                    COALESCE(a.jum_urea, 0) AS jum_urea,
                                    COALESCE(a.jum_npk, 0) AS jum_npk, 
                                    COALESCE(a.jum_npk_formula, 0) AS jum_npk_formula,
                                    COALESCE(a.jum_organic, 0) AS jum_organic,
                                    '2025' AS year,
                                    COALESCE(a.rencana_tanam, 0) AS rencana_tanam 
                                FROM (
                                    SELECT 
                                        COUNT(id) AS jum_baris,
                                        COUNT(DISTINCT farmer_nik) AS jumnik,
                                        SUM(mt1_planting_area + mt2_planting_area + mt3_planting_area) AS rencana_tanam,
                                        SUM(mt1_urea + mt2_urea + mt3_urea) AS jum_urea, 
                                        SUM(mt1_npk + mt2_npk + mt3_npk) AS jum_npk, 
                                        SUM(mt1_npk_formula + mt2_npk_formula + mt3_npk_formula) AS jum_npk_formula,
                                        SUM(mt1_organic + mt2_organic + mt3_organic) AS jum_organic,
                                        city_code 
                                    FROM submissions_simluhtan 
                                    WHERE YEAR = 2025 
                                    AND city_code LIKE '12%' 
                                    AND status = 4 
                                    GROUP BY city_code 
                                ) a 
                                RIGHT JOIN (
                                    SELECT city_code, city 
                                    FROM areas 
                                    WHERE city_code LIKE '12%' 
                                    GROUP BY city_code, city 
                                    ORDER BY city_code
                                ) b ON a.city_code = b.city_code
                                ");
            }
        }
      //  dd($wilayah);

        // params
         $search         = $request->get('search');
         $limit          = $request->get('length');
         $offset         = $request->get('start');
         $result["draw"] = $request->get('draw');

        // total filter
        $result["recordsFiltered"] = 0;

        /*if (isset($limit) && null != $limit) {
            $data->limit($limit);
        }

        if (isset($offset) && null != $offset) {
            $data->offset($offset);
        }*/

        // detail data
        $result["data"] = $data;

        // total data
        $result["recordsTotal"] = 0;

        echo json_encode($result);
    }

    public function status(Request $request){
        $id = $request->input('id');

        $data = SubmissionStatus::where('id', $id)->get();

        return response()->json($data);

    }
}


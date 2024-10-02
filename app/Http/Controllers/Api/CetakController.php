<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FarmerGroup;
use App\Models\Commodities;
use App\Models\Subsectors;
use App\Models\Retailer;
use App\Models\SubmissionSimluhtan;
use DB;
use PDF;

class CetakController extends Controller
{
    public function index(Request $request){
        $poktan = $request->input('poktan');
        $subsectors = $request->input('subsectors');
        $commodities = $request->input('commodities');
        $kios = $request->input('kios');
        $districtCode = session('districtCode').'%';

        $data = SubmissionSimluhtan::select(
            'submissions_simluhtan.farmer_nik',
            'submissions_simluhtan.farmer_name',
            'retailers.name as retailer_name',
            DB::raw('submissions_simluhtan.mt1_planting_area + submissions_simluhtan.mt2_planting_area + submissions_simluhtan.mt3_planting_area as rencana_tanam'),
            'submissions_simluhtan.mt1_urea',
            'submissions_simluhtan.mt2_urea',
            'submissions_simluhtan.mt3_urea',
            DB::raw('submissions_simluhtan.mt1_urea + submissions_simluhtan.mt2_urea + submissions_simluhtan.mt3_urea as jml_urea'),
            'submissions_simluhtan.mt1_npk',
            'submissions_simluhtan.mt2_npk',
            'submissions_simluhtan.mt3_npk',
            DB::raw('submissions_simluhtan.mt1_npk + submissions_simluhtan.mt2_npk + submissions_simluhtan.mt3_npk as jml_npk'),
            'submissions_simluhtan.mt1_npk_formula',
            'submissions_simluhtan.mt2_npk_formula',
            'submissions_simluhtan.mt3_npk_formula',
            DB::raw('submissions_simluhtan.mt1_npk_formula + submissions_simluhtan.mt2_npk_formula + submissions_simluhtan.mt3_npk_formula as jml_npk_formula'),
            'submissions_simluhtan.mt1_organic',
            'submissions_simluhtan.mt2_organic',
            'submissions_simluhtan.mt3_organic',
            DB::raw('submissions_simluhtan.mt1_organic + submissions_simluhtan.mt2_organic + submissions_simluhtan.mt3_organic as jml_organic')
        )->leftJoin('retailers', function($join) {
            $join->on('submissions_simluhtan.retailer_id', '=', 'retailers.id')
                 ->on('submissions_simluhtan.sub_district_code', '=', 'retailers.sub_district_code');
        })
        ->whereLike('submissions_simluhtan.sub_district_code', $districtCode);

		if($poktan != ""){
			$data->where('submissions_simluhtan.farmer_group_id', $poktan);
		}

		if ($subsectors != "") {
            $subsectors = '%'.$subsectors.'%';
            $data->whereLike('submissions_simluhtan.subsector', $subsectors, caseSensitive: false);
        }

		if ($commodities != "") {
            $commodities = strtoupper($commodities).'%';
            $data->whereAny([
                DB::raw('UPPER(submissions_simluhtan.mt1_commodity)'),
                DB::raw('UPPER(submissions_simluhtan.mt2_commodity)'),
                DB::raw('UPPER(submissions_simluhtan.mt3_commodity)')
            ], 'like', $commodities);
        }

		if($kios != ""){
			$data->where('submissions_simluhtan.retailer_id', $kios);
		}

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

    public function farmer(Request $request){
        $data = FarmerGroup::where('sub_district_code', 'like', districtCode() . '%')->get();

        $search = $request->get('search');
        $limit = $request->get('length');
        $offset = $request->get('start');

        if (isset($search) && null != $search){
           // $data->where('areas.sub_district_code', 'like', '%' .$request->get('search'). '%');
        }

        $areasCount = 0;

        if (isset($limit) && null != $limit) {
            $data->limit($limit);
        }

        if (isset($offset) && null != $offset) {
            $data->offset($offset);
        }

        $areas = 0;


        $respon ['message'] = [
            'responseMessage' => ' Success! ',
            'data' => $data,
            'recordsTotal' => $areasCount,
            'recordsFiltered' => $areasCount,
            'status' => 200
        ];

        return response()->json($data);


    }

    public function commodities(Request $request){
        $data = Commodities::all();
       // dd(districtCode());

        $search = $request->get('search');
        $limit = $request->get('length');
        $offset = $request->get('start');

        if (isset($search) && null != $search){
           // $data->where('areas.sub_district_code', 'like', '%' .$request->get('search'). '%');
        }

        $areasCount = 0;

        if (isset($limit) && null != $limit) {
            $data->limit($limit);
        }

        if (isset($offset) && null != $offset) {
            $data->offset($offset);
        }

        $areas = 0;

        $respon ['message'] = [
            'responseMessage' => ' Success! ',
            'data' => $data,
            'recordsTotal' => $areasCount,
            'recordsFiltered' => $areasCount,
            'status' => 200
        ];

        return response()->json($data);

    }

    public function subsectors(Request $request){
        $data = Subsectors::all();
       // dd(districtCode());

        $search = $request->get('search');
        $limit = $request->get('length');
        $offset = $request->get('start');

        if (isset($search) && null != $search){
           // $data->where('areas.sub_district_code', 'like', '%' .$request->get('search'). '%');
        }

        $areasCount = 0;

        if (isset($limit) && null != $limit) {
            $data->limit($limit);
        }

        if (isset($offset) && null != $offset) {
            $data->offset($offset);
        }

        $areas = 0;

        $respon ['message'] = [
            'responseMessage' => ' Success! ',
            'data' => $data,
            'recordsTotal' => $areasCount,
            'recordsFiltered' => $areasCount,
            'status' => 200
        ];

        return response()->json($data);
    }

    public function kios(Request $request){
        $data = Retailer::where('sub_district_code', 'like', districtCode() . '%')->get();

        $search = $request->get('search');
        $limit = $request->get('length');
        $offset = $request->get('start');

        if (isset($search) && null != $search){
           // $data->where('areas.sub_district_code', 'like', '%' .$request->get('search'). '%');
        }

        $areasCount = 0;

        if (isset($limit) && null != $limit) {
            $data->limit($limit);
        }

        if (isset($offset) && null != $offset) {
            $data->offset($offset);
        }

        $areas = 0;


        $respon ['message'] = [
            'responseMessage' => ' Success! ',
            'data' => $data,
            'recordsTotal' => $areasCount,
            'recordsFiltered' => $areasCount,
            'status' => 200
        ];

        return response()->json($data);


    }

    public function downloadPDF(Request $request)
    {
        $poktan = $request->input('poktan');
        $subsectors = $request->input('subsectors');
        $commodities = $request->input('commodities');
        $kios = $request->input('kios');
        $districtCode = session('districtCode').'%';

        $data = SubmissionSimluhtan::select(
            'submissions_simluhtan.farmer_nik',
            'submissions_simluhtan.farmer_name',
            'retailers.name as retailer_name',
            DB::raw('submissions_simluhtan.mt1_planting_area + submissions_simluhtan.mt2_planting_area + submissions_simluhtan.mt3_planting_area as rencana_tanam'),
            'submissions_simluhtan.mt1_urea',
            'submissions_simluhtan.mt2_urea',
            'submissions_simluhtan.mt3_urea',
            DB::raw('submissions_simluhtan.mt1_urea + submissions_simluhtan.mt2_urea + submissions_simluhtan.mt3_urea as jml_urea'),
            'submissions_simluhtan.mt1_npk',
            'submissions_simluhtan.mt2_npk',
            'submissions_simluhtan.mt3_npk',
            DB::raw('submissions_simluhtan.mt1_npk + submissions_simluhtan.mt2_npk + submissions_simluhtan.mt3_npk as jml_npk'),
            'submissions_simluhtan.mt1_npk_formula',
            'submissions_simluhtan.mt2_npk_formula',
            'submissions_simluhtan.mt3_npk_formula',
            DB::raw('submissions_simluhtan.mt1_npk_formula + submissions_simluhtan.mt2_npk_formula + submissions_simluhtan.mt3_npk_formula as jml_npk_formula'),
            'submissions_simluhtan.mt1_organic',
            'submissions_simluhtan.mt2_organic',
            'submissions_simluhtan.mt3_organic',
            DB::raw('submissions_simluhtan.mt1_organic + submissions_simluhtan.mt2_organic + submissions_simluhtan.mt3_organic as jml_organic')
        )->leftJoin('retailers', function($join) {
            $join->on('submissions_simluhtan.retailer_id', '=', 'retailers.id')
                 ->on('submissions_simluhtan.sub_district_code', '=', 'retailers.sub_district_code');
        })
        ->whereLike('submissions_simluhtan.sub_district_code', $districtCode);

		if($poktan != ""){
			$data->where('submissions_simluhtan.farmer_group_id', $poktan);
		}

		if ($subsectors != "") {
            $subsectors = '%'.$subsectors.'%';
            $data->whereLike('submissions_simluhtan.subsector', $subsectors, caseSensitive: false);
        }

		if ($commodities != "") {
            $commodities = strtoupper($commodities).'%';
            $data->whereAny([
                DB::raw('UPPER(submissions_simluhtan.mt1_commodity)'),
                DB::raw('UPPER(submissions_simluhtan.mt2_commodity)'),
                DB::raw('UPPER(submissions_simluhtan.mt3_commodity)')
            ], 'like', $commodities);
        }

		if($kios != ""){
			$data->where('submissions_simluhtan.retailer_id', $kios);
		}

        $data2 = $data->get();

        // Check if data is retrieved successfully
        if ($data2->isEmpty()) {
            return response()->json(['message' => 'No data found'], 404);
        }

        // Generate the PDF
        $pdf = PDF::loadView('modules.cetak.pdf', ['data' => $data2]);

        return $pdf->stream('document.pdf'); // Use stream to send the file
    }
}

<?php

namespace App\Http\Controllers\Api;

use App\Exports\failedDataExport;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use App\Jobs\AlokasiCSVData;
use App\Models\KodeRelasiDesa;
use App\Models\SimpadanClean;
use App\Models\SubmissionSimluhtan;
use App\Imports\PengajuanImport;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;
use Illuminate\Support\Str;
use App\Models\User;
use Maatwebsite\LaravelNovaExcel\Actions\DownloadExcel;

class ErdkkPengajuanController extends Controller
{

    public function index(Request $request){
        $data = SubmissionSimluhtan::with(['status', 'farmerGroup', 'retailer', 'area']);

        if (!is_null(districtCode())) $data->where('district_code', districtCode());

        // params
        $search         = $request->get('search');
        $limit          = $request->get('length');
        $offset         = $request->get('start');
        $kelurahan      = $request->get('kelurahan');
        $kelompokTani   = $request->get('kelompokTani');
        $statusPengajuan= $request->get('statusPengajuan');
        $result["draw"] = $request->get('draw');
        $currentDate = Carbon::now();

        if (isset($search) && null != $search['value']){
            // query search
            // kodeWilayah()
        }

        // cari kelurahan
        if (!empty($kelurahan)) {
            $data->where('sub_district_code', $kelurahan);
        }

        // cari kelompok tani
        if (!empty($kelompokTani)) {
            $data->where('farmer_group_id', $kelompokTani);
        }

        // cari status pengajuan
        if (!empty($statusPengajuan)) {
            $data->where('status', $statusPengajuan);
        }

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
        $total = SubmissionSimluhtan::with(['status', 'farmerGroup', 'retailer', 'area']);

        if (!is_null(districtCode())) $total->where('district_code', districtCode());
        $result["recordsTotal"] = $total->count();

        echo json_encode($result);
    }

    public function store(Request $request){

            $current = Carbon::now()->format('Ymd his');
            if ($request->has('file')) {
                $fileName = $request->file->getClientOriginalName();
                $filePath = public_path('uploads').'/'.$fileName;

                if (!file_exists($fileName)) {
                    $request->file->move(public_path('uploads'), $fileName);
                }

                $importFile = new PengajuanImport;
                Excel::import($importFile, $filePath);

                $fileNameFailed = str_replace(' ', '', $current.$fileName);
                Excel::store(new failedDataExport($importFile->failedRespon()), $fileNameFailed);

            } else {
                $data ['message'] = [
                    'responseMessage' => ' Tidak ada file! ',
                    'status' => 400
                ];
            }

        $data ['message'] = [
            'responseMessage' => ' Upload Pengajuan Sukses! ',
            'dataSukses' =>$fileNameFailed,
            'status' => 200
        ];

        return response()->json($data, 200);

        // if( $request->has('file') ) {
        //     $csv    = file($request->file);
        //     $chunks = array_chunk($csv, 500);

        //     $header = [];
        //     $batch  = Bus::batch([])->dispatch();

        //     foreach ($chunks as $key => $chunk) {
        //         $data = array_map('str_getcsv', $chunk);
        //         dd($data);
        //         if($key == 0){
        //             $header = $data[0];
        //             unset($data[0]);
        //         }

        //         $batch->add(new AlokasiCSVData($data, $header));
        //     }

        //     Log::info("Sukses Upload Data");

        //     $data ['message'] = [
        //         'responseMessage' => ' Upload Pengajuan Sukses! ',
        //         'status' => 200
        //     ];

        //     return response($data);

        // }else{

        //     $data ['message'] = [
        //         'responseMessage' => ' Import Data Failed! ',
        //         'status' => 400
        //     ];
        // }

    }

    public function kirimPengajuan(Request $request){

        $sendData = SubmissionSimluhtan::where(function ($query) {
            $query->where('sub_district_code', 'like', "%".cityCode()."%")
                    ->orWhere('sub_district_code', 'like', "%".districtCode()."%");
        })
        ->where('status', config('constants.roles.KECAMATAN'))
        ->update([
            'status' => 2
        ]);

        $data ['message'] = 'Data Berhasil Dikirim!';
		return response($data, 200);
    }

    public function downloadExcelFailed(Request $request) {
        $filename = $request->get('filename');
        // Get path from storage directory
        $path = storage_path('app/private/' . $filename);
        // Download file with custom headers
        return response()->download($path, $filename, [
            'Content-Type' => 'application/vnd.ms-excel',
            'Content-Disposition' => 'inline; filename="' . $filename . '"'
        ]);
    }
}

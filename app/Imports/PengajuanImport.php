<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\RemembersRowNumber;
use Illuminate\Support\Facades\Bus;
use App\Jobs\AlokasiCSVData;
use App\Models\PoktanAnggota;
use App\Models\SubmissionSimluhtan;
use App\Models\KodeRelasiDesa;
use App\Models\Area;
use App\Models\Retailer;
use App\Models\FarmerGroup;
use Carbon\Carbon;
use Carbon\CarbonImmutable;
use Maatwebsite\Excel\Concerns\WithValidation;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class PengajuanImport implements ToCollection, WithHeadingRow, WithChunkReading
{

    use RemembersRowNumber;

    private $failedData = [];

    protected function isFishingPlantingAreaValid($farmer_nik, $mt1_planting_area, $mt2_planting_area, $mt3_planting_area, $year, $subsector){
        $recipient = SubmissionSimluhtan::selectRaw('sum(mt1_planting_area) as total_mt1_planting_area, sum(mt2_planting_area) as total_mt2_planting_area, sum(mt3_planting_area) as total_mt3_planting_area')
                    ->where('farmer_nik', $farmer_nik)
                    ->where('year', $year)
                    ->first();

        $farmer = PoktanAnggota::selectRaw('sum(luas_lahan_ternak_diusahakan) as total_luas_lahan_ternak_diusahakan, sum(luas_lahan_ternak_dimiliki) as total_luas_lahan_ternak_dimiliki')
                    ->where('no_ktp', $farmer_nik)
                    ->first();

        if (isset($subsector) && $subsector == 'PERIKANAN') {
            if ($recipient != null and $farmer != null){
                $maxPlantingArea = max((float)$farmer['total_luas_lahan_ternak_diusahakan'], (float)$farmer['total_luas_lahan_ternak_dimiliki']) ;
                if ($maxPlantingArea < 1) {
                    return $recipient[0]['total_mt1_planting_area'] + $mt1_planting_area <= $maxPlantingArea && $recipient[0]['total_mt2_planting_area'] + $mt2_planting_area <= $maxPlantingArea && $recipient[0]['total_mt3_planting_area'] + $mt3_planting_area <= $maxPlantingArea;
                } else {
                    return $recipient[0]['total_mt1_planting_area'] + $mt1_planting_area <= 1 && $recipient[0]['total_mt2_planting_area'] + $mt2_planting_area <= 1 && $recipient[0]['total_mt3_planting_area'] + $mt3_planting_area <= 1;
                }
            }
        }

        if ($recipient != null and $farmer != null){
            $maxPlantingArea = max((float)$farmer['total_luas_lahan_ternak_diusahakan'], (float)$farmer['total_luas_lahan_ternak_dimiliki']) ;
            if ($maxPlantingArea < 2) {
                return round((float)$recipient->total_mt1_planting_area + $mt1_planting_area, 2) <= $maxPlantingArea && round((float)$recipient->total_mt2_planting_area + $mt2_planting_area, 2) <= $maxPlantingArea && round((float)$recipient->total_mt3_planting_area + $mt3_planting_area, 2) <= $maxPlantingArea;
            } else {
                return round((float)$recipient->total_mt1_planting_area + $mt1_planting_area, 2) <= 2 && round((float)$recipient->total_mt2_planting_area + $mt2_planting_area, 2) <= 2 && round((float)$recipient->total_mt3_planting_area + $mt3_planting_area, 2) <= 2;
            }
        }

        return true;
    }

    function isValidDate(string $myDateString, string $format = 'Y-m-d'): bool
    {
        $dateTime = CarbonImmutable::createFromFormat($format, $myDateString);

        return $dateTime && $dateTime->format($format) === $myDateString;
    }

    function validateIndonesianNIK($nik) {
        $pattern = "/^((1[1-9])|(21)|([37][1-6])|(5[1-4])|(6[1-5])|([8-9][1-2]))[0-9]{2}[0-9]{2}(([0-6][0-9])|(7[0-1]))((0[1-9])|(1[0-2]))([0-9]{2})[0-9]{4}$/";
        if (preg_match($pattern, $nik)) {
            // Valid NIK format
            return true;
        } else {
            // Invalid NIK format
            return false;
        }
    }

    function isValidKodeDesa($kodeDesa) {
        $data = Area::where(function ($query) use ($kodeDesa) {
            $query->where('sub_district_code', 'like', "".cityCode()."%")
                    ->orWhere('sub_district_code', 'like', "".districtCode()."%");
        })
        ->where('sub_district_code', 'like', "".$kodeDesa."%")
        ->get();

        if (count($data) != 0) {
            // Valid Area
            return true;
        } else {
            // Invalid Area
            return false;
        }
    }

    function isValidRetailer($kodeDesa, $kodeKios) {

        $data = Retailer::where(function ($query) use ($kodeDesa) {
            $query->where('sub_district_code', 'like', "".cityCode()."%")
                    ->orWhere('sub_district_code', 'like', "".districtCode()."%");
        })
        ->where('pihc_code', $kodeKios)
        ->where('sub_district_code', $kodeDesa)
        ->get();

        if (count($data) != 0) {
            // Valid Area
            return true;
        } else {
            // Invalid Area
            return false;
        }
    }

    function isValidPoktan($poktan) {
        $data = FarmerGroup::where(function ($query) use ($poktan) {
            $query->where('sub_district_code', 'like', "".cityCode()."%")
                    ->orWhere('sub_district_code', 'like', "".districtCode()."%");
        })
        ->where('id', $poktan)
        ->get();

        if (count($data) != 0) {
            // Valid Area
            return true;
        } else {
            // Invalid Area
            return false;
        }
    }

    function isFarmerGroupSubDistrictIndex($poktan, $kodeDesa) {
        $farmer = FarmerGroup::where('id', $poktan)->first();
        $area = Area::where('sub_district_code', $kodeDesa)->first();
        if ($area != null && $farmer != null) {
            // Valid Area
            return true;
        } else {
            // Invalid Area
            return false;
        }
    }

    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        $year = Carbon::now()->format('Y');

        // Validator::make($collection->toArray(), [
        //     '*.nama_penyuluh' => 'required',
        //     '*.nama_ibu_kandung' => 'required',
        //     '*.subsektor' => 'required',
        // ])->validate();

        foreach ($collection as $row) {
            if ($row['nama_penyuluh'] == null) {
                $isFailed = true;
                    $row->message_failed = [
                        'responseMessage' => ' Nama Penyuluh tidak boleh kosong ',
                        'status' => 401
                    ];
            }

            if ($row['subsektor'] == null) {
                $isFailed = true;
                    $row->message_failed = [
                        'responseMessage' => ' subsektor tidak boleh kosong ',
                        'status' => 401
                    ];
            }

            if ($row['nama_ibu_kandung'] == null) {
                $isFailed = true;
                    $row->message_failed = [
                        'responseMessage' => ' Nama Ibu Kandung tidak boleh kosong ',
                        'status' => 401
                    ];
            }

            // Check valid nik
            if ($this->validateIndonesianNIK($row['ktp']) == false) {
                $isFailed = true;
                    $row->message_failed = [
                        'responseMessage' => ' KTP tidak Valid ',
                        'status' => 401
                    ];
            }

            // Check valid kode desa
            if ($this->isValidKodeDesa($row['kode_desa']) == false) {
                // dd($this->isValidKodeDesa($row['kode_desa']));
                $isFailed = true;
                    $row->message_failed = [
                        'responseMessage' => ' Kode desa tidak sesuai dengan database atau belum terdaftar ',
                        'status' => 401
                    ];
            }

            // Check valid retailer
            if ($this->isValidRetailer($row['kode_desa'],$row['kode_kios_pengecer']) == false) {
                // dd($this->isValidRetailer($row['kode_desa'],$row['kode_kios_pengecer']));
                $isFailed = true;
                    $row->message_failed = [
                        'responseMessage' => ' Kode PIHC dan nama pengecer tidak sesuai dengan database atau belum terdaftar. ',
                        'status' => 401
                    ];
            }

            // Check valid poktan
            if ($this->isValidPoktan($row['id_poktan']) == false) {
                // dd($this->isValidPoktan($row['id_poktan']));
                $isFailed = true;
                    $row->message_failed = [
                        'responseMessage' => ' ID Poktan tidak terdaftar di SIMLUHTAN/Kode desa tidak sesuai ',
                        'status' => 401
                    ];
            }

            // if ($this->isFarmerValid($row['id_poktan']) == false) {
            //     $isFailed = true;
            //         $row->message_failed = [
            //             'responseMessage' => ' Mohon periksa data petani di SIMLUHTAN, beberapa kolom ini wajib diisi dengan benar: Nama KTP, Alamat KTP, Tanggal lahir, Tempat Lahir, Koordinat Lahan, Luas Lahan. ',
            //             'status' => 401
            //         ];
            // }

            // if ($this->isFarmerGroupSubDistrictIndex($row['id_poktan'], $row['kode_desa']) == true) {
            //     $kodeDesaPenyuluh = KodeRelasiDesa::where('kode_desa_bps', $row['kode_desa'])->first();
            //     $kodeDesaSubmission = FarmerGroup::where('sub_district_code', $row['kode_desa'])->first();
            //     $checkFarmerGroupValid = $kodeDesaPenyuluh->kode_desa_bps == $kodeDesaSubmission->sub_district_code;
            // }

            // $isFailed = false;
            $checkFishingPlantingArea = $this->isFishingPlantingAreaValid($row['ktp'], $row['luas_lahan_ha_mt1'], $row['luas_lahan_ha_mt2'], $row['luas_lahan_ha_mt3'], $year, $row['subsektor']);

            if ($checkFishingPlantingArea) {
                $checkEligibleByNik = new PoktanAnggota();
                $dataEligibleByNik = $checkEligibleByNik->is_eligible_nik($row['ktp'], $row['kode_desa'], $row['id_poktan']);
                // dd($checkFishingPlantingArea);

                if ($dataEligibleByNik != null) {

                    $checkFormatBornDate = $dataEligibleByNik->thn_lahir . '-' . ((int)$dataEligibleByNik->bln_lahir < 10 ? '0'
                    . $dataEligibleByNik->bln_lahir : $dataEligibleByNik->bln_lahir) . '-' .
                    ((int)$dataEligibleByNik->tgl_lahir < 10 ? '0' . $dataEligibleByNik->tgl_lahir : $dataEligibleByNik->tgl_lahir);

                    if ($this->isValidDate($checkFormatBornDate)) {
                        $years = Carbon::parse($checkFormatBornDate)->age;

                        if ($years < 18) {
                            $isFailed = true;
                            $row->message_failed = [
                                'responseMessage' => ' Umur petani kurang dari 18 tahun ',
                                'status' => 401
                            ];

                        }else{
                            $valid_poktan = $checkEligibleByNik->is_validate_poktan($row['ktp'],$row['id_poktan'],$row['kode_desa']);
                            // $valid_poktan = true; // klo is_validate_poktan datanya gak dapet bypass dulu aja
                            if ($valid_poktan) {
                                $is_padan = $checkEligibleByNik->get_padan_nik($row['ktp']);
                                if($is_padan){
                                    if ($is_padan->status == 2) {
                                        $SubmissionSimluhtan = new SubmissionSimluhtan();
                                        // $pengajuan = $SubmissionSimluhtan->get_sum_by_nik(kodeERDKK(), $row['ktp']);
                                        // $dataEligibleByNik = $checkEligibleByNik->is_eligble_nik_union($row['ktp'], $row['kode_desa'], $row['id_poktan']);

                                        // $epsilon = 0.00001;

                                        // if(
                                        //     ($row['mt1_planting_area'] + ($pengajuan[0]->total_mt1)) <= ($dataEligibleByNik[0]->batas + $epsilon)
                                        //         && ($row['mt2_planting_area'] + ($pengajuan[0]->total_mt2)) <= ($dataEligibleByNik[0]->batas + $epsilon)
                                        //         && ($row['mt3_planting_area'] + ($pengajuan[0]->total_mt3)) <= ($dataEligibleByNik[0]->batas + $epsilon)
                                        // ){
                                        //     $remains = $modelAllocation->get_remains_by_district($submission['district_code'],$submission['year']);
                                        //     $submission['revision'] = "";
                                        //     $valid = true;

                                        //     if($remains[0]->remains_urea < ($row['mt1_urea'] + $row['mt2_urea'] + $row['mt3_urea'])){
                                        //         $isFailed = true;
                                        //         $row->message_failed = [
                                        //             'responseMessage' => ' Pengajuan pupuk Urea melebihi Erdkk ',
                                        //             'status' => 401
                                        //         ];
                                        //     }
                                        //     if($remains[0]->remains_npk < ($row['mt1_npk'] + $row['mt2_npk'] + $row['mt3_npk'])){
                                        //         $isFailed = true;
                                        //         $row->message_failed = [
                                        //             'responseMessage' => ' Pengajuan pupuk NPK melebihi Alokasi. ',
                                        //             'status' => 401
                                        //         ];
                                        //     }
                                        //     if($remains[0]->remains_npk_formula < ($row['mt1_npk_formula'] + $row['mt2_npk_formula'] + $row['mt3_npk_formula'])){
                                        //         $isFailed = true;
                                        //         $row->message_failed = [
                                        //             'responseMessage' => ' Pengajuan pupuk NPK Formula melebihi Alokasi. ',
                                        //             'status' => 401
                                        //         ];
                                        //     }
                                        // }

                                        $isValid = true;
                                        if($isValid){

                                        // $currentRowNumber = $this->getRowNumber();

                                        // $batch  = Bus::batch([
                                        //     new AlokasiCSVData($collection)
                                        // ])->dispatch();

                                            $dataSubmission = new SubmissionSimluhtan ();
                                            $dataSubmission->retailer_id = $row['kode_kios_pengecer'];
                                            $dataSubmission->farmer_group_id = $row['id_poktan'];
                                            $dataSubmission->sub_district_code = isset($row['sub_district_code']) ? $row['sub_district_code'] : 0 ;
                                            $dataSubmission->district_code = $row['kode_desa'];
                                            $dataSubmission->city_code = isset($row['city_code']) ? $row['city_code'] : 0;
                                            $dataSubmission->province_code = isset($row['province_code']) ? $row['province_code'] : 0;
                                            $dataSubmission->instructor_name = $row['nama_penyuluh'];
                                            $dataSubmission->farmer_name = $row['nama_penyuluh'];
                                            $dataSubmission->farmer_group_name = isset($row['farmer_group_name']) ? $row['farmer_group_name'] : '';
                                            $dataSubmission->farmer_group_union_name = isset($row['farmer_group_union_name']) ? $row['farmer_group_union_name'] : 0;
                                            $dataSubmission->farmer_nik = $row['ktp'];
                                            $dataSubmission->farmer_address = isset($row['alamat']) ? $row['alamat'] : '';
                                            $dataSubmission->farmer_mother_name = $row['nama_ibu_kandung'];
                                            $dataSubmission->farmer_born_place = isset($row['farmer_born_place']) ? $row['farmer_born_place'] : '';
                                            $dataSubmission->farmer_born_date = isset($row['farmer_born_date']) ? $row['farmer_born_date'] : now();
                                            $dataSubmission->year = 2025;
                                            $dataSubmission->subsector = $row['subsektor'];
                                            $dataSubmission->mt1_commodity = $row['komoditas_mt1'];
                                            $dataSubmission->mt2_commodity = $row['komoditas_mt2'];
                                            $dataSubmission->mt3_commodity = $row['komoditas_mt3'];
                                            $dataSubmission->mt1_planting_area = $row['luas_lahan_ha_mt1'];
                                            $dataSubmission->mt2_planting_area = $row['luas_lahan_ha_mt2'];
                                            $dataSubmission->mt3_planting_area = $row['luas_lahan_ha_mt3'];
                                            $dataSubmission->mt1_urea = $row['pupuk_urea_kg_mt1'];
                                            $dataSubmission->mt2_urea = $row['pupuk_urea_kg_mt2'];
                                            $dataSubmission->mt3_urea = $row['pupuk_urea_kg_mt3'];
                                            $dataSubmission->mt1_sp36 = isset($row['mt1_sp36']) ? $row['mt1_sp36'] : 0;
                                            $dataSubmission->mt2_sp36 = isset($row['mt2_sp36']) ? $row['mt2_sp36'] : 0;
                                            $dataSubmission->mt3_sp36 = isset($row['mt3_sp36']) ? $row['mt3_sp36'] : 0;
                                            $dataSubmission->mt1_za = isset($row['mt1_za']) ? $row['mt1_za'] : 0;
                                            $dataSubmission->mt2_za = isset($row['mt2_za']) ? $row['mt2_za'] : 0;
                                            $dataSubmission->mt3_za = isset($row['mt3_za']) ? $row['mt3_za'] : 0;
                                            $dataSubmission->mt1_npk = $row['pupuk_npk_kg_mt2'];
                                            $dataSubmission->mt2_npk = $row['pupuk_npk_kg_mt2'];
                                            $dataSubmission->mt3_npk = $row['pupuk_npk_kg_mt3'];
                                            $dataSubmission->mt1_organic = $row['pupuk_organik_kg_mt1'];
                                            $dataSubmission->mt2_organic = $row['pupuk_organik_kg_mt2'];
                                            $dataSubmission->mt3_organic = $row['pupuk_organik_kg_mt3'];
                                            $dataSubmission->mt1_npk_formula = $row['pupuk_npk_formula_khusus_kg_mt1'];
                                            $dataSubmission->mt2_npk_formula = $row['pupuk_npk_formula_khusus_kg_mt2'];
                                            $dataSubmission->mt3_npk_formula = $row['pupuk_npk_formula_khusus_kg_mt3'];
                                            $dataSubmission->is_new = 1;
                                            $dataSubmission->save();

                                            return $dataSubmission;
                                        }

                                    }else{
                                        $isFailed = true;
                                        $row->message_failed = [
                                            'responseMessage' => ' NIK belum Padan DUKCAPIL. '.$is_padan->msg_dukcapil.'. Harap periksa data NIK di SIMLUHTAN. langkah-langkah  pada aplikasi simluhtan 1. cari data NIK 2. hapus data NIK 3. input ulang data NIK agar dapat divalidasi ulang ke sistem Dukcapil ',
                                            'status' => 401
                                        ];
                                    }

                                }else{
                                    $isFailed = true;
                                    $row->message_failed = [
                                        'responseMessage' => ' NIK belum Padan DUKCAPIL. Harap periksa data NIK di SIMLUHTAN. langkah-langkah  pada aplikasi simluhtan 1. cari data NIK 2. hapus data NIK 3. input ulang data NIK agar dapat divalidasi ulang ke sistem Dukcapil ',
                                        'status' => 401
                                    ];
                                }

                            }else{
                                $isFailed = true;
                                $row->message_failed = [
                                    'responseMessage' => ' Data NIK tidak ditemukan pada Poktan atau Desa, mohon cek data di SIMLUHTAN. 1 hubungi PIC utk pengecekan data poktan dan relasi kode wilayah (desa) ',
                                    'status' => 401
                                ];
                            }
                        }

                    }else{
                        // dd('Tanggal lahir petani di SIMLUHTAN tidak valid.! ');
                        $isFailed = true;
                        $row->message_failed = [
                            'responseMessage' => ' Tanggal lahir petani di SIMLUHTAN tidak valid.! ',
                            'status' => 401
                        ];
                    }

                }else{
                    $isFailed = true;
                    $row->message_failed = [
                        'responseMessage' => ' NIK tidak padan dengan data Dukcapil. Agar memperbaharui data Simluhtan.! ',
                        'status' => 401
                    ];
                }
            }else{
                // dd('planting tidak area sesuai');
                $isFailed = true;

                $row->message_failed = [
                    'responseMessage' => ' planting tidak area sesuai ',
                    'status' => 401
                ];

            }

            if($isFailed){
                array_push($this->failedData, $row);
            }
        }
    }

    public function headingRow(): int
    {
        return 1;
    }

    public function chunkSize(): int
    {
        return 10;
    }

    public function failedRespon()
    {
        return $this->failedData;
    }

}

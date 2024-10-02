<?php

namespace App\Exports;

use App\Models\SubmissionSimluhtan; 
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Models\Area;
use DB;

class RingkasanExport implements FromCollection, WithHeadings
{
    protected $id_status;

    public function __construct($id_status)
    {
        $this->id_status = $id_status;
    }

    public function collection()
    {
        $id = $this->id_status;
        $provinceCode = session('provinceCode');
        $cityCode = session('cityCode');
        $data = [];
       
        
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

        $dataWithIndex = [];
        $total = [
            'jum_baris' => 0,
            'jumnik' => 0,
            'jum_urea' => 0,
            'jum_npk' => 0,
            'jum_npk_formula' => 0,
            'jum_organic' => 0,
            'rencana_tanam' => 0,
        ];

        foreach ($data as $index => $row) {
            $dataWithIndex[] = [
                'number' => $index + 1, // Start numbering from 1
                'district' => $row->district,
                'jum_baris' => $row->jum_baris,
                'jumnik' => $row->jumnik,
                'rencana_tanam' => $row->rencana_tanam,
                'jum_urea' => $row->jum_urea,
                'jum_npk' => $row->jum_npk,
                'jum_npk_formula' => $row->jum_npk_formula,
                'jum_organic' => $row->jum_organic
            ];

              // Accumulate totals
            $total['jum_baris'] += $row->jum_baris;
            $total['jumnik'] += $row->jumnik;
            $total['jum_urea'] += $row->jum_urea;
            $total['jum_npk'] += $row->jum_npk;
            $total['jum_npk_formula'] += $row->jum_npk_formula;
            $total['jum_organic'] += $row->jum_organic;
            $total['rencana_tanam'] += $row->rencana_tanam;
        }

        $dataWithIndex[] = [
            'number' => '', // No number for total row
            'city' => 'Total',
            'jum_baris' => $total['jum_baris'],
            'jumnik' => $total['jumnik'],
            'rencana_tanam' => $total['rencana_tanam'],
            'jum_urea' => $total['jum_urea'],
            'jum_npk' => $total['jum_npk'],
            'jum_npk_formula' => $total['jum_npk_formula'],
            'jum_organic' => $total['jum_organic'],
        ];

        return collect($dataWithIndex);
    }

    public function headings(): array
    {
        return [
            'No.',
            'Kecamatan',
            'Jumlah Baris',
            'Jumlah NIK',
            'Jumlah Rencana Tanam',
            'Jumlah Urea',
            'Jumlah NPK',
            'Jumlah NPK Formula',
            'Jumlah Organic'
        ];

    }
}

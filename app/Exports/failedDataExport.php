<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class failedDataExport implements FromCollection, WithHeadings
{
    protected $data;

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function collection()
    {
        $res = [];
        foreach ($this->data as $key) {

            array_push($res, [
				'nama_penyuluh' => $key['nama_penyuluh'],
				'ktp' => $key['ktp'],
				'kode_desa' => $key['kode_desa'],
				'nama_ibu_kandung' => $key['nama_ibu_kandung'],
				'kode_desa' => $key['kode_desa'],
				'id_poktan' => $key['id_poktan'],
				'kode_kios_pengecer' => $key['kode_kios_pengecer'],
				'subsektor' => $key['subsektor'],
				'komoditas_mt1' => $key['komoditas_mt1'],
				'luas_lahan_ha_mt1' => $key['luas_lahan_ha_mt1'],
				'pupuk_urea_kg_mt1' => $key['pupuk_urea_kg_mt1'],
				'pupuk_npk_kg_mt1' => $key['pupuk_npk_kg_mt1'],
				'pupuk_npk_formula_khusus_kg_mt1' => $key['pupuk_npk_formula_khusus_kg_mt1'],
				'pupuk_organik_kg_mt1' => $key['pupuk_organik_kg_mt1'],
				'komoditas_mt2' => $key['komoditas_mt2'],
				'luas_lahan_ha_mt2' => $key['luas_lahan_ha_mt2'],
				'pupuk_urea_kg_mt2' => $key['pupuk_urea_kg_mt2'],
				'pupuk_npk_kg_mt2' => $key['pupuk_npk_kg_mt2'],
				'pupuk_npk_formula_khusus_kg_mt2' => $key['pupuk_npk_formula_khusus_kg_mt2'],
				'pupuk_organik_kg_mt2' => $key['pupuk_organik_kg_mt2'],
				'komoditas_mt3' => $key['komoditas_mt3'],
				'luas_lahan_ha_mt3' => $key['luas_lahan_ha_mt3'],
				'pupuk_urea_kg_mt3' => $key['pupuk_urea_kg_mt3'],
				'pupuk_npk_kg_mt3' => $key['pupuk_npk_kg_mt3'],
				'pupuk_npk_formula_khusus_kg_mt3' => $key['pupuk_npk_formula_khusus_kg_mt3'],
				'pupuk_organik_kg_mt3' => $key['pupuk_organik_kg_mt3'],
				'message_failed' => $key->message_failed['responseMessage'],
			]);

        }
        return collect($res);
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function headings() :array
    {
        return [
            'Nama Penyuluh',
            'KTP',
            'Nama Ibu Kandung',
            'Kode Desa',
            'ID Poktan',
            'Kode Kios',
            'Subsektor',
            'Komoditas MT1',
            'Luas Lahan (Ha) MT1',
            'Pupuk Urea (Kg) MT1',
            'Pupuk NPK (Kg) MT1',
            'Pupuk NPK Formula Khusus (Kg) MT1',
            'Pupuk Organik (Kg) MT1',
            'Komoditas MT2',
            'Luas Lahan (Ha)  MT2',
            'Pupuk Urea (Kg) MT2',
            'Pupuk NPK (Kg) MT2',
            'Pupuk NPK Formula Khusus (Kg) MT2',
            'Pupuk Organik (Kg) MT2',
            'Komoditas MT3',
            'Luas Lahan (Ha)  MT3',
            'Pupuk Urea (Kg) MT3',
            'Pupuk NPK (Kg) MT3',
            'Pupuk NPK Formula Khusus (Kg) MT3',
            'Pupuk Organik (Kg) MT3',
            'message_failed'
        ];
    }
}

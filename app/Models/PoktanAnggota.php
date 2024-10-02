<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Desa;
use App\Models\SimpadanClean;

class PoktanAnggota extends Model
{
    use HasFactory;

    protected $table = 'tb_poktan_anggota';
    protected $connection = 'second_mysql';
    protected $guarded = [];

    // check if petani eligible by 3 param (nik, poktan, subdistrict_code)
    public function is_eligible_nik($nik, $subdistrict_code, $farmer_group_id){
        $kodeDesaBps = KodeRelasiDesa::select('kode_desa_bps')->where('kode_desa_erdkk', $subdistrict_code)->first();

        $kodeDesa = ($kodeDesaBps) == null ? 0 : $kodeDesaBps->kode_desa_bps;

        $data = Poktan::select(
                        'tb_poktan_anggota.nama_ktp as farmer_name',
                        'tb_poktan_anggota.tempat_lahir as farmer_born_place',
                        'tb_poktan_anggota.tgl_lahir',
                        'tb_poktan_anggota.bln_lahir',
                        'tb_poktan_anggota.thn_lahir',
                        'tb_poktan_anggota.alamat_ktp as farmer_address',
                        'tb_poktan_anggota.titik_koordinat_lahan as field_coordinate',
                        'tb_poktan_anggota.id_anggota as id_agt',
                        'tb_poktan_anggota.no_hp as farmer_phone_number'
                    )
                    ->join('tb_poktan_anggota', 'tb_poktan.id_poktan', '=', 'tb_poktan_anggota.id_poktan')
                    ->join('tbldesa', 'tbldesa.id_desa' ,'=', 'tb_poktan.kode_desa')
                    ->join('tbl_kode_relasi_desa', 'tbl_kode_relasi_desa.kode_desa_bps' ,'=', 'tbldesa.id_desa_new')
                    ->where('tb_poktan_anggota.is_delete', '<>', 1)
                    ->whereRaw("COALESCE(tb_poktan_anggota.nama_ktp, '') != ''")
                    ->whereRaw("COALESCE(tb_poktan_anggota.tempat_lahir, '') != ''")
                    ->whereRaw("COALESCE(tb_poktan_anggota.tgl_lahir, '') != ''")
                    ->whereRaw("COALESCE(tb_poktan_anggota.bln_lahir, '') != ''")
                    ->whereRaw("COALESCE(tb_poktan_anggota.thn_lahir, '') != ''")
                    ->whereRaw("COALESCE(tb_poktan_anggota.titik_koordinat_lahan, '') != ''")
                    ->whereRaw("COALESCE(tb_poktan_anggota.luas_lahan_ternak_dimiliki,
                                tb_poktan_anggota.luas_lahan_ternak_diusahakan) BETWEEN 0 and 2")
                    ->where('tb_poktan_anggota.no_ktp', $nik)
                    ->where('tb_poktan.kode_desa', $kodeDesaBps->kode_desa_bps)
                    ->where('tb_poktan.id_poktan', $farmer_group_id)
                    ->first();

        return $data;
    }

    public function is_eligble_nik_union($nik){

    	$select = $db->select("

           SELECT
           farmer_nik,CASE WHEN batas > 2 THEN 0 ELSE batas
           END AS batas,sts
           FROM(
           SELECT farmer_nik,
           MAX(vol) AS batas,sts
           FROM (

           SELECT no_ktp AS farmer_nik, SUM(luas_lahan_ternak_dimiliki) AS vol,'dimiliki' AS sts
           FROM tb_poktan_anggota WHERE no_ktp = '".$nik."'
           AND id_poktan IN (SELECT id_poktan FROM tb_poktan)
           AND tb_poktan_anggota.is_delete<>1
           UNION ALL
           SELECT no_ktp AS farmer_nik, SUM(luas_lahan_ternak_diusahakan) AS vol,'diusahakan' AS sts
           FROM tb_poktan_anggota WHERE no_ktp = '".$nik."'
           AND id_poktan IN (SELECT id_poktan FROM tb_poktan)
           AND tb_poktan_anggota.is_delete<>1
           UNION ALL
           SELECT '".$nik."' AS farmer_nik, 0 AS vol, '' AS sts

           ) a
           ) b


           ");
    	return $select;

    }

    public function is_eligible_nik_land_area($nik){

        // SELECT no_ktp AS farmer_nik, SUM(luas_lahan_ternak_dimiliki) AS vol,'dimiliki' AS sts
        // FROM tb_poktan_anggota WHERE no_ktp = '6305040904550001'
        // AND id_poktan IN (SELECT id_poktan FROM tb_poktan)
        // AND tb_poktan_anggota.is_delete<>1

            "SELECT
            farmer_nik,
            CASE
            WHEN batas > 2 THEN 0
            ELSE batas
            END AS batas,
            sts
            FROM(
            SELECT farmer_nik,
            MAX(vol) AS batas, sts
            FROM (
            SELECT no_ktp AS farmer_nik, SUM(luas_lahan_ternak_dimiliki) AS vol,'dimiliki' AS sts
            FROM tb_poktan_anggota WHERE no_ktp = '6305040904550001'
            AND id_poktan IN (SELECT id_poktan FROM tb_poktan)
            AND tb_poktan_anggota.is_delete<>1
            UNION ALL
            SELECT no_ktp AS farmer_nik, SUM(luas_lahan_ternak_diusahakan) AS vol,'diusahakan' AS sts
            FROM tb_poktan_anggota WHERE no_ktp = '6305040904550001'
            AND id_poktan IN (SELECT id_poktan FROM tb_poktan)
            AND tb_poktan_anggota.is_delete<>1
            UNION ALL
            SELECT '6305040904550001' AS farmer_nik, 0 AS vol, '' AS sts
            ) a
            ) b";

    }

    public function is_validate_poktan($nik, $id_poktan, $kode_desa_erdkk){

       $data = Desa::select(
        'tbl_kode_relasi_desa.kode_prop_bps',
        'tb_poktan.nama_poktan',
        'tb_poktan.id_poktan',
        'tbl_kode_relasi_desa.kode_desa_erdkk',
        'tbl_kode_relasi_desa.nama_desa_bps',
        'tbldesa.id_desa',
        'tb_poktan_anggota.nama_ktp',
        'tb_poktan_anggota.no_ktp'
       )
       ->join('tbl_kode_relasi_desa', 'tbldesa.id_desa_new', '=', 'tbl_kode_relasi_desa.kode_desa_bps')
       ->join('tb_poktan', 'tbldesa.id_desa', '=', 'tb_poktan.kode_desa')
       ->join('tb_poktan_anggota', 'tb_poktan.id_poktan', '=', 'tb_poktan_anggota.id_poktan')
       ->where('tb_poktan_anggota.is_delete', '<>', 1)
       ->where('tbl_kode_relasi_desa.kode_desa_erdkk', $kode_desa_erdkk)
       ->where('tb_poktan_anggota.no_ktp', $nik)
       ->where('tb_poktan.id_poktan', $id_poktan)
       ->first();

       return $data;
    }

    public function get_padan_nik($nik){
        $data = SimpadanClean::select('id','nik','nik as no_ktp','nama', 'tempat_lahir','tanggal_lahir','jenis_kelamin','created_at',
                                'updated_at','status','valid_until','kd_prov','kd_kab','kd_kec','kd_desa','msg_dukcapil','status_nik',
                                'status_tempat_lahir','status_tanggal_lahir','status_jenis_kelamin','status_meninggal','status_poktan_anggota')
                                ->where('nik',$nik)->where('status', 2)
                                ->first();

        return $data;

    }

}

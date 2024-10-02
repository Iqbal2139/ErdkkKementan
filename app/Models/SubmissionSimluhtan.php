<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class SubmissionSimluhtan extends Model
{
    use HasFactory;

    protected $table = 'submissions_simluhtan';
    protected $guarded = [];

    public function area(){
        return $this->belongsTo(Desa::class, 'sub_district_code', 'id');
    }

    public function status(){
        return $this->belongsTo(SubmissionStatus::class, 'status', 'id');
    }

    public function farmerGroup(){
        return $this->belongsTo(FarmerGroup::class, 'farmer_group_id', 'id');
    }

    public function retailer(){
        return $this->belongsTo(Retailer::class, 'retailer_id', 'id');
    }

    public function get_sum_by_nik($year, $nik)
    {
        $sub = DB::table("201_submissions_simluhtan_alo")
            ->selectRaw('sum(mt1_planting_area) total_mt1, sum(mt2_planting_area) total_mt2, sum(mt3_planting_area) total_mt3, farmer_nik')
            ->where('farmer_nik', $nik)
            ->where('year', $year)
            ->groupBy('farmer_nik');

        $union = DB::connection($this->connection)
            ->query()
            ->selectRaw('0,0,0, '.$nik.'');

        $data = DB::connection($this->connection)
            ->query()
            ->select('*')
            ->fromSub($sub, DB::raw('a'))
            ->unionAll($union)
            ->first();

        return $data;
    }

}

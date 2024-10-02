<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    use HasFactory;

    protected $table = 'areas';
    protected $guarded = [];

    public function submissions(){
        return $this->hasMany(SubmissionSimluhtan::class, 'sub_district_code', 'sub_district_code');
    }

    public function retailers(){
        return $this->hasMany(Retailer::class, 'sub_district_code', 'sub_district_code');
     }

}

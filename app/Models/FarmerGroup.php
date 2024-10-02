<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FarmerGroup extends Model
{
    use HasFactory;

    protected $table = 'farmer_groups';
    protected $guarded = [];

    protected $fillable = [
		'name',
		'sub_district_code'
	];

    public function submissions(){
        return $this->belongsToMany(SubmissionSimluhtan::class);
    }
}

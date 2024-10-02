<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Retailer extends Model
{
    use HasFactory;

    protected $table = 'retailers';
    protected $guarded = [];

    protected $fillable = [
		'pihc_code',
		'name',
		'sub_district_code',
        'is_active'
	];

    public function submissions(){
        return $this->belongsToMany(SubmissionSimluhtan::class);
    }

    public function area()
    {
        return $this->belongsTo(Area::class, 'sub_district_code', 'sub_district_code');
    }

}

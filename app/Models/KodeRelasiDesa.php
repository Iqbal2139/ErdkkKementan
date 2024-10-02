<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KodeRelasiDesa extends Model
{
    use HasFactory;

    protected $table = 'tbl_kode_relasi_desa';
    protected $connection = 'second_mysql';
    protected $guarded = [];
}

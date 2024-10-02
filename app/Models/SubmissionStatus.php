<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubmissionStatus extends Model
{
    use HasFactory;

    protected $table = 'submission_status';
    protected $guarded = [];

    public function submissions(){
        return $this->belongsToMany(SubmissionSimluhtan::class, 'id', 'status');
    }
}

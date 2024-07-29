<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TimeLine extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'job_to_do',
        'date_start',
        'date_end',
        'result_must_reach',
        'is_weekly',
        'is_monthly',
        'id_employee'
    ];
    protected $table = 'TimeLine';
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subject extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'amount',
        'date_begin',
        'total_month',
        'date_in_week',
        'time_start',
        'time_one_session',
        'id_teacher'
    ];

    protected $table = 'Subject';
}

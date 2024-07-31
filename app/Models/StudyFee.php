<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StudyFee extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'id_subject',
        'id_student',
        'id_employee',
        'date_collect'
    ];

    protected $table = 'study_fees';
}

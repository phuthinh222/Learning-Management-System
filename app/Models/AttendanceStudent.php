<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AttendanceStudent extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['id_student', 'id_subject', 'date', 'is_attend'];

    protected $table = 'attendance_students';
}

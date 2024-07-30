<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AttendanceTeacher extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['id_teacher', 'id_attendance'];
    protected $table = 'attendance_teachers';
}

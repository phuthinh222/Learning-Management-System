<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Teacher extends Model
{
    use HasFactory;

    protected $table = 'teachers';

    protected $fillable = [
        'department',
        'position',
        'status',
    ];
    public function user(): MorphOne
    {
        return $this->morphOne(User::class, 'userable');
    }
    public function certificates()
    {
        return $this->hasMany(Certificate::class, 'id_teacher');
    }
    public function experiences()
    {
        return $this->hasMany(Experience::class, 'id_teacher');
    }
    public function courses()
    {
        return $this->hasMany(Course::class, 'id_teacher');
    }
}

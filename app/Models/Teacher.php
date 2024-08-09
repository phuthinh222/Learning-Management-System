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
        'id_certificate',
        'id_experience',
        'department',
        'position',
        'status',
    ];
    public function user(): MorphOne
    {
        return $this->morphOne(User::class, 'userable');
    }
}

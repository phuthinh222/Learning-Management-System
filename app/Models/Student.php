<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['note', 'average_grade', 'id_parent'];

    protected $table = 'students';

    public function user(): MorphOne
    {
        return $this->morphOne(User::class, 'userable');
    }
}

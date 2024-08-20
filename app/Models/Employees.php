<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employees extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['status'];

    protected $table = 'employees';

    public function user(): MorphOne
    {
        return $this->morphOne(User::class, 'userable');
    }
}

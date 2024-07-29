<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SalaryType extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name', 'symbol', 'amount'];

    protected $table = 'SalaryType';
}

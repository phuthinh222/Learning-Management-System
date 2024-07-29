<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Marketing extends Model
{
    use HasFactory, SoftDeletes;
    
    protected $fillable = [
        'title',
        'content',
        'date_post',
        'id_employee'
    ];

    protected $table = 'Marketing';
}

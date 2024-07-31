<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CenterCost extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name', 'amount', 'date', 'description', 'note', 'id_employee'];

    protected $table = 'center_costs';
}

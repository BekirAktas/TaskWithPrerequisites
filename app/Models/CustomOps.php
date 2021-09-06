<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomOps extends Model
{
    use HasFactory;

    protected $table = 'custom_ops';
    public $timestamps = false;

    protected $fillable = [
        'task_id',
        'country'
    ];
}

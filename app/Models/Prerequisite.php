<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prerequisite extends Model
{
    use HasFactory;

    protected $table = 'prerequisites';

    protected $fillable = [
        'id',
        'task_id',
        'prerequisite_task_id'
    ];
}

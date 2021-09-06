<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $table = 'Tasks';
    protected $fillable = [
        'id',
        'title',
        'type'
    ];

    public function prerequisites() {
        return $this->hasMany(Prerequisite::class);
    }
}

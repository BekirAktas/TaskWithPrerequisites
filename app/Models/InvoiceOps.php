<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceOps extends Model
{
    use HasFactory;

    protected $table = 'invoice_ops';
    public $timestamps = false;

    protected $fillable = [
        'task_id',
        'currency',
        'quantity'
    ];
}

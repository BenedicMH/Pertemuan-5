<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupplierBook extends Model
{
    /** @use HasFactory<\Database\Factories\SupplierBookFactory> */
    use HasFactory;

    protected $fillable = [
        'supplier_id',
        'book_id',
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Phone extends Model
{
    /** @use HasFactory<\Database\Factories\PhoneFactory> */
    use HasFactory;

    protected $fillable = [
        'model',
        'year',
    ];

    public function book()
    {
        return $this->belongsTo(Book::class, 'book_id');
    }
}

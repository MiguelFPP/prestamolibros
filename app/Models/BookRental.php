<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookRental extends Model
{
    use HasFactory;

    protected $fillable = ['quantity'];
    protected $table = 'book_rental';

    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    public function rental()
    {
        return $this->belongsTo(Rental::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Book extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['title', 'edition', 'published_at', 'stock', 'author_id'];

    public function author()
    {
        return $this->belongsTo(Author::class)->withTrashed('deleted_at');
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class)->withTrashed('deleted_at');
    }

    public function rentals()
    {
        return $this->belongsToMany(Rental::class);
    }
}

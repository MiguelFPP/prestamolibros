<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Loan extends Model
{
    use HasFactory, Notifiable;

    protected $dates = ['date_start', 'date_end'];
    protected $fillable = [
        'date_start',
        'date_end',
        'status',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class)->withOut('password');
    }

    public function book_loans()
    {
        return $this->hasMany(BookLoan::class);
    }
}

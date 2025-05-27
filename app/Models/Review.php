<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;
    public $table = 'Review';
    protected $fillable = [
        'pickup',
        'destination',
        'rating',
        'comment',
        'city',
    ];

    protected $appends = [
        'user_id',
        'driver_id',
        'id_url',
    ];

    protected $dates = ['updated_at'];
}

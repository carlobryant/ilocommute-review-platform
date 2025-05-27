<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    use HasFactory;
    public $table = 'Driver';
    protected $fillable = [
        'plate_no',
        'brgy',
        'city',
    ];

    protected $hidden = [
        'rating_tot',
    ];
}

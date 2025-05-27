<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    use HasFactory;
    public $table = 'Person';
    protected $fillable = [
        'user_id',
        'fname',
        'lname',
        'age',
        'gender',
        'type',
    ];
}

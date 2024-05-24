<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Logged extends Model
{

    protected $table = "logged";
    protected $fillable = [
        'id',
        'usetId',
        'date',
        'timeIn',
        'timeOut'
    ];

    use HasFactory;
}

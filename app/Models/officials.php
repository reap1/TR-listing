<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class officials extends Model
{
    use HasFactory;
    protected $fillable = [
        'position','pp','location','brgname','fname','lname','sex','contact'
    ];
    public $timestamps = false;
}

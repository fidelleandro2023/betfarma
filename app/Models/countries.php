<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class countries extends Model
{
    use HasFactory;
    protected $table = 'countries';
    protected $fillable = [
        'code','iso','name','nicename','iso3','numcode','phonecode'
        ];
}

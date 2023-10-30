<?php

 namespace App\Models;
 use App\Models\User;
 use Illuminate\Database\Eloquent\Factories\HasFactory;
 use Illuminate\Database\Eloquent\Model;

 class role extends Model
 {
     use HasFactory;

     protected $fillable = [
       'name','description','status'     ];
 }

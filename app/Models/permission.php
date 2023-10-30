<?php

 namespace App\Models;
 use App\Models\User;
 use Illuminate\Database\Eloquent\Factories\HasFactory;
 use Illuminate\Database\Eloquent\Model;

 class permission extends Model
 {
     use HasFactory;

     protected $fillable = [
       'name','description','status'     ];
 }

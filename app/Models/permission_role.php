<?php

 namespace App\Models;
 use App\Models\User;
 use Illuminate\Database\Eloquent\Factories\HasFactory;
 use Illuminate\Database\Eloquent\Model;

 class permission_role extends Model
 {
     use HasFactory;

     protected $fillable = [
       'create','read','write','delete','append','role_id','permission_id'     ];
 }

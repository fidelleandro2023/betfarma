<?php

 namespace App\Models;
 use App\Models\User;
 use Illuminate\Database\Eloquent\Factories\HasFactory;
 use Illuminate\Database\Eloquent\Model;

 class people extends Model
 {
     use HasFactory;

     protected $fillable = [
       'name','lastname','address','landline','birthdate,gender','main_phone','secondary_phone','document_types_id','document_number','status'     ];

      
 }

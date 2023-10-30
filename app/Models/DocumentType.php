<?php

 namespace App\Models;
 use App\Models\User;
 use Illuminate\Database\Eloquent\Factories\HasFactory;
 use Illuminate\Database\Eloquent\Model;

 class DocumentType extends Model
 {
     use HasFactory;

     protected $fillable = [
       'name','control','descripcion','type','max'];
 }

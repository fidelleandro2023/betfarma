<?php
namespace App\Helpers;
use App\Models\Category;

class loadModels
{
    public $modelo = null;

    public function index($model){
        $this->modelo = new $model(); 
    }
}
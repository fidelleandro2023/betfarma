@extends('layouts.app')
@section('content')
<div class="row">
 <div class="card text-white bg-primary mb-3 col-4">
   <a href="{{ route('categories.list') }}" class="text-white" style="color:#fff">
       <div class="card-header">List</div>
       <div class="card-body">
         <h5 class="card-title">Lista de categories</h5>
         <p class="card-text"></p>
       </div>
  </a>
 </div>
 <div class="card text-white bg-primary mb-3 col-4">
   <a href="{{ route('categories.create') }}" class="text-white" style="color:#fff">
       <div class="card-header">Register</div>
       <div class="card-body">
         <h5 class="card-title">Crear category</h5>
         <p class="card-text"></p>
       </div>
  </a>
 </div>
 <div class="card text-white bg-primary mb-3 col-4">
   <a href="{{ route('categories.YearRegister', date('Y') ) }}" class="text-white" style="color:#fff">
       <div class="card-header">Graphic</div>
       <div class="card-body">
         <h5 class="card-title">Gráfico de registros por año / category</h5>
         <p class="card-text"></p>
       </div>
  </a>
 </div>
 <div class="card text-white bg-primary mb-3 col-4">
   <a href="{{ route('categories.MonthRegister',['year' => date('Y') ,'mes' => date('m') ]) }}" class="text-white" style="color:#fff">
       <div class="card-header">Graphic</div>
       <div class="card-body">
         <h5 class="card-title">Gráfico de registros por mes / category</h5>
         <p class="card-text"></p>
       </div>
  </a>
 </div>
 <div class="card text-white bg-primary mb-3 col-4">
   <a href="{{ route('categories.BetweenMonthRegister',['year' => date('Y') ,'f_mes' => date('m'),'l_mes' => date('m')+1]) }}" class="text-white" style="color:#fff">
       <div class="card-header">Graphic</div>
       <div class="card-body">
         <h5 class="card-title">Gráfico de registros mes por mes / category</h5>
         <p class="card-text"></p>
       </div>
  </a>
 </div>
</div>
@endsection

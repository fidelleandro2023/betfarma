@extends('layouts.app')
@section('content')
<div class="container">
 <div class="row">
 <div class="col-4">
  <a href="{{ route('categories.list') }}" class="text-white link_card">
   <div class="card text-white bg-primary">
       <div class="card-header text-uppercase">List</div>
       <div class="card-body bg-secondary">
         <h5 class="card-title">Lista de categories</h5>
         <p class="card-text"></p>
       </div>
       <div class="card-footer bg-dark border-success">Footer</div>
   </div>
 </a>
 </div>
 <div class="col-4">
  <a href="{{ route('categories.create') }}" class="text-white link_card">
   <div class="card text-white bg-primary">
       <div class="card-header text-uppercase">Register</div>
       <div class="card-body bg-secondary">
         <h5 class="card-title">Crear category</h5>
         <p class="card-text"></p>
       </div>
       <div class="card-footer bg-dark border-success">Footer</div>
   </div>
 </a>
 </div>
 <div class="col-4">
  <a href="{{ route('categories.YearRegister', date('Y') ) }}" class="text-white link_card">
   <div class="card text-white bg-primary">
       <div class="card-header text-uppercase">Graphic</div>
       <div class="card-body bg-secondary">
         <h5 class="card-title">Gráfico de registros por año / category</h5>
         <p class="card-text"></p>
       </div>
       <div class="card-footer bg-dark border-success">Footer</div>
   </div>
 </a>
 </div>
 <div class="col-4">
  <a href="{{ route('categories.MonthRegister',['year' => date('Y') ,'mes' => date('m') ]) }}" class="text-white link_card">
   <div class="card text-white bg-primary">
       <div class="card-header text-uppercase">Graphic</div>
       <div class="card-body bg-secondary">
         <h5 class="card-title">Gráfico de registros por mes / category</h5>
         <p class="card-text"></p>
       </div>
       <div class="card-footer bg-dark border-success">Footer</div>
   </div>
 </a>
 </div>
 <div class="col-4">
  <a href="{{ route('categories.BetweenMonthRegister',['year' => date('Y') ,'f_mes' => date('m'),'l_mes' => date('m')+1]) }}" class="text-white link_card">
   <div class="card text-white bg-primary">
       <div class="card-header text-uppercase">Graphic</div>
       <div class="card-body bg-secondary">
         <h5 class="card-title">Gráfico de registros mes por mes / category</h5>
         <p class="card-text"></p>
       </div>
       <div class="card-footer bg-dark border-success">Footer</div>
   </div>
 </a>
 </div>
 </div>
</div>
@endsection

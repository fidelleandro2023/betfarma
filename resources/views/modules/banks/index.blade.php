@extends('layouts.dashboard')
@section('content')
<div class="row column_title">
   <div class="col-md-12">
      <div class="page_title">
        <h2>Menú banks</h2>
      </div>
   </div>
</div>
 <div class="row">
 <div class="col-4">
  <a href="{{ route('banks.list') }}" class="text-white link_card">
   <div class="card text-white bg-primary">
       <div class="card-header text-uppercase">List</div>
       <div class="card-body bg-secondary">
         <h5 class="card-title">Lista de banks</h5>
         <p class="card-text"></p>
       </div>
       <div class="card-footer bg-dark border-success">Footer</div>
   </div>
 </a>
 </div>
 <div class="col-4">
  <a href="{{ route('banks.create') }}" class="text-white link_card">
   <div class="card text-white bg-primary">
       <div class="card-header text-uppercase">Register</div>
       <div class="card-body bg-secondary">
         <h5 class="card-title">Crear bank</h5>
         <p class="card-text"></p>
       </div>
       <div class="card-footer bg-dark border-success">Footer</div>
   </div>
 </a>
 </div>
 <div class="col-4">
  <a href="{{ route('banks.YearRegister', date('Y') ) }}" class="text-white link_card">
   <div class="card text-white bg-primary">
       <div class="card-header text-uppercase">Graphic</div>
       <div class="card-body bg-secondary">
         <h5 class="card-title">Gráfico de registros por año / bank</h5>
         <p class="card-text"></p>
       </div>
       <div class="card-footer bg-dark border-success">Footer</div>
   </div>
 </a>
 </div>
 <div class="col-4">
  <a href="{{ route('banks.MonthRegister',['year' => date('Y') ,'mes' => date('m') ]) }}" class="text-white link_card">
   <div class="card text-white bg-primary">
       <div class="card-header text-uppercase">Graphic</div>
       <div class="card-body bg-secondary">
         <h5 class="card-title">Gráfico de registros por mes / bank</h5>
         <p class="card-text"></p>
       </div>
       <div class="card-footer bg-dark border-success">Footer</div>
   </div>
 </a>
 </div>
 <div class="col-4">
  <a href="{{ route('banks.BetweenMonthRegister',['year' => date('Y') ,'f_mes' => date('m'),'l_mes' => date('m')+1]) }}" class="text-white link_card">
   <div class="card text-white bg-primary">
       <div class="card-header text-uppercase">Graphic</div>
       <div class="card-body bg-secondary">
         <h5 class="card-title">Gráfico de registros mes por mes / bank</h5>
         <p class="card-text"></p>
       </div>
       <div class="card-footer bg-dark border-success">Footer</div>
   </div>
 </a>
 </div>
 </div>
@endsection

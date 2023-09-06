@extends('layouts.app')
@section('content')
<div class="container">
 <div class="max-w-4xl mx-auto mt-8">
  <div class="mb-4">
    <h1 class="text-3xl font-bold">
        Gráfico de registros por año / category
    </h1>
  </div>
 </div>
 <div class="chart-container row" style="position: relative; ">
   <div class="col">
     <canvas id="myChartBar" width="400px" height="100%"></canvas>
   </div>
   <div class="col">
     <canvas id="myChartLine" width="400px" height="100%"></canvas>
   </div> 
 </div>
</div>
@endsection
@push('scripts')
 <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.1.4/Chart.min.js"></script>
 <script type="text/javascript">
  var labels =  {{ Js::from($labels) }};
  var datos =  {{ Js::from($data) }};
  const data = {
  labels: labels,
  datasets: [{
   label: {{ Js::from($label) }},
   backgroundColor: 'rgb(255, 99, 132)',
   borderColor: 'rgb(255, 99, 132)',
   data: datos,
  }]
  };
  const config1 = {
     type: 'bar',
     data: data,
     options: {}
   };
  const config2 = {
     type: 'line',
     data: data,
     options: {}
   };
  const myChart1 = new Chart(
   document.getElementById('myChartBar'),
   config1
  );
  const myChart2 = new Chart(
   document.getElementById('myChartLine'),
   config2
  );
 </script>
@endpush('scripts')

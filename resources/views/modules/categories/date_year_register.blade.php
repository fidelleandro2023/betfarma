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
</div>
@endsection
@push('scripts')
 <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.0/chart.min.js"></script>
 <script type="text/javascript">
  var labels =  {{ Js::from($labels) }};
  var datos =  {{ Js::from($data) }};
  const data = {
  labels: labels,
  datasets: [{
   label: 'My First dataset',
   backgroundColor: 'rgb(255, 99, 132)',
   borderColor: 'rgb(255, 99, 132)',
   data: datos,
  }]
  };
  const config = {
   type: 'line',
   data: data,
   options: {}
  };
  const myChart = new Chart(
   document.getElementById('myChart'),
   config
  );
 </script>
@endpush('scripts')

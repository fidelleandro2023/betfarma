@extends('layouts.dashboard')
@section('content')
<div class="row column_title">
   <div class="col-md-12">
      <div class="page_title">
        <h2>Mostrar bank</h2>
      </div>
   </div>
</div>
 <div class="max-w-4xl mx-auto mt-8">
  <div class="mb-4">
    <div class="flex justify-end mt-5">
        <a class="px-2 py-1 rounded-md bg-sky-500 text-sky-100 hover:bg-sky-600" href="{{ route('banks.index') }}">< Atrás</a>
    </div>
  </div>
 </div>
<div class="flex flex-col mt-5">
  <div class="w-full px-6 py-4 bg-white rounded shadow-md ring-1 ring-gray-900/10">
    <h3 class="text-2xl font-semibold"> name </h3>
    <p class="text-base text-gray-700 mt-5">{{ $bank->name }}</p>
  </div>
</div>
<div class="flex flex-col mt-5">
  <div class="w-full px-6 py-4 bg-white rounded shadow-md ring-1 ring-gray-900/10">
    <h3 class="text-2xl font-semibold"> description </h3>
    <p class="text-base text-gray-700 mt-5">{{ $bank->description }}</p>
  </div>
</div>
<div class="flex flex-col mt-5">
  <div class="w-full px-6 py-4 bg-white rounded shadow-md ring-1 ring-gray-900/10">
    <h3 class="text-2xl font-semibold"> created_at </h3>
    <p class="text-base text-gray-700 mt-5">{{ $bank->created_at }}</p>
  </div>
</div>
<div class="flex flex-col mt-5">
  <div class="w-full px-6 py-4 bg-white rounded shadow-md ring-1 ring-gray-900/10">
    <h3 class="text-2xl font-semibold"> updated_at </h3>
    <p class="text-base text-gray-700 mt-5">{{ $bank->updated_at }}</p>
  </div>
</div>
@endsection

@extends('layouts.app')
@section('content')
<div class="container">
 <div class="max-w-4xl mx-auto mt-8">
  <div class="mb-4">
    <h1 class="text-3xl font-bold">
        Mostrar category
    </h1>
    <div class="flex justify-end mt-5">
        <a class="px-2 py-1 rounded-md bg-sky-500 text-sky-100 hover:bg-sky-600" href="{{ route('categories.index') }}">< Atrás</a>
    </div>
  </div>
 </div>
<div class="flex flex-col mt-5">
  <div class="w-full px-6 py-4 bg-white rounded shadow-md ring-1 ring-gray-900/10">
    <h3 class="text-2xl font-semibold"> name </h3>
    <p class="text-base text-gray-700 mt-5">{{ $category->name }}</p>
  </div>
</div>
<div class="flex flex-col mt-5">
  <div class="w-full px-6 py-4 bg-white rounded shadow-md ring-1 ring-gray-900/10">
    <h3 class="text-2xl font-semibold"> description </h3>
    <p class="text-base text-gray-700 mt-5">{{ $category->description }}</p>
  </div>
</div>
<div class="flex flex-col mt-5">
  <div class="w-full px-6 py-4 bg-white rounded shadow-md ring-1 ring-gray-900/10">
    <h3 class="text-2xl font-semibold"> short </h3>
    <p class="text-base text-gray-700 mt-5">{{ $category->short }}</p>
  </div>
</div>
<div class="flex flex-col mt-5">
  <div class="w-full px-6 py-4 bg-white rounded shadow-md ring-1 ring-gray-900/10">
    <h3 class="text-2xl font-semibold"> parent_id </h3>
    <p class="text-base text-gray-700 mt-5">{{ $category->parent_id }}</p>
  </div>
</div>
<div class="flex flex-col mt-5">
  <div class="w-full px-6 py-4 bg-white rounded shadow-md ring-1 ring-gray-900/10">
    <h3 class="text-2xl font-semibold"> reference </h3>
    <p class="text-base text-gray-700 mt-5">{{ $category->reference }}</p>
  </div>
</div>
<div class="flex flex-col mt-5">
  <div class="w-full px-6 py-4 bg-white rounded shadow-md ring-1 ring-gray-900/10">
    <h3 class="text-2xl font-semibold"> user_id </h3>
    <p class="text-base text-gray-700 mt-5">{{ $category->user_id }}</p>
  </div>
</div>
<div class="flex flex-col mt-5">
  <div class="w-full px-6 py-4 bg-white rounded shadow-md ring-1 ring-gray-900/10">
    <h3 class="text-2xl font-semibold"> created_at </h3>
    <p class="text-base text-gray-700 mt-5">{{ $category->created_at }}</p>
  </div>
</div>
<div class="flex flex-col mt-5">
  <div class="w-full px-6 py-4 bg-white rounded shadow-md ring-1 ring-gray-900/10">
    <h3 class="text-2xl font-semibold"> updated_at </h3>
    <p class="text-base text-gray-700 mt-5">{{ $category->updated_at }}</p>
  </div>
</div>
</div>

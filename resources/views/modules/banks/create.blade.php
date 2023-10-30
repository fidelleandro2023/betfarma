@extends('layouts.dashboard')
@section('content')
<div class="row column_title">
   <div class="col-md-12">
      <div class="page_title">
        <h2>Crear bank</h2>
      </div>
   </div>
</div>
<div class="flex flex-col items-center min-h-screen pt-6 bg-gray-100 sm:justify-center sm:pt-0">
    <div class="w-full px-16 py-20 mt-6 overflow-hidden bg-white rounded-lg lg:max-w-4xl">
  <div class="w-full px-6 py-4 bg-white rounded shadow-md ring-1 ring-gray-900/10">
      <form method="POST" action="{{ route('banks.store') }}">
        @csrf
          <!-- varchar(255) -->
          <div>
              <label class="block text-sm font-medium text-gray-700" for="bank_name">
                name 
              </label>
                <input id="bank_name"
                class="form-control block w-full mt-1 border-gray-300 rounded-md shadow-sm placeholder:text-gray-400 placeholder:text-right focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                type="text" name="name" placeholder="Input name" value="{{old('name')}}">
              @error('name')
              <span class="text-red-600 text-sm">
                {{ $message }}
              </span>
              @enderror
         </div>
          <!-- varchar(255) -->
          <div>
              <label class="block text-sm font-medium text-gray-700" for="bank_description">
                description 
              </label>
                <input id="bank_description"
                class="form-control block w-full mt-1 border-gray-300 rounded-md shadow-sm placeholder:text-gray-400 placeholder:text-right focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                type="text" name="description" placeholder="Input description" value="{{old('description')}}">
              @error('description')
              <span class="text-red-600 text-sm">
                {{ $message }}
              </span>
              @enderror
         </div>
                    <br>
                    <button type="submit" class="btn btn-primary">Crear bank</button>
            </form>
        </div>
    </div>
</div>
@endsection

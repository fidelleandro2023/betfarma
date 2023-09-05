@extends('layouts.app')
@section('content')
<div class="container">
  <div class="flex flex-col items-center min-h-screen pt-6 bg-gray-100 sm:justify-center sm:pt-0">
    <div class="w-full px-16 py-20 mt-6 overflow-hidden bg-white rounded-lg lg:max-w-4xl">
        <div class="mb-4">
            <h1 class="font-serif text-3xl font-bold">Editar category</h1>
        </div>
    <div class="w-full px-6 py-4 bg-white rounded shadow-md ring-1 ring-gray-900/10">
      <form method="POST" action="{{ route('categories.update',$category->id) }}">
        @csrf
        @method('PUT')
          <!-- varchar(255) -->
          <div>
              <label class="block text-sm font-medium text-gray-700" for="category_name">
                name *
              </label>
                <input id="category_name"
                class="form-control block w-full mt-1 border-gray-300 rounded-md shadow-sm placeholder:text-gray-400 placeholder:text-right focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                type="text" name="name" placeholder="Input name" value="{{ $category->name }}">
              @error('name')
              <span class="text-red-600 text-sm">
                {{ $message }}
              </span>
              @enderror
         </div>
          <!-- varchar(255) -->
          <div>
              <label class="block text-sm font-medium text-gray-700" for="category_description">
                description *
              </label>
                <input id="category_description"
                class="form-control block w-full mt-1 border-gray-300 rounded-md shadow-sm placeholder:text-gray-400 placeholder:text-right focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                type="text" name="description" placeholder="Input description" value="{{ $category->description }}">
              @error('description')
              <span class="text-red-600 text-sm">
                {{ $message }}
              </span>
              @enderror
         </div>
          <!-- varchar(255) -->
          <div>
              <label class="block text-sm font-medium text-gray-700" for="category_short">
                short *
              </label>
                <input id="category_short"
                class="form-control block w-full mt-1 border-gray-300 rounded-md shadow-sm placeholder:text-gray-400 placeholder:text-right focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                type="text" name="short" placeholder="Input short" value="{{ $category->short }}">
              @error('short')
              <span class="text-red-600 text-sm">
                {{ $message }}
              </span>
              @enderror
         </div>
          <!-- bigint select-->
          <div>
              <label class="block text-sm font-medium text-gray-700" for="category_parent_id">
                parent_id 
              </label>
                <select id="category_parent_id"
                class="form-control block w-full mt-1 border-gray-300 rounded-md shadow-sm placeholder:text-gray-400 placeholder:text-right focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                 name="parent_id" placeholder="180">
                          <option value="0">Superior</option>
                  @foreach ($parent_id as $item)
                    <option value="{{ $item->id }}">
                        @if(isset($item->name))
                          {{ $item->name }}
                        @else
                          @if(isset($item->title))
                           {{ $item->title }}
                          @else
                           @if(isset($item->description))
                           {{ $item->description }}
                           @endif
                          @endif
                        @endif
                    </option>
                  @endforeach()
                </select>
              @error('parent_id')
              <span class="text-red-600 text-sm">
                {{ $message }}
              </span>
              @enderror
         </div>
          <!-- varchar(255) -->
          <div>
              <label class="block text-sm font-medium text-gray-700" for="category_reference">
                reference *
              </label>
                <input id="category_reference"
                class="form-control block w-full mt-1 border-gray-300 rounded-md shadow-sm placeholder:text-gray-400 placeholder:text-right focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                type="text" name="reference" placeholder="Input reference" value="{{ $category->reference }}">
              @error('reference')
              <span class="text-red-600 text-sm">
                {{ $message }}
              </span>
              @enderror
         </div>
          <!-- bigint unsigned select-->
          <div>
              <label class="block text-sm font-medium text-gray-700" for="category_user_id">
                user_id 
              </label>
                <select id="category_user_id"
                class="form-control block w-full mt-1 border-gray-300 rounded-md shadow-sm placeholder:text-gray-400 placeholder:text-right focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                 name="user_id" placeholder="180">
                          <option value="">Seleccione user_id</option>
                  @foreach ($user_id as $item)
                    <option value="{{ $item->id }}">
                        @if(isset($item->name))
                          {{ $item->name }}
                        @else
                          @if(isset($item->title))
                           {{ $item->title }}
                          @else
                           @if(isset($item->description))
                           {{ $item->description }}
                           @endif
                          @endif
                        @endif
                    </option>
                  @endforeach()
                </select>
              @error('user_id')
              <span class="text-red-600 text-sm">
                {{ $message }}
              </span>
              @enderror
         </div>
                    <br>
                    <button type="submit" class="btn btn-primary">Actualizar category</button>
            </form>
        </div>
    </div>
</div>
</div>

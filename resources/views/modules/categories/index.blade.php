@extends('layouts.app')
@section('content')
<div class="container max-w-6xl mx-auto mt-20">
 <div class="mb-4">
   <h1 class="font-serif text-3xl font-bold underline decoration-gray-400"> categories Index</h1>
   @if (session()->has('message'))
    <div class="p-3 rounded bg-green-500 text-green-100 my-2">
      {{ session('message') }}
    </div>
   @endif
   <div class="flex justify-end">
    <a href="{{ route('categories.create') }}"
     class="px-4 py-2 rounded-md bg-sky-500 text-sky-100 hover:bg-sky-600">Crear categories</a>
   </div>
 </div>
 <div class="flex flex-col">
   <div class="overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
     <div class="inline-block min-w-full overflow-hidden align-middle border-b border-gray-200 shadow sm:rounded-lg">
       <table class="min-w-full">
          <thead>
            <tr>
             <th               class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
             id</th>
             <th               class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
             name</th>
             <th               class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
             description</th>
             <th               class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
             short</th>
             <th               class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
             parent_id</th>
             <th               class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
             reference</th>
             <th               class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
             user_id</th>
             <th class="px-6 py-3 text-sm text-left text-gray-500 border-b border-gray-200 bg-gray-50" colspan="2">
               Action</th>
            </tr>
      </thead>
      <tbody class="bg-white">
        @foreach ($category as $item)
        <tr>
              <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                <div class="flex items-center">
                        {{ $item->id }}
                 </div>
              </td>
              <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                <div class="flex items-center">
                        {{ $item->name }}
                 </div>
              </td>
              <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                <div class="flex items-center">
                        {{ $item->description }}
                 </div>
              </td>
              <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                <div class="flex items-center">
                        {{ $item->short }}
                 </div>
              </td>
              <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                <div class="flex items-center">
                        {{ $item->parent_id }}
                 </div>
              </td>
              <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                <div class="flex items-center">
                        {{ $item->reference }}
                 </div>
              </td>
              <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                <div class="flex items-center">
                        {{ $item->user_id }}
                 </div>
              </td>
              <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                <div class="flex items-center">
                 </div>
              </td>
              <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                <div class="flex items-center">
                 </div>
              </td>
              <td>
                 <form action="{{ route('categories.destroy',$item->id) }}" method="POST">
                   <a class="btn btn-info" href="{{ route('categories.show',$item->id) }}">Mostrar</a>
                   <a class="btn btn-primary" href="{{ route('categories.edit',$item->id) }}">Editar</a>
                   @csrf
                   @method('DELETE')
                   <button type="submit" class="btn btn-danger">Delete</button>
                 </form>
             </td>
          </tr>
          @endforeach()
       </tbody>
     </table>
    </div>
   </div>
 </div>
</div>
@endsection
@push('footer');
@endpush('footer')

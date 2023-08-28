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
    <a href="{{ route('posts.create')}}
     class="px-4 py-2 rounded-md bg-sky-500 text-sky-100 hover:bg-sky-600">categories Post</a>
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
              <td
               class="text-sm font-medium leading-5 text-center whitespace-no-wrap border-b border-gray-200">
                 <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none"
                   viewBox="0 0 24 24" stroke="currentColor">
                   <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                   d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                 </svg>
              </td>
              <td class="text-sm font-medium leading-5 whitespace-no-wrap border-b border-gray-200 ">
                 <svg xmlns="http://www.w3.org/2000/svg"
                      class="w-6 h-6 text-red-600 hover:text-red-800 cursor-pointer" fill="none"
                      viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                 </svg>
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

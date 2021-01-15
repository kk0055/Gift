@extends('layouts.app')

@section('content')

<div class="m-auto px-4 py-8 max-w-xl ">
  @include('components.alert')
  <div class="bg-white overflow-hidden rounded-lg shadow-lg" >
    @foreach ($categories_products as $prudusts)
        
    {{ $prudusts->title }}
    {{-- @if( null !== $item->image || $item->image2  ) 
      <div class="image-container">
       <div class="panel active">
          <img src="/storage/image/{{ $item->image }}" class="block h-auto w-full"  >
       </div>
       <div class="panel">
        <img src="/storage/image/{{ $item->image2 }}" class="block h-auto w-full"  >
     </div>
        @endif
      </div>
      <div class="px-4 py-2 mt-2 bg-white ">
        
          <hr>
              <p class="">
                {{ $item->body }}
              </p>
      </div> --}}
       
        @endforeach
</div>
      </div>

@endsection

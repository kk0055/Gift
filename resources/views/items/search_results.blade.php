@extends('layouts.app')

@section('content')


@include('components.alert')
<div class="flex justify-center mt-2 	md:text-sm">
  @foreach ($items as $item)
  <div class="ml-3" > 
   <a href="{{ route('category.show' , $item->id ) }}">
   {{ $item->name }} </a> </div> 
  @endforeach
 </div>
    <div class="container mx-auto px-4 pt-16">
        <div class="popular-movies">
       
            <div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8">
              @foreach ($items as $item) 
                <div class="mt-8">
                  <a href="{{ route('item.show',['itemId'=> $item->id]) }}">
                    @if ($item->image)
                      <img src="{{asset('/storage/image/'.$item->image)  }}" alt="poster" class="imgae-box hover:opacity-75 transition ease-in-out duration-150">
                      @else
                      <img class="no-image" src="https://upload.wikimedia.org/wikipedia/commons/thumb/a/ac/No_image_available.svg/480px-No_image_available.svg.png" alt="No Picture" class="hover:opacity-75 transition ease-in-out duration-150">  
                      @endif
                  </a>
                  <div class="mt-2">
                    <span> <a href="{{ route('users.items', [$item->user->id]) }}" class="text-lg mt-2 "> {{ $item->user->name }}</a></span> 
                      <div class="flex items-start flex-col text-sm mt-1">
                          <span class="">{{ $item->title }}</span>
                          <span> {{ $item->body }}</span>
                      </div>
                 
                  </div>
              </div>
                @endforeach
            </div>
        </div> 
    </div>

@endsection

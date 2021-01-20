@extends('layouts.app')



@section('content')
    <div class="container mx-auto px-4 pt-16">
        <div class="popular-movies">
            <h2 class="uppercase tracking-wider text-orange-500 text-lg font-semibold">{{ $category->name }}</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8">
              @foreach ($categories_products as $item) 
                <div class="mt-8">
                  <a href="#">
                    @if ($item->image)
                      <img src="/storage/image/{{ $item->image }}" alt="poster" class="hover:opacity-75 transition ease-in-out duration-150">
                      @else
                      <img class="no-image" src="https://upload.wikimedia.org/wikipedia/commons/thumb/a/ac/No_image_available.svg/480px-No_image_available.svg.png" alt="No Picture" class="hover:opacity-75 transition ease-in-out duration-150">  
                      @endif
                  </a>
                  <div class="mt-2">
                      <a href="" class="text-lg mt-2 hover:text-gray-300"> {{ $item->user->name }}</a>
                      <div class="flex items-center text-gray-400 text-sm mt-1">
                      
                          <span class="ml-1">{{ $item->title }}</span>
                          <span class="mx-2">|</span>
                          <span> {{ $item->body }}</span>
  
                      </div>
                 
                  </div>
              </div>
                @endforeach

            </div>
        </div> <!-- end pouplar-movies -->

    
    </div>
@endsection
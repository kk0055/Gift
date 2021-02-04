@extends('layouts.app')


@section('content')
    <div class="container mx-auto px-4 pt-16">
        <div class="">
            <h2 class=" tracking-wider text-lg font-semibold">{{ $category->name }}</h2>
            <div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8">
              @foreach ($categories_products as $item) 
             {{-- include components.item--}}
             @include('components.item')
             {{-- include components.item--}}
              @endforeach

            </div>
        </div> 

    
    </div>
@endsection
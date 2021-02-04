@extends('layouts.app')

@section('content')

@include('components.alert')
 
    <div class="container mx-auto px-4 pt-16">
        <div class="">
          @if (!$items->count())
          <p>検索したアイテムは見つかりませんでした</p>
      @else
            <div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8">
              @foreach ($items as $item) 
                {{-- include components.item--}}
              @include('components.item')
                {{-- include components.item--}}
                @endforeach
                @endif
            </div>
        </div> 
    </div>

@endsection

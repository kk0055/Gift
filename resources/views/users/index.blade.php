@extends('layouts.app')

@section('content')

<div class="text-2xl  text-black ml-3 my-2" > {{$user->name }}
</div>

@if (Auth::id() === $user->id)
<div class="flex justify-start ">
  <a  href="{{ route('user.index',$user->id) }}" class="inline-flex mb-2 mr-2 py-2 px-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-gray-500 hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">登録情報編集</a>
</div>
@endif

@if (Auth::id() !== $user->id)
<div class="flex justify-start ">
  <follow-button user-id="{{ $user->id }}"></follow-button>
</div>
@endif

@include('components.alert')

    <div class="container mx-auto px-4 pt-16">
            <div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8">
              @foreach ($items as $item) 
              {{-- include components.item--}}
              @include('components.item')
              {{-- include components.item--}}
                @endforeach
            </div>
    </div>
    {{ $items->links() }}
@endsection


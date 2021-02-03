@extends('layouts.app')

@section('content')


<div class="text-2xl  text-black ml-3 my-2" > {{$user->name }}
</div>

@if (Auth::id() === $user->id)
<div class="flex justify-start ">
  <a  href="{{ route('user.index',$user->id) }}" class="inline-flex mb-2 mr-2 py-2 px-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">登録情報編集</a>
</div>

@endif
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
    {{ $items->links() }}
@endsection


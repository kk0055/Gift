@extends('layouts.app')

@section('content')


  <div class="justify-center col-start-1 col-end-7 ">
    
    {{-- Head --}}
    @include('head')
   {{--End Head --}}
   <div class="flex justify-center mt-2 ">
   @foreach ($category_list as $item)
   <div class="ml-3" > 
    <a href="{{ route('category.show' , $item->id ) }}">
    {{ $item->name }} </a> </div> 
   @endforeach
  </div>
    {{-- Form --}}
    @include('saveItem')
   {{--End Form --}}


    
    @foreach ($items as $item)
    <div class="justify-center col-start-1 col-end-7 ">
  
      <div class="max-w-3xl  bg-white rounded-lg mx-auto my-2 p-2">
    
        <a class="text-2xl mb-2 text-black" href="{{ route('users.items',$item->user->id) }}"> {{$item->user->name }}</a>
        <p class="mt-2">{{ $item->title }}</p>
        <hr>
      
        {{-- Image --}}
        @if ($item->image != null)
        <div class="flex">
          <div>
          <a href="{{ route('item.show',['itemId'=> $item->id]) }}">
          <img src="/storage/image/{{ $item->image }}" alt="" class="" width="120px" height="120px" ></div></a>
         
          {{-- <div>
          <img src="/storage/image/{{ $item->image2 }}" alt="" class="" width="120px" height="120px" >
        </div> --}}
        <p class="ml-2"> {{ $item->body }}</p>
        
        </div> 
      
        @else
        <p class="ml-2"> {{ $item->body }}</p>
      
        @endif
         {{--End Image --}}

       {{-- ログインしていないとき --}}
        @guest
         <div class="px-4  bg-white text-right sm:px-6" id="" >
          <a href="{{ route('chats.users',['receive' => $item->user->id ,'itemId'=> $item->id ] ) }}"  type="submit" class="inline-flex justify-center py-2 mt-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-indigo-500" onclick="loginAlert()">欲しい
          </a>    
        </div>
        @endguest
         {{-- ログインしていないとき --}}
        
           {{-- Delete Button --}}
      @auth
      @if ($item->user->id === Auth::user()->id)
      <div class="flex justify-between">
        <form action="{{ route('item.destroy', $item) }}" method="post" class="mr-1">
          @csrf
          @method('DELETE')
          
          <button type="submit" class="inline-flex justify-center py-2 px-4 mt-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">削除</button>
        </form>
        @endif
       
        {{--End Delete Button --}}
        <div class="px-4  bg-white text-right sm:px-6">
          <a href="{{ route('item.show',['itemId'=> $item->id]) }}" 
            type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-indigo-500">見たい
          </a>
        </div>
      {{-- 欲しい Button --}}
       
      {{-- @if ($item->user->id !== Auth::user()->id) --}}
        <div class="px-4  bg-white text-right sm:px-6">
          <a href="{{ route('chats.users',['receive' => $item->user->id ,'itemId'=> $item->id ] ) }}" 
            type="submit" class="inline-flex justify-center py-2 mt-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-indigo-500">チャット
        
          </a>    
        </div>
      </div>
      {{-- @endif --}}

      {{-- @if ($item->user->id == Auth::user()->id)
      <div class="px-4  bg-white text-right sm:px-6">
        <a href="{{ route('chats.users',['receive' => $item->user->id ,'itemId'=> $item->id ] ) }}" 
          type="submit" class="inline-flex justify-center py-2 mt-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-indigo-500">確認
      
        </a>    
      </div>
    </div>
    @endif --}}
    

      @endauth
      {{--End 欲しい Button --}}
    </div>
  </div>
    @endforeach
  
    <div class="mb-3">
    {{ $items->links() }}
  </div>

@endsection


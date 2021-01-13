@extends('layouts.app')

@section('content')


  <div class="justify-center col-start-1 col-end-7 ">
    
{{-- head --}}
<div
class="relative pt-16 pb-32 flex content-center items-center justify-center"
style="min-height: 75vh;"
>
<div
  class="absolute top-0 w-full h-full bg-center bg-cover"
  style='background-image: url("https://images.unsplash.com/photo-1609986826541-063f1aa74219?ixid=MXwxMjA3fDB8MHx0b3BpYy1mZWVkfDR8NnNNVmpUTFNrZVF8fGVufDB8fHw%3D0");background-position:right bottom '
>
  {{-- <span
    id="blackOverlay"
    class="w-full h-full absolute opacity-75 bg-black"
  ></span> --}}
</div>
<div class="container relative mx-auto" data-aos="fade-in">
  <div class="items-center flex flex-wrap">
    <div class="w-full  px-4 ml-auto mr-auto text-center">
      <div >
        <h1 class="text-white font-bold text-5xl">
        必要なものを <span class="text-white "> 必要な人へ</span> 
        </h1>
        <p class="mt-4 text-lg text-white text-4xl font-bold">
         あなたのいらないが誰かの役に立つ
           
        </p>
      </div>
    </div>
  </div>
</div>


</div>
{{--End head --}}

    {{-- Form --}}
 
   
    <div class="mt-1 md:mt-0 md:col-span-2 max-w-3xl mx-auto  p-16">
      @include('components.alert')
 
      <form action="{{ route('item.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="shadow overflow-hidden sm:rounded-md">
          <div class="px-4 py-5 bg-white sm:p-6">
            <div class="">
            
             
       
              @error('image')
              <div class="text-red-500 mt-2 text-sm">
                {{ $message }}
              </div>
              @enderror   
              <div class="col-span-6">
            
                <label for="title" class="block text-sm font-medium text-gray-700">タイトル｜アイテム名</label>
                <input type="text" name="title" id="title"  class="mt-1 p-1 focus:outline-none focus:ring focus:border-blue-300  block w-full shadow-sm sm:text-sm rounded-md border border-indigo-600" placeholder="例 : 読まなくなった本あげます" >
              </div>
              @error('title')
              <div class="text-red-500 mt-2 text-sm">
                {{ $message }}
              </div>
              @enderror
              {{-- Body --}}
             

              <div class="col-span-6 mt-3 sm:col-span-6 lg:">
                <label for="body" class="block text-sm font-medium text-gray-700">詳細</label>
                <textarea type="text" name="body" id="body" class=" w-5  focus:outline-none	 w-full shadow-sm sm:text-sm border-gray-300 rounded-md border border-indigo-600"  rows="5"  placeholder=" 詳細をご記入ください"></textarea>
              </div>
              @error('body')
              <div class="text-red-500 mt-2 text-sm">
                {{ $message }}
              </div>
              @enderror 
              
              {{-- image --}}
              <div class="col-span-6 sm:col-span-6 lg:col-span-2">
                <label for="image" class="block text-sm font-medium text-gray-700"></label>
                <input type="file" name="image" id="filename" class="focus:outline-none" >
              </div>
              <div class="col-span-6 sm:col-span-6 lg:col-span-2">
               
                <label for="image2" class="block text-sm font-medium text-gray-700"></label>
                <input type="file" name="image2" id="filename" class="focus:outline-none" >
            
              </div>

            {{-- End of Body --}}
        
            </div>
          </div>
        {{-- ログインしていないとき --}}
        @guest
        <div class="px-4 py-3 bg-white text-right sm:px-6">
          <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" onclick="loginAlert()" >
            投稿
          </button>
        </div>
       @endguest
        {{-- ログインしていないとき --}}
        @auth
          <div class="px-4 py-3 bg-white text-right sm:px-6">
            <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" >
              投稿
            </button>
          </div>
          @endauth
        </div>
      </form>
    </div>

    <!--  -->
    
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
          <a href="{{ route('chats.users', $item->user->id) }}" type="submit" class="inline-flex justify-center py-2 mt-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-indigo-500" onclick="loginAlert()">欲しい
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
          <a href="{{ route('item.show',['itemId'=> $item->id]) }}" type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-indigo-500">見たい
          </a>
        </div>
      {{-- 欲しい Button --}}
       
      @if ($item->user->id !== Auth::user()->id)
        <div class="px-4  bg-white text-right sm:px-6">
          <a href="{{ route('chats.users', $item->user->id) }}" type="submit" class="inline-flex justify-center py-2 mt-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-indigo-500">欲しい
        
          </a>    
        </div>
      </div>
      @endif
      @endauth
      {{--End 欲しい Button --}}
    </div>
  </div>
    @endforeach
  
    <div class="mb-3">
    {{ $items->links() }}
  </div>

@endsection


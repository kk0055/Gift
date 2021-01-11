@extends('layouts.app')

@section('content')


  <div class="justify-center col-start-1 col-end-7 ">
    
{{-- head --}}
    <div
    class="top-0  relative pt-16  pb-32 flex content-center items-center justify-center bg-white"
    style="min-height: 75vh;"
  >
    <div
      class="absolute top-0 w-full h-full bg-center bg-cover 
      " 
      style='background-image: url("https://images.unsplash.com/photo-1557282229-36aedcdbccab?ixid=MXwxMjA3fDB8MHxzZWFyY2h8MTMxfHxnYXJiYWdlfGVufDB8fDB8&ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60");background-size: 120vh;  background-repeat: no-repeat;'
    >
      <span
        id="blackOverlay"
        class="w-full h-full absolute opacity-75 bg-black"
      ></span>
    </div>
    <div class="container relative mx-auto" data-aos="fade-in">
      <div class="items-center flex flex-wrap">
        <div class="w-full  px-4 ml-auto mr-auto text-center">
          <div >
            <h1 class="text-white font-bold text-5xl">
            必要なものを <span class="text-orange-500 uppercase"> 必要な人へ</span> 
            </h1>
            <p class="mt-4 text-lg text-gray-300 text-4xl font-bold">
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
            <div class="grid grid-cols-6 gap-6">
            
              @error('title')
              <div class="text-red-500 mt-2 text-sm">
                {{ $message }}
              </div>
              @enderror   
             
              @error('image')
              <div class="text-red-500 mt-2 text-sm">
                {{ $message }}
              </div>
              @enderror   
              <div class="col-span-6">
            
                <label for="title" class="block text-sm font-medium text-gray-700">タイトル｜アイテム名</label>
                <input type="text" name="title" id="title"  class="mt-1 p-1 focus:outline-none focus:ring focus:border-blue-300  block w-full shadow-sm sm:text-sm rounded-md border border-indigo-600" placeholder="例 : 読まなくなった本あげます" >
              </div>

              {{-- Body --}}
              @error('body')
              <div class="text-red-500 mt-2 text-sm">
                {{ $message }}
              </div>
              @enderror    

              <div class="col-span-6 sm:col-span-6 lg:">
                <label for="body" class="block text-sm font-medium text-gray-700">詳細</label>
                <textarea type="text" name="body" id="body" class="mt-1 w-5  focus:outline-none	 w-full shadow-sm sm:text-sm border-gray-300 rounded-md border border-indigo-600"  rows="5"  placeholder="例 : 詳細をご記入ください"></textarea>
              </div>
              {{-- image --}}
              <div class="col-span-6 sm:col-span-6 lg:col-span-2">
                <label for="image" class="block text-sm font-medium text-gray-700"></label>
                <input type="file" name="image" class="focus:outline-none" >
              </div>
            {{-- End of Body --}}

            </div>
          </div>
 
          <div class="px-4 py-3 bg-white text-right sm:px-6">
            <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
              Save
            </button>
          </div>
        </div>
      </form>
    </div>

    <!--  -->
    
    @foreach ($items as $item)
    <div class="justify-center col-start-1 col-end-7 ">
  
      <div class="max-w-3xl  bg-white rounded-lg mx-auto my-2 p-2">
            
          <img src="/storage/image/{{ $item->image }}" alt="" class="" width="100px" height="100px" >
       
        <h2 class="text-2xl font-medium mb-2">{{$item->user->name }}</h2>
        <p class="">{{ $item->title }}</p>
        <hr>
        <p class=""> {{ $item->body }}</p>
       
        
        
           {{-- Delete Button --}}
      @auth
      @if ($item->user->id === Auth::user()->id)
      <div class="flex justify-between">
        <form action="{{ route('item.destroy', $item) }}" method="post" class="mr-1">
          @csrf
          @method('DELETE')
          
          <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">削除</button>
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
          <a href="{{ route('chats', $item->user->id) }}" type="submit" class="inline-flex justify-center py-2 mt-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-indigo-500">欲しい
        
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


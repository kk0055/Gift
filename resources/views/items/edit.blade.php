@extends('layouts.app')

@section('content')

<div class="mt-1 md:mt-0 md:col-span-2 max-w-3xl mx-auto  p-16">
  @include('components.alert')

  <form action="{{ route('item.update',$item->id) }}" method="POST" enctype="multipart/form-data">
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
             <P class="text-center text-gray-700 font-display lg:text-left 
           
          xl:text-bold">編集</P>
            <label for="title" class="block text-sm font-medium text-gray-700">タイトル｜アイテム名</label>
            <input type="text" name="title" id="title"  class="mt-1 p-1 focus:outline-none focus:ring focus:border-blue-300  block w-full shadow-sm sm:text-sm rounded-md border border-indigo-600" value="{{ $item->title }}" >
          </div>
          @error('title')
          <div class="text-red-500 mt-2 text-sm">
            {{ $message }}
          </div>
          @enderror
          {{-- Body --}}
         

          <div class="col-span-6 mt-3 sm:col-span-6 lg:">
            <label for="body" class="block text-sm font-medium text-gray-700">詳細</label>
            <textarea type="text" name="body" id="body" class=" w-5  focus:outline-none	 w-full shadow-sm sm:text-sm border-gray-300 rounded-md border border-indigo-600"  rows="5"  >{{ $item->body }}</textarea>
          </div>
          @error('body')
          <div class="text-red-500 mt-2 text-sm">
            {{ $message }}
          </div>
          @enderror 
          
          {{-- image --}}
          <div class="col-span-6 sm:col-span-6 lg:col-span-2">
            <label for="image" class="block text-sm font-medium text-gray-700"></label>
            <input type="file" name="image" class="focus:outline-none" value="{{ $item->image }}">
          </div>
          <div class="col-span-6 sm:col-span-6 lg:col-span-2">
            <label for="image2" class="block text-sm font-medium text-gray-700"></label>
            <input type="file" name="image2" class="focus:outline-none" value="{{ $item->image2 }}" >
          </div>
        {{-- End of Body --}}

        </div>
      </div>

      <div class="px-4 py-3 bg-white text-right sm:px-6">
        <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" >
          投稿
        </button>
      </div>
    </div>
  </form>
</div>

@endsection
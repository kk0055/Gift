@extends('layouts.app')

@section('content')

<div class="m-auto px-4 py-8 max-w-xl">
  @include('components.alert')
  <div class="bg-white overflow-hidden rounded-lg shadow-lg" > 
      <div class="">
       @if($item->image && !str_contains($item->image, 'noimage') )
          <img src="/storage/image/{{ $item->image }}" class="block h-auto w-full"  >
        @endif
      </div>
      <div class="px-4 py-2 mt-2 bg-white">
        <p class="">  {{ $item->user->name }}</p>
          <p class="">  {{ $item->title }}</p>
          <hr>
              <p class="">
                {{ $item->body }}
              </p>
      </div>
        {{-- Delete Button --}}
        @auth
        @if ($item->user->id === Auth::user()->id)
        <div class="flex justify-end ">
          <form action="{{ route('item.destroy', $item) }}" method="post" class="mr-1">
            @csrf
            @method('DELETE')
            
            <button type="submit" class="inline-flex mb-2 py-2 px-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">削除</button>
          </form>
          <a  href="{{ route('item.edit',[$item->id]) }}" class="inline-flex mb-2 mr-2 py-2 px-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">編集</a>
          @endif
        
          {{--End Delete Button --}}
  
        {{-- 欲しい Button --}}
        
        @if ($item->user->id !== Auth::user()->id)
          <div class="px-4  bg-white text-right sm:px-6">
            <a href="{{ route('chats.users', $item->user_id) }}" type="submit" class="inline-flex justify-center py-2 mt-2 mb-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-indigo-500">欲しい
            </a>
          </div>
        </div>
        @endif
        @endauth
        {{--End 欲しい Button --}}
</div>
      </div>

@endsection


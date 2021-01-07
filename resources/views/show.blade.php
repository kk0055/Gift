@extends('layouts.app')

@section('content')
<div id="app">
  <div class="justify-center col-start-1 col-end-7 ">
      <div class="mt-1 md:mt-0 md:col-span-2 max-w-3xl mx-auto  p-16">
        {{-- Image --}}
        <img src="/storage/image/{{ $item->image }}" alt="" class="" width="100px" height="100px" style="">
 {{--End  Image --}}
        <div class="shadow overflow-hidden sm:rounded-md">
          <div class="px-4 py-5 bg-white sm:p-6">
              {{-- Body --}}            
              <div class="col-span-6">
                {{ $item->title }}
              </div>
            
              <div class=" mt-2 text-sm">
                {{ $item->body }}

              <div class="col-span-6 sm:col-span-6 lg:">
        
              </div>
            {{-- End of Body --}}

            </div>
         
 
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
 
      {{-- 欲しい Button --}}
       
      @if ($item->user->id !== Auth::user()->id)
        <div class="px-4  bg-white text-right sm:px-6">
          <a href="{{ route('chats', $item->user_id) }}" type="submit" class="inline-flex justify-center py-2 mt-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-indigo-500">欲しい
          </a>
        </div>
      </div>
      @endif
      @endauth
      {{--End 欲しい Button --}}
    </div>
  </div>



          </div>
        </div>
      </form>
    </div>

    <!--  -->
    

  </div>
 
</div>

@endsection


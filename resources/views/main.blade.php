@extends('layouts.app')
@section('content')

<div class="justify-center col-start-1 col-end-7">
    {{-- Head --}}
    @include('head')
   {{--End Head --}}
 
<div class="mt-4 container mx-auto px-4 flex flex-col md:flex-row items-center justify-between px-4 ">
  @foreach ($category_list as $item)
   <a href="{{ route('category.show' , $item->id ) }}">
   {{ $item->name }}</a> 
  
  @endforeach

</div>


    <div class="container mx-auto px-4 pt-16">
        <div class="">
       
            <div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8">
              
              @foreach ($items as $item) 
                <div class="append mt-8 ">
                  <a href="{{ route('item.show',['itemId'=> $item->id]) }}">
                    @if ($item->image)
                      <img src="storage/image/{{ $item->image }}" alt="pic" class="hover:opacity-75 transition ease-in-out duration-150">
                      <img src="{{asset('storage/'.$item->image)  }}" alt="pic" class="hover:opacity-75 transition ease-in-out duration-150">
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
            <div class="mt-5 mb-4">
          {{ $items->links() }}
        </div>
        </div> 
        </div> 
     
    </div>
  
@endsection

{{-- @section('scripts')
<script src="https://unpkg.com/infinite-scroll@4/dist/infinite-scroll.pkgd.min.js"></script>
<script>
  let elem = document.querySelector('.grid');
  let infScroll = new InfiniteScroll( elem, {
  // options
  path: './@{{#}}',
  append: '.append',
  
  
});

</script>
@endsection --}}
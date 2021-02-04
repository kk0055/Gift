<div class=" mt-8 ">
  <a href="{{ route('item.show',['itemId'=> $item->id]) }}">
   <div class="image-box">
      @if ($item->image)
      {{-- <img src="public/storage/image/{{ $item->image }}" alt="pic" class="hover:opacity-75 transition ease-in-out duration-150"> --}}
      {{-- <img src="/storage/image/{{ $item->image }}" alt="pic" class="hover:opacity-75 transition ease-in-out duration-150"> --}}
      <img src="{{asset('/storage/image/'.$item->image)  }}" alt="pic"  class="item-image hover:opacity-75 transition">
      @else
      <img class="no-image " src="https://upload.wikimedia.org/wikipedia/commons/thumb/a/ac/No_image_available.svg/480px-No_image_available.svg.png" alt="No Picture" class="">  
      @endif
    </div>
  </a>
  <div class="mt-2">
    <span> <a href="{{ route('users.items', [$item->user->id]) }}" class="text-lg mt-2 "> {{ $item->user->name }}</a></span> 
      <div class="flex items-start flex-col text-sm mt-1">
          <span class="">{{ $item->title }}</span>
          <span> {{ $item->body }}</span>
      </div>
  </div>
</div>
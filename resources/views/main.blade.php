<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Gift</title>
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">
  <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
  <style>
    #menu-toggle:checked + #menu {
      display: block;
    }

</style>
</head>
<body class=" bg-gray-200 ">
  <div id="app">
    <div class="justify-center">
      
      {{-- Form --}}
    {{-- </items></items> --}}

      <div class="mt-1 md:mt-0 md:col-span-2 max-w-3xl mx-auto my-16 p-16">
       
        <form action="{{ route('item.store') }}" method="POST">
          @csrf
          <div class="shadow overflow-hidden sm:rounded-md">
            <div class="px-4 py-5 bg-white sm:p-6">
              <div class="grid grid-cols-6 gap-6">
              
                @error('title')
                <div class="text-red-500 mt-2 text-sm">
                  {{ $message }}
                </div>
                @enderror   
               
                <div class="col-span-6">
                  
                  <label for="title" class="block text-sm font-medium text-gray-700">タイトル｜アイテム名</label>
                  <input type="text" name="title" id="title"  class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                </div>
  
                {{-- Body --}}
                @error('body')
                <div class="text-red-500 mt-2 text-sm">
                  {{ $message }}
                </div>
                @enderror    

                <div class="col-span-6 sm:col-span-6 lg:">
                  <label for="body" class="block text-sm font-medium text-gray-700">詳細</label>
                  <textarea type="text" name="body" id="body" class="mt-1 p-3 focus:outline-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"></textarea>
                </div>
                <div class="col-span-6 sm:col-span-6 lg:col-span-2">
                  <label for="body" class="block text-sm font-medium text-gray-700"></label>
                  <input type="file" >
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
      <div class="px-4">
        <div class="max-w-3xl bg-white rounded-lg mx-auto my-2 p-2">
          <h2 class="text-2xl font-medium mb-2">{{$item->user->name }}</h2>
          <p class="font-medium mb-2 text-2xl ">{{ $item->title }}</p>
          <p class="font-medium  mb-4 text-md">  {{ $item->body }}</p>

          
          
             {{-- Delete Button --}}
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
          <div class="px-4  bg-white text-right sm:px-6">
            <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none  focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">欲しい
            </button>
          </div>
        </div>
        {{--End 欲しい Button --}}
      </div>
      </div>
      @endforeach
      <div class="mb-3">
      {{ $items->links() }}
    </div>
  </div>
  {{-- <script src="{{ asset('js/app.js') }}"></script> --}}
</body>
</html>
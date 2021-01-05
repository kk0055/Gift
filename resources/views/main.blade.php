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
<body class=" bg-gray-200">
  <div id="app">
    <div class="justify-center">
             
      {{-- <div class="max-w-3xl bg-white rounded-lg mx-2 my-2 p-16">
        <form  class="mb-1">
          <div class="form-group">
            <input type="text" class="  w-full p-2 rounded-lg" placeholder="Title" >
          </div>
      
          <div class="form-group">
            <textarea placeholder="Body" row="5" class="border-1 w-full p-4 rounded-lg"  ></textarea>
          </div>
      
            <div class="form-group">
            <input type="file">
          </div>
          <button type="submit" class="btn btn-primary btn-block">Save</button>
        </form>
      </div> --}}
     
      {{-- Form --}}
      <div class="mt-5 md:mt-0 md:col-span-2 mx-auto my-16 p-16">
        <form action="#" method="POST">
          <div class="shadow overflow-hidden sm:rounded-md">
            <div class="px-4 py-5 bg-white sm:p-6">
              <div class="grid grid-cols-6 gap-6">
              
                     
                <div class="col-span-6">
                  <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                  <input type="text" name="title" id="title"  class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                </div>
  
                <div class="col-span-6 sm:col-span-6 lg:col-span-2">
                  <label for="body" class="block text-sm font-medium text-gray-700">詳細</label>
                  <textarea type="text" name="body" id="body" class="mt-1 p-3 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"></textarea>
                </div>

                <div class="col-span-6 sm:col-span-6 lg:col-span-2">
                  <label for="body" class="block text-sm font-medium text-gray-700"></label>
                  <input type="file" name="body" id="body" class="">
                </div>
  
  
          
  
              </div>
            </div>
            <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
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
        <div class="max-w-3xl bg-white rounded-lg mx-auto my-5 p-5">
          <h2 class="text-2xl font-medium mb-2">{{ $item->title }}</h2>
          <p class="font-medium text-sm  mb-4 uppercase tracking-wide">  {{ $item->body }}</p>
        
        </div>
      </div>
      @endforeach
      
  
  </div>
  {{-- <script src="{{ asset('js/app.js') }}"></script> --}}
</body>
</html>
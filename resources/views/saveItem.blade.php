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
            <div class="text-red-500 mb-2 text-sm">
              {{ $message }}
            </div>
            @enderror
            {{-- Body --}}
           

            <div class="col-span-6 mt-3 sm:col-span-6 lg:">
              <label for="body" class="block text-sm font-medium text-gray-700 ">詳細</label>
              <textarea type="text" name="body" id="body" class=" w-5  focus:outline-none	 w-full shadow-sm sm:text-sm border-gray-300 rounded-md border border-indigo-600"  rows="5"  placeholder=" 詳細をご記入ください"></textarea>
            </div>
            @error('body')
            <div class="text-red-500 mb-2 text-sm">
              {{ $message }}
            </div>
            @enderror 
            
           
              <label>カテゴリー</label>
              <select class="form-control" name="category">
                <option value="" selected>-----------------</option>
                  @foreach ($category_list as $category)
                    
                      <option value="{{ $category->id }}" name="category">{{ $category->name }}</option>
                  @endforeach
              </select>
       
          @error('category')
          <div class="text-red-500 mb-2 text-sm">
            {{ $message }}
          </div>
          @enderror 
            {{-- image --}}
            <div class="col-span-6 sm:col-span-6 lg:col-span-2 mt-3">
              <label for="image" class="block text-sm font-medium text-gray-700"></label>
              <input type="file" name="image" id="filename" class="focus:outline-none " >
            </div>
            <div class="col-span-6 sm:col-span-6 lg:col-span-2">
             
              <label for="image2" class="block text-sm font-medium text-gray-700"></label>
              <input type="file" name="image2" id="filename" class="focus:outline-none " >
          
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

 {{--End Form --}}
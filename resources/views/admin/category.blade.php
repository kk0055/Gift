@extends('layouts.app')

@section('content')
<div class="mt-1 md:mt-0  mx-auto  p-16">
    <div class="">
        <div class="">
            <div class="">
                <h2>カテゴリ一覧</h2>
                <br>

                @if (count($categories) > 0)
                    <br>

                    {{ $categories->links() }}
                    <table class="table table-striped">
                        <tr>
                            <th width="">カテゴリ番号</th>
                            <th>表示名</th>
                            <th width="">Slug</th>
                            <th width="">編集</th>
                        </tr>

                        @foreach ($categories as $category)
                            <tr data-category_id="{{ $category->category_id }}">
                                <td>
                                    <span class="category_id">{{ $category->id }}</span>
                                </td>
                                <td>
                                    <span class="name">{{ $category->name }}</span>
                                </td>
                                <td>
                                    <span class="display_order">{{ $category->slug }}</span>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#categoryModal" data-category_id="{{ $category->category_id }}">編集</button>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                @else
                    <br>
                    <p>カテゴリがありません。</p>
                @endif

            </div>
        </div>
    </div>

    @include('components.alert')

    <form action="{{ route('create_category') }}" method="POST">
      @csrf
      <div class="shadow overflow-hidden sm:rounded-md">
        <div class="px-4 py-5 bg-white sm:p-6">
          <div class="">
          
            <div class="col-span-6">
          
              <label for="title" class="block text-sm font-medium text-gray-700">カテゴリ名</label>
              <input type="text" name="name"  class="mt-1 p-1 focus:outline-none focus:ring focus:border-blue-300  block w-full shadow-sm sm:text-sm rounded-md border border-indigo-600"  >
            </div>
            @error('name')
            <div class="text-red-500 mt-2 text-sm">
              {{ $message }}
            </div>
            @enderror
            {{-- Body --}}
           

            <div class="col-span-6 mt-3 sm:col-span-6 lg:">
              <label for="body" class="block text-sm font-medium text-gray-700">Slug</label>
              <input type="text" name="slug"  class="mt-1 p-1 focus:outline-none focus:ring focus:border-blue-300  block w-full shadow-sm sm:text-sm rounded-md border border-indigo-600"  >
            </div>
            @error('slug')
            <div class="text-red-500 mt-2 text-sm">
              {{ $message }}
            </div>
            @enderror 
            
      
          </div>
        </div>
   
     
        <div class="px-4 py-3 bg-white text-right sm:px-6">
          <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" >
            登録
          </button>
        </div>
       
      </div>
    </form>
  </div>
@endsection
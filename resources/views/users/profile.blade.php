@extends('layouts.app')

@section('content')


@include('components.alert')

<div class="flex items-center justify-center mt-3 ">
    
    <div class="w-2/3 lg:w-1/2 xl:max-w-screen-sm bg-white">
       
        <div class=" md:px-48 lg:px-12 lg:mt-16 xl:px-24 xl:max-w-2xl">
         
            <div class="  mt-10">
                     <form method="POST" action="{{ route('user.update',$user) }}">
                    @csrf
                  
                
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                      @enderror

                      <div>
                        <div class="text-sm font-bold text-gray-700 tracking-wide">名前</div>
                        <input class="w-full text-lg py-2 border-b border-gray-300 focus:outline-none focus:border-indigo-500 form-control @error('email') is-invalid @enderror" type="name" name="name"  value="{{ $user->name }}" >
                    </div>
                 
                        <div class="mt-4 text-sm font-bold text-gray-700 tracking-wide">メールアドレス</div>
                        <input class="w-full text-lg py-2 border-b border-gray-300 focus:outline-none focus:border-indigo-500 form-control @error('email') is-invalid @enderror" type="email" name="email"  value="{{ $user->email }}" >
                    

                        
                    <div class="mt-10">
                        <button class="bg-indigo-500 text-gray-100 p-2 mb-2 ml-2 rounded-lg tracking-wide
                        font-semibold font-display focus:outline-none focus:shadow-outline hover:bg-indigo-600
                        shadow-lg">
                        変更
                        </button>
                    </div>
                </form>
           
        
    
            </div>
          
            </div>
        </div>
    </div>
    

@endsection
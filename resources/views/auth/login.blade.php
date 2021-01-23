@extends('layouts.app')

@section('content')

@include('components.validate')

<div class="flex items-center justify-center mt-3 ">
    
    <div class="w-2/3 lg:w-1/2 xl:max-w-screen-sm bg-white">
       
        <div class=" md:px-48 lg:px-12 lg:mt-16 xl:px-24 xl:max-w-2xl">
            <a href="{{ route('main') }}"> 
                <img src="../storage/image/kasih-removebg-preview.png" width="80" height="50" alt="KASIH"></a>  
            <P class="text-center text-gray-700   lg:text-left font-bold ">ログイン</P>
            
            <div class="  mt-10">
                     <form method="POST" action="{{ route('login') }}">
                    @csrf
                    @if (session('oauth_error'))
                    {{ session('oauth_error') }}
                    @endif
                
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                      @enderror

                    <div>
                        <div class="text-sm font-bold text-gray-700 tracking-wide">メールアドレス</div>
                        <input class="w-full text-lg py-2 border-b border-gray-300 focus:outline-none focus:border-indigo-500 form-control @error('email') is-invalid @enderror" type="email" name="email" placeholder="メールアドレス" value="{{ old('email') }}" >
                    </div>

                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                    {{-- @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                   @endforeach --}}

                    <div class="mt-8">

                        
                        <div class="flex justify-between items-center">
                            <div class="text-sm font-bold text-gray-700 tracking-wide">
                                パスワード
                            </div>
                            
                        </div>
                        <input class=" text-lg py-2  focus:outline-none focus:border-indigo-500 form-control @error('password') is-invalid @enderror" type="password"  placeholder="パスワード" value="{{ old('password') }}" name="password">
                    </div>
                    <div class="mt-10">
                        <button class="bg-indigo-500 text-gray-100 p-4 w-full rounded-full tracking-wide
                        font-semibold font-display focus:outline-none focus:shadow-outline hover:bg-indigo-600
                        shadow-lg">
                        ログイン
                        </button>
                    </div>
                </form>
                <div class="mt-2 text-sm font-display font-semibold text-gray-700 text-center">
                    アカウントをお持ちでない方はこちら<a class="cursor-pointer text-indigo-600 hover:text-indigo-800 ml-2" href="{{ 'register' }}">登録</a>
                </div>
                {{-- <div class=" space-y-3 w-full mt-3 mb-4">
                    <a
                      class="ml-2  px-6 py-2 text-xs font-medium leading-6 text-center text-white transition bg-blue-700 rounded shadow ripple hover:shadow-lg hover:bg-blue-800 focus:outline-none" href="{{ route('twitter.login',['provider' => 'twitter']) }}"
                    >
                    <i class="fab fa-twitter mr-2"></i>
                        Twitterで登録する   
                    </a>
                </div> --}}
                {{-- テストボタン --}}
                <div class="mb-2 ml-2">
                  <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div>
                        <input class="" type="hidden" name="email" 
                        value="test1@test.com" >
                    </div>
                        <input class="" type="hidden"  value="12345678910" name="password">
                  
                    <div class="mt-2">
                        <button class="bg-green-300 px-2 text-gray-100 rounded-full tracking-wide
                        font-semibold font-display focus:outline-none focus:shadow-outline hover:bg-green-500
                        shadow-lg"> 試してみる
                    
                        </button>
                    </div>  
                </form>
            </div>
              {{-- テストボタン --}}
            </div>
          
            </div>
        </div>
    </div>
    

@endsection

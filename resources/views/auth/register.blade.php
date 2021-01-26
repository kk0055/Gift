@extends('layouts.app')

@section('content')

<div class="flex items-center justify-center mt-3">
    
    <div class="w-2/3 lg:w-1/2 xl:max-w-screen-sm bg-white">
       
        <div class=" sm:px-24 md:px-48 lg:px-12 lg:mt-16 xl:px-24 xl:max-w-2xl">
            <a href="{{ route('main') }}"> 
                <img src="image/kasih-removebg-preview.png" width="80" height="50" alt="KASIH"></a>  
            <P class="text-center text-gray-700 font-display lg:text-left 
           
            font-bold">登録</P>
           
            <div class="mt-12">
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    @if (session('oauth_error'))
                    {{ session('oauth_error') }}
                    @endif
                
               

                      <div class="">
                        <div class="text-sm font-bold text-gray-700 tracking-wide">ニックネーム</div>
                        <input class="w-full text-lg  border-b border-gray-300 focus:outline-none focus:border-indigo-500 form-control @error('name') is-invalid @enderror" type="text" name="name" placeholder="ニックネーム" value="{{ old('name') }}" >
                    </div>
                    @error('name')
                    <span class="text-red-500 mt-2 text-sm" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror

                    <div class="mt-2">
                        <div class="text-sm font-bold text-gray-700 tracking-wide">メールアドレス</div>
                        <input class="w-full text-lg border-b border-gray-300 focus:outline-none focus:border-indigo-500 form-control @error('email') is-invalid @enderror" type="email" name="email" placeholder="メールアドレス" value="{{ old('email') }}" >
                    </div>
                    @error('email')
                    <span class="text-red-500 mt-2 text-sm" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                 
                    {{-- @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                   @endforeach --}}

                    <div class="mt-2">

                        
                        <div class="flex justify-between items-center">
                            <div class="text-sm font-bold text-gray-700 tracking-wide">
                                パスワード
                            </div>

                        </div>
                        <input class="w-full text-lg py-2 border-b border-gray-300 focus:outline-none focus:border-indigo-500 form-control @error('password') is-invalid @enderror" type="password"  placeholder="パスワード" value="{{ old('password') }}" name="password">
                    </div>

                    @error('password')
                    <span class="text-red-500 mt-2 text-sm" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror

                    <div class="mt-10">
                        <button class="bg-indigo-500 text-gray-100 p-4 w-full rounded-full tracking-wide
                        font-semibold font-display focus:outline-none focus:shadow-outline hover:bg-indigo-600
                        shadow-lg">
                        登録
                        </button>
                    </div>
                </form>
                <div class="mt-2 text-sm font-display font-semibold text-gray-700 text-center">
                    <a class="cursor-pointer text-indigo-600 hover:text-indigo-800" href="{{ 'login' }}">ログイン</a>
                </div>
                <div class=" space-y-3 w-full mt-3 mb-4">
                    <a
                      class="ml-2  px-6 py-2 text-xs font-medium leading-6 text-center text-white transition bg-blue-700 rounded shadow ripple hover:shadow-lg hover:bg-blue-800 focus:outline-none" href="{{ route('twitter.login',['provider' => 'twitter']) }}"
                    >
                    <i class="fab fa-twitter mr-2"></i>
                        Twitterで登録する   
                    </a>
                </div>
            </div>
        </div>
    </div>
    
</div>
@endsection




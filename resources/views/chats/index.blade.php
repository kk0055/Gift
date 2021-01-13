@extends('layouts.app')
 
@section('content')
<div class="mt-4">
<div class="m-auto  px-4 py-5 mt-2 max-w-xl bg-white rounded-lg  " >
    <div class="row">
        <div class="col-start-2 col-span-4 ">
       
         
        </div>
    </div>
 
    {{--  チャットルーム  --}}
    <div id="room" class="justify-items-stretch">
     
      <h1 class="text-lg mb-2">
        <a class="no-underline hover:underline text-black" href="#">
          {{ $user[0]->name }}
         
          {{-- @foreach($messages as  $key => $message)
          @if ($key == 0 )
          <p class=" ">{{ $message->user->name }}</p>
          @endif --}}
          {{-- @if ($messages->send === auth()->id && $messages->receive === auth()->id ) --}}
      {{-- {{ $toSend }} --}}
      {{-- {{ $user->name }} --}}
            {{-- @foreach ($toSend as $item) --}}
            {{-- @if(!$item->user_id == $item->user->id) --}}
            {{-- {{ $item->user->name }} --}}
            {{-- @endif --}}
            {{-- @endforeach --}}
            {{-- @endforeach --}}
            
            
        </a>
    </h1>
      <hr>

     
    
        @foreach($messages as  $message)

            {{--   送信したメッセージ  --}}
            @if($message->send == \Illuminate\Support\Facades\Auth::id())
         <div class="flex items-end justify-end">
                <div class="send mr-2 bg-green-300 mx-1 my-1 p-1 rounded-lg" style="text-align: right">
                    <p>{{$message->message}}</p>
                    {{-- {{ $message->user->name }} --}}
                </div>
              </div>
            @endif
 
            {{--   受信したメッセージ  --}}
            @if($message->receive == \Illuminate\Support\Facades\Auth::id())
            <div class="flex items-start justify-start">
                <div class="receive mr-2 bg-gray-300 mx-1 my-1 px-1 rounded-lg" style="text-align: left">
                    <p >{{$message->message}}</p>
                    
                </div>
                </div>
                <p class="text-xs ">{{ $message->user->name }}</p>
            @endif
        @endforeach
        {{-- @endif --}}
    </div>
 
    <form  >
      @csrf
     
        <textarea name="message" style="width:100%" class="mt-1 p-1 focus:outline-none focus:ring focus:border-blue-300  block w-full shadow-sm sm:text-sm border border-indigo-600 rounded-xl"></textarea>
       
        <button type="button" id="btn_send" class="inline-flex justify-center py-2 px-8 mt-1 border border-transparent shadow-sm text-sm font-medium rounded-xl text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none  focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 " style="float: right" >
        <svg
        class="w-4 h-4 transform rotate-45 -mt-px"
        fill="none"
        stroke="currentColor"
        viewBox="0 0 24 24"
        xmlns="http://www.w3.org/2000/svg"
      >
        <path
          stroke-linecap="round"
          stroke-linejoin="round"
          stroke-width="2"
          d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"
        ></path>
      </svg></button>
    
    </form>
 
    <input type="hidden" name="send" value="{{$param['send']}}">
    <input type="hidden" name="receive" value="{{$param['receive']}}">
    <input type="hidden" name="login" value="{{\Illuminate\Support\Facades\Auth::id()}}">
 
</div>
</div>
@endsection

 
 
{{-- Chatts --}}



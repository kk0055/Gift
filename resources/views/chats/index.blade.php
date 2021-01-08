@extends('layouts.app')
 
@section('content')
<div class="m-auto px-4 py-5 max-w-xl">
    <div class="row">
        <div class="col-start-2 col-span-4 ">
       
         
        </div>
    </div>
 
    {{--  チャットルーム  --}}
    <div id="room" class="justify-items-stretch">
      {{-- @if ($messages->send === auth()->id && $messages->receive === auth()->id ) --}}
     
    
        @foreach($messages as  $message)

            {{--   送信したメッセージ  --}}
            @if($message->send == \Illuminate\Support\Facades\Auth::id())
         
                <div class="send mr-2 " style="text-align: right">
                    <p>{{$message->message}}</p>
                    {{-- {{ $message->user->name }} --}}
                </div>
 
            @endif
 
            {{--   受信したメッセージ  --}}
            @if($message->receive == \Illuminate\Support\Facades\Auth::id())

                <div class="receive" style="text-align: left">
                    <p>{{$message->message}}</p>
                    {{ $message->user->name }}
                </div>
            @endif
        @endforeach
        {{-- @endif --}}
    </div>
 
    <form  >
      @csrf
     
        <textarea name="message" style="width:100%" class="focus:outline-none rounded-xl "></textarea>
       
        <button type="button" id="btn_send" class="inline-flex justify-center py-2 px-4 mt-2 border border-transparent shadow-sm text-sm font-medium rounded-xl text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none  focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 " style="float: right" >
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
 
@endsection

 
 
{{-- Chatts --}}



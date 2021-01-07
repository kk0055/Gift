@extends('layouts.app')
 
@section('content')
<div class="container">
    <div class="row">
        <div class="col-start-2 col-span-4 ">
        </div>
    </div>
 
    {{--  チャットルーム  --}}
    <div id="room">
      {{-- @if ($messages->send === auth()->id && $messages->receive === auth()->id ) --}}
          
    
        @foreach($messages as  $message)

       
            {{--   送信したメッセージ  --}}
            @if($message->send == \Illuminate\Support\Facades\Auth::id())
                <div class="send mr-2 " style="text-align: right">
                    <p>{{$message->message}}</p>
                </div>
 
            @endif
 
            {{--   受信したメッセージ  --}}
            @if($message->receive == \Illuminate\Support\Facades\Auth::id())
                <div class="receive" style="text-align: left">
                    <p>{{$message->message}}</p>
                   
                </div>
            @endif
        @endforeach
        {{-- @endif --}}
    </div>
 
    <form  >
      @csrf
        <textarea name="message" style="width:100%" class="focus:outline-none "></textarea>
        <button type="button" id="btn_send" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none  focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">送信</button>
    </form>
 
    <input type="hidden" name="send" value="{{$param['send']}}">
    <input type="hidden" name="receive" value="{{$param['receive']}}">
    <input type="hidden" name="login" value="{{\Illuminate\Support\Facades\Auth::id()}}">
 
</div>
 
@endsection

 
 
{{-- Chatts --}}



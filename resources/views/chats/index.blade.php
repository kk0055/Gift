@extends('layouts.app')
 
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
        </div>
    </div>
 
    {{--  チャットルーム  --}}
    <div id="room">
        @foreach($messages as $key => $message)
            {{--   送信したメッセージ  --}}
            @if($message->send == \Illuminate\Support\Facades\Auth::id())
                <div class="send" style="text-align: right">
                    <p>{{$message->message}}</p>
                </div>
 
            @endif
 
            {{--   受信したメッセージ  --}}
            @if($message->recieve == \Illuminate\Support\Facades\Auth::id())
                <div class="recieve" style="text-align: left">
                    <p>{{$message->message}}</p>
                </div>
            @endif
        @endforeach
    </div>
 
    {{-- method="post" action="{{ route('chatSend') }}" --}}
    <form  method="POST" >
      @csrf
        <textarea name="message" style="width:100%"></textarea>
        <button type="button" id="btn_send">送信</button>
    </form>
 
    <input type="hidden" name="send" value="{{$param['send']}}">
    <input type="hidden" name="recieve" value="{{$param['recieve']}}">
    <input type="hidden" name="login" value="{{\Illuminate\Support\Facades\Auth::id()}}">
 
</div>
 
@endsection

 
 

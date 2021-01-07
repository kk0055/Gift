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
  <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Scripts -->
     {{-- jquery --}}
   <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

  <style>
    #menu-toggle:checked + #menu {
      display: block;
    }
    .list-group{
      overflow-y: auto;
      height:200px;
    }
</style>
</head>
<body class=" bg-gray-200 ">
    <div id="app">
        
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            @auth
           <span class="caret">{{ Auth::user()->name }}</span>
            @endauth
            <button class="navbar-toggler focus:outline-none" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
                         
           
            <div class="collapse navbar-collapse" id="navbarNav">
              <ul class="navbar-nav">
                <li class="nav-item active">
                  <a class="nav-link" href="{{ route('main') }}">Home <span class="sr-only">(current)</span></a>
                </li>
                @guest
                <li class="nav-item">
                  <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
              </li>

              <li class="nav-item">
                <a class="nav-link" href="{{ route('register') }}">{{ __('register') }}</a>
            </li>
              @else
              {{-- <li class="nav-item">
                <a class="nav-link" href="#">  {{ Auth::user()->name }} </a>
            </li> --}}
            <li class="nav-item">
              <a class="nav-link" href="{{ route('logout') }}">    {{ __('Logout') }} <span class="caret"></span></a>
          </li>
          @endguest
              </ul>
            </div>
          </nav>

        <main class="py-4">

            @yield('content')


        </main>
    </div>
    <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
    <script src=“https://cdnjs.cloudflare.com/ajax/libs/push.js/0.0.11/push.min.js”></script>
    
    <script type="text/javascript">
 
        //ログを有効にする
        Pusher.logToConsole = true;
  
        var pusher = new Pusher('f215ae5857618ed02fd0', {
            cluster  : 'ap3',
            encrypted: true
        });
  
        //購読するチャンネルを指定
        var pusherChannel = pusher.subscribe('chat');
  
        //イベントを受信したら、下記処理
        pusherChannel.bind('chat_event', function(data) {
  
            let appendText;
            let login = $('input[name="login"]').val();
  
            if(data.send === login){
                appendText = '<div class="send" style="text-align:right"><p>' + data.message + '</p></div> ';
            }else if(data.receive === login){
                appendText = '<div class="receive" style="text-align:left"><p>' + data.message + '</p></div> ';
            }else{
                return false;
            }
  
            // メッセージを表示
            $("#room").append(appendText);
  
            if(data.receive === login){
                // ブラウザへプッシュ通知
                Push.create("新着メッセージ",
                    {
                        body: data.message,
                        timeout: 8000,
                        onClick: function () {
                            window.focus();
                            this.close();
                        }
                    })
  
            }
  
  
        });
  
  
         $.ajaxSetup({
             headers : {
                 'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content'),
             }});
  
  
         // メッセージ送信
         $('#btn_send').on('click' , function(){
             $.ajax({
                 type : 'POST',
                 url : '/chat/send',
                 data : {
                     message : $('textarea[name="message"]').val(),
                     send : $('input[name="send"]').val(),
                     receive : $('input[name="receive"]').val(),
                 }
             }).done(function(result){
                 $('textarea[name="message"]').val('');
             }).fail(function(result){
  
             });
         });
     </script>
     
  {{-- <script src="{{ asset('js/app.js') }}"></script> --}}
</body>
</html>
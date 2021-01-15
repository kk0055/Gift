<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Kasih</title>

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
    {{-- Fontawesome --}}
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    {{-- sweetalert --}}
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<style>

  /* imgae画面 */  
.image-container {
  display: flex;
  width: 90vh;
  height: 90vh;
}

.panel {
  background-size: cover;
  background-position: center;
  background-repeat: no-repeat;
  color: #fff;
  cursor: pointer;
  flex: 0.5;
  margin: 10px;
  position: relative;
  -webkit-transition: all 700ms ease-in;
}

.panel.active {
  flex: 5;
}

/* チャット画面 */
        /* width */
        ::-webkit-scrollbar {
            width: 7px;
        }
        /* Track */
        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }
        /* Handle */
        ::-webkit-scrollbar-thumb {
            background: #a7a7a7;
        }
        /* Handle on hover */
        ::-webkit-scrollbar-thumb:hover {
            background: #929292;
        }
        ul {
            margin: 0;
            padding: 0;
        }
        li {
            list-style: none;
        }
        .user-wrapper, .message-wrapper {
            border: 1px solid #dddddd;
            overflow-y: auto;
        }
        .user-wrapper {
            height: 600px;
        }
        .user {
            cursor: pointer;
            padding: 5px 0;
            position: relative;
        }
        .user:hover {
            background: #eeeeee;
        }
        .user:last-child {
            margin-bottom: 0;
        }
        .pending {
            position: absolute;
            left: 13px;
            top: 9px;
            background: #b600ff;
            margin: 0;
            border-radius: 50%;
            width: 18px;
            height: 18px;
            line-height: 18px;
            padding-left: 5px;
            color: #ffffff;
            font-size: 12px;
        }
        .media-left {
            margin: 0 10px;
        }
        .media-left img {
            width: 64px;
            border-radius: 64px;
        }
        .media-body p {
            margin: 6px 0;
        }
        .message-wrapper {
            padding: 10px;
            height: 536px;
            background: #eeeeee;
        }
        .messages .message {
            margin-bottom: 15px;
        }
        .messages .message:last-child {
            margin-bottom: 0;
        }
        .received, .sent {
            width: 45%;
            padding: 3px 10px;
            border-radius: 10px;
        }
        .received {
            background: #ffffff;
        }
        .sent {
            background: #3bebff;
            float: right;
            text-align: right;
        }
        .message p {
            margin: 5px 0;
        }
        .date {
            color: #777777;
            font-size: 12px;
        }
        .active {
            background: #eeeeee;
        }
        input[type=text] {
            width: 100%;
            padding: 12px 20px;
            margin: 15px 0 0 0;
            display: inline-block;
            border-radius: 4px;
            box-sizing: border-box;
            outline: none;
            border: 1px solid #cccccc;
        }
        input[type=text]:focus {
            border: 1px solid #aaaaaa;
        }

</style>
</head>

<body class=" bg-gray-100 ">
    <div id="app">
        
      @include('components.nav')

        <main class="">

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
                appendText = '<div class="flex items-end justify-end"> <div class="send  bg-green-300 mx-1 my-1 p-1 rounded-lg " style="text-align:right"><p>' + data.message + '</p></div></div> ';
            }else if(data.receive === login){
                appendText = '<div class="receive bg-gray-300 w-3/4 mx-4 my-2 p-2 rounded-lg clearfix" style="text-align:left"><p>' + data.message + '</p></div> ';
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
                     item_id : $('input[name="item_id"]').val(),
                 }
             }).done(function(result){
                 $('textarea[name="message"]').val('');
             }).fail(function(result){
  
             });
         });

       
     </script>
     <script>
        function loginAlert() {
            alert("ごめんなさい。ログインしてください(T_T)");
        }

 const panels = document.querySelectorAll('.panel')

panels.forEach(panel => {
    panel.addEventListener('click', () => {
        removeActiveClasses()
        panel.classList.add('active')
    })
})

function removeActiveClasses() {
    panels.forEach(panel => {
        panel.classList.remove('active')
    })
}
        </script>
  {{-- <script src="{{ asset('js/app.js') }}"></script> --}}
</body>
</html>
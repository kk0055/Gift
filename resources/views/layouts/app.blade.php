<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Kasih</title>
 

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
   {{-- CSS --}}
 <link rel="stylesheet" href="{{ asset('css/style.css') }}">
<style>




</style>
</head>

<body class=" font-sans bg-gray-100">
    <div id="app">
        
      @include('components.nav')

        <main class="">

            @yield('content')


        </main>
    </div>
    <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
    <script src=“https://cdnjs.cloudflare.com/ajax/libs/push.js/0.0.11/push.min.js”></script>
    

    <script>
        var receiver_id = '';
        var my_id = "{{ Auth::id() }}";
        $(document).ready(function () {
            // ajax setup form csrf token
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            // Enable pusher logging - don't include this in production
            Pusher.logToConsole = true;
            var pusher = new Pusher('f215ae5857618ed02fd0', {
                  cluster  : 'ap3',
                  encrypted: true
              });
          
            //購読するチャンネルを指定
            
              var channel = pusher.subscribe('chat');
              let appendText;
              channel.bind('chat_event', function (data) {
                // alert(JSON.stringify(data));
                if (my_id == data.send) {
                  
                    $('#' + data.receive).click();
                } else if (my_id == data.receive) {
                    if (receiver_id == data.send) {
                        
                        $('#' + data.send).click();
                    } else {
                        // if receiver is not seleted, add notification for that user
                        var pending = parseInt($('#' + data.send).find('.pending').html());
                        if (pending) {
                            $('#' + data.send).find('.pending').html(pending + 1);
                        } else {
                            $('#' + data.send).append('<span class="pending">1</span>');
                        }
                    }
             
                }
                        // メッセージを表示
              $("#admin").append(appendText);
            });
          
            
            $('.user').click(function () {
                $('.user').removeClass('active');
                $(this).addClass('active');
                $(this).find('.pending').remove();
                receiver_id = $(this).attr('id');
                $.ajax({
                    type: "get",
                    url: "message/" + receiver_id, 
                    data: "",
                    cache: false,
                    success: function (data) {
                        $('#messages').html(data);
                        scrollToBottomFunc();
                    }
                });
            });

            
            $(document).on('keyup', '.input-text input', function (e) {
                var messages = $(this).val();
                console.log($('input[name="message"]').val())
                // check if enter key is pressed and message is not null also receiver is selected
                if (e.keyCode == 13 && messages != '' && receiver_id != '') {
                    $(this).val(''); // while pressed enter text box will be empty
                    // var datastr = "receiver_id=" + receiver_id + "&message=" + message;
                    
                    $.ajax({
                        type: "post",
                        url: "message", // need to create this post route
                        data:  {
                        message : messages,
                        send : $('input[name="send"]').val(),
                        receive :   receiver_id,
                        item_id : $('input[name="item_id"]').val(),
                         },
                        cache: false,
                        success: function (data) {
                          
                                                  },
                        error: function (jqXHR, status, err) {
                        },
                        complete: function () {
                            scrollToBottomFunc();
                        }
                    })
                }
            });
        });
        // make a function to scroll down auto
        function scrollToBottomFunc() {
            $('.message-wrapper').animate({
                scrollTop: $('.message-wrapper').get(0).scrollHeight
            }, 50);
        }
      </script>


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
let send = $('input[name="send"]').val();
let receive = $('input[name="receive"]').val();

if(data.send === login){
appendText = '<div class="flex items-end justify-end"> <div class="send  bg-green-300 mx-1 my-1 p-1 rounded-lg " style="text-align:right"><p>' + data.message + '</p></div></div> ';
}else if(data.receive === login){
appendText = '<div class="receive bg-gray-300 w-3/4 mx-4 my-2 p-2 rounded-lg clearfix" style="text-align:left"><p>' + data.message + '</p></div> ';
}else {
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

{{--  --}}
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
const menuToggle = document.querySelector('.toggle');
      const showcase = document.querySelector('.showcase');

      menuToggle.addEventListener('click', () => {
        menuToggle.classList.toggle('active');
        showcase.classList.toggle('active');
      })
        </script>
  {{-- <script src="{{ asset('js/app.js') }}"></script> --}}
</body>
</html>
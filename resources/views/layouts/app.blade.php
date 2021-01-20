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

*
{
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: 'Poppins', sans-serif;
}
header
{
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  padding: 40px 100px;
  z-index: 1000;
  display: flex;
  justify-content: space-between;
  align-items: center;
}
header .logo
{
  color: #fff;
  text-transform: uppercase;
  cursor: pointer;
}
.toggle
{
  position: relative;
  width: 60px;
  height: 60px;
  background: url(https://i.ibb.co/HrfVRcx/menu.png);
  background-repeat: no-repeat;
  background-size: 30px;
  background-position: center;
  cursor: pointer;
}
.toggle.active
{
  background: url(https://i.ibb.co/rt3HybH/close.png);
  background-repeat: no-repeat;
  background-size: 25px;
  background-position: center;
  cursor: pointer;
}
.showcase
{
  position: relative;
  right: 0;
  width: 100%;
  padding: 100px;
  display: flex;
  justify-content: space-between;
  align-items: center;
  transition: 0.5s;
  z-index: 2;
}
.showcase.active
{
  right: 300px;
}

.showcase img
{
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  object-fit: cover;
  opacity:1.2;
}
.overlay
{
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: #03a9f4;
  mix-blend-mode: overlay;
}
.text
{
  position: relative;
  z-index: 10;
}

.text h2
{
  font-size: 5em;
  font-weight: 800;
  color: #fff;
  line-height: 1em;
  text-transform: uppercase;
}
.text h3
{
  font-size: 4em;
  font-weight: 700;
  color: #fff;
  line-height: 1em;
  
}

/* .text a
{
  display: inline-block;
  font-size: 1em;
  background: #fff;
  padding: 10px 30px;
  text-decoration: none;
  font-weight: 500;
  margin-top: 10px;
  color: #111;
  letter-spacing: 2px;
  transition: 0.2s;
  
}
.text a:hover
{
  letter-spacing: 6px;
  background: #fff;
} */

.menu
{
  position: absolute;
  top: 0;
  right: 0;
  width: 300px;
  height: 30%;
  display: flex;
  justify-content: center;
  align-items: center;
}
.menu ul
{
  position: relative;
}
.menu ul li
{
  list-style: none;
}
.menu ul li a
{
  text-decoration: none;
  font-size: 24px;
  color: #111;
}
.menu ul li a:hover
{
  color: gray; 
}

.hbtn {
      position: relative;
      box-sizing: border-box;
      display: inline-block;
      overflow: hidden;
      padding: 8px 20px;
      margin: 0px 3px 6px;
      text-align: center;
      border: 2px solid rgb(255, 255, 255);
      text-decoration: none;
      color: rgb(255, 255, 255);
      white-space: nowrap;
      z-index: 0;
      font-weight: 500;
       margin-top: 10px;
} 
 

.hbtn i {
      padding-right: 8px;
} 
 

.hb-fill-on::before {
      position: absolute;
      content: "";
      background: rgb(255, 255, 255);
      transition-duration: 0.3s;
      z-index: -1;
      inset: 0px auto auto 0px;
      width: 100%;
      height: 100%;
      opacity: 0;
} 
 

.hb-fill-on:hover::before {
      width: 100%;
      height: 100%;
      opacity: 1;
} 
 

.hb-fill-on:hover {
      color: rgb(0, 0, 0);
      background: rgb(255, 255, 255);
      transition: color 0.3s ease 0s, background 0s ease 0.3s;
} 

@media (max-width: 991px)
{
  .showcase,
  .showcase header
  {
    padding: 40px;
  }
  .text h2
  {
    font-size: 3em;
  }
  .text h3
  {
    font-size: 2em;
  }
}


</style>
</head>

<body class=" bg-gray-200 ">
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
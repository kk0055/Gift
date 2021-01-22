

//ログを有効にする
// Pusher.logToConsole = true;

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


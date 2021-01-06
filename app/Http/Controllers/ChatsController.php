<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Mail\SampleNotification;
use App\Events\ChatMessageRecieved;
use Illuminate\Support\Facades\Mail;

class ChatsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
 
        $user = Auth::user();
 
        // ログイン者以外のユーザを取得する
        $users = User::where('id' ,'<>' , $user->id)->get();
        // チャットユーザ選択画面を表示
        return view('chats.chat_user_select' , compact('users'));
    }


 
    public function sendChat(Request $request , $recieve)
    {
        // チャットの画面
        $loginId = Auth::id();
 
        $param = [
          'send' => $loginId,
          'recieve' => $recieve,
        ];
 
        // 送信 / 受信のメッセージを取得する
        $query = Message::where('send' , $loginId)->where('recieve' , $recieve);;
        $query->orWhere(function($query) use($loginId , $recieve){
            $query->where('send' , $recieve);
            $query->where('recieve' , $loginId);
 
        });
 
        $messages = $query->get();
 
        return view('chats.index' , compact('param' , 'messages'));
    }
 
    /**
     * メッセージの保存をする
     */
    public function store(Request $request)
    {
 
        // リクエストパラメータ取得
        $insertParam = [
            'send' => $request->input('send'),
            'recieve' => $request->input('recieve'),
            'message' => $request->input('message'),
        ];
 
 
        // メッセージデータ保存
        try{
            Message::insert($insertParam);
        }catch (\Exception $e){
            return false;
          
        }
 
 
        // イベント発火
        event(new ChatMessageRecieved($request->all()));
 
        // メール送信
        // $mailSendUser = User::where('id' , $request->input('recieve'))->first();
        // $to = $mailSendUser->email;
        // Mail::to($to)->send(new SampleNotification());
 
        return true;
 
    }

                /**
         * Fetch all messages
         *
         * @return Message
         */
        public function fetchMessages()
        {
        return Message::with('user')->get();
        }

    public function sendMessage(Request $request)
   {
  $user = Auth::user();

  $message = $user->messages()->create([
    'message' => $request->input('message')
  ]);

  return ['status' => 'Message Sent!'];
  }

}

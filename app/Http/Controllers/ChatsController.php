<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\User;
use App\Models\Item;
use Illuminate\Support\Facades\Auth;
use App\Events\ChatMessagereceived;
use Illuminate\Support\Facades\Mail;
use App\Mail\ChatReceived;

class ChatsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    // 使わない可能性あり
    public function index(User $user)
    {
        $items =  Item::all();
          
        $messages = Message::where('status',0)->where('send',$user->id)->get();

        // dd($messages);
        // ログイン者以外のユーザを取得する
        $users = User::where('id' ,'<>' , $user->id)->with('messages')->get();
        // チャットユーザ選択画面を表示
        return view('chats.chat_user_select' , [
            'users' => $users,
            'items' => $items,
            'messages' =>$messages
        ]);
    }
 
    // public function status(User $user)
    // {
    //     $message = Message::where('status',0);

    //     if($message == 0) {
    //         $message->update(['status' => 1]);
    //     }

    //     dd($message);
    //     return;
    // }

 
    public function sendChat(Request $request,  $receive ,$itemId )
    {
        
        // チャットの画面
        $loginId = Auth::id();
 
        $param = [
          'send' => $loginId,
          'receive' => $receive,
        ];
 
        // 送信 / 受信のメッセージを取得する
        $query = Message::where('send' , $loginId)->where('receive' , $receive);
        $query->orWhere(function($query) use($loginId , $receive){
            $query->where('send' , $receive);
            $query->where('receive' , $loginId);
 
        });

        $messages = $query->get();

        $user = User::where('id', $param['receive'])->get();
        $item = Item::findOrFail($itemId);
        // dd($item );

        return view('chats.index' , compact('param' , 'messages','user','item'));
    }
 
    /**
     * メッセージの保存をする
     */
    public function store(Request $request)
    {
 
        // リクエストパラメータ取得
        $insertParam = [
            'send' => $request->input('send'),
            'receive' => $request->input('receive'),
            'message' => $request->input('message'),
            'user_id' => Auth::user()->id
        ];
 
 
        // メッセージデータ保存
        try{
            Message::insert($insertParam);
        }catch (\Exception $e){
            return false;
          
        }
 
 
        // イベント発火
        event(new ChatMessagereceived($request->all()));
 
        // メール送信
        // $mailSendUser = User::where('id' , $request->input('receive'))->first();
        // $to = $mailSendUser->email;
        // Mail::to($to)->send(new ChatReceived());
 
        return true;
 
    }


}

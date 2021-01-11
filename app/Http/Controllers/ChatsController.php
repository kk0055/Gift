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
        $create =  Item::all();

        // dd($create );

        $user = find($user);
    //    dd($user);
        // ログイン者以外のユーザを取得する
        $users = User::where('id' ,'<>' , $user->id)->get();
        // チャットユーザ選択画面を表示
        return view('chats.index' , [
            'users' => $users,
            'create' => $create
           
        ]);
    }


 
    public function sendChat(User $user , $receive )
    {

        
        // チャットの画面
        $loginId = Auth::id();
 
        $param = [
          'send' => $loginId,
          'receive' => $receive,
        ];
 
        // 送信 / 受信のメッセージを取得する
        $query = Message::where('send' , $loginId)->where('receive' , $receive);;
        $query->orWhere(function($query) use($loginId , $receive){
            $query->where('send' , $receive);
            $query->where('receive' , $loginId);
 
        });

        $messages = $query->get();
        
        // $user =  User::all();
        $toSend = Item::with('user')->get();
        
        // $toSend = $user->items;
        // $toSend = $request->all();
        // $toSend = Item::find($itemId);

        
        //  dd( $toSend);
        //  dd( $toSend);
   

        return view('chats.index' , compact('param' , 'messages','toSend' ,'user'));
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
        $mailSendUser = User::where('id' , $request->input('receive'))->first();
        $to = $mailSendUser->email;
        Mail::to($to)->send(new ChatReceived());
 
        return true;
 
    }


}

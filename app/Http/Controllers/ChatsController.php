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
    //    dd($user);
        // $user = auth()->user();
        $items = Item::orderBy('created_at','desc')->with(['user'])->paginate(20); 
        $messages = Message::where('receive',$user->id)->get();
       
        
        // ログイン者以外のユーザを取得する
        $users = User::where('id' ,'<>' , $user->id)->get();
        // チャットユーザ選択画面を表示
        // dd($messages );
        return view('chats.chat_user_select' , [
            'users' => $users,
            'messages' =>$messages,
            'items' => $items
          
        ]);
    }
 
 
    public function sendChat(Request $request,  $receive ,$itemId )
    {
         //$receive == item->user-id

        // dd($receive);
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
    //   dd($messages );
        $user = User::where('id', $param['receive'])->get();
        $item = Item::findOrFail($itemId);
        // dd($item );

        return view('chats.sendChat' , compact('param' , 'messages','user','item'));
    }
 

    /**
     * メッセージの保存をする
     */
    public function store(Request $request)
    {
        // dd($request);  
        // リクエストパラメータ取得
        $insertParam = [
            'send' => $request->input('send'),
            'receive' => $request->input('receive'),
            'message' => $request->input('message'),
            'user_id' => Auth::user()->id,
            'item_id' => $request->input('item_id')
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

         /**
     * AUthユーザーが受け取ったチャットの画面
     */
    public function receivedChat(Request $request,  $receive, $itemId )
    {
        //$receive == ログインしてるユーザーになってる
        //itemId ==  item->user-id
        // dd($itemId);
            // チャットの画面
            $loginId = Auth::id();
            $param = [
              'send' => $loginId,
              'receive' => $receive,
            ];
     
            // 送信 / 受信のメッセージを取得する
            $query = Message::where('send' , $loginId)->where('receive' , $itemId);
            $query->orWhere(function($query) use($loginId , $itemId){
                $query->where('send' , $itemId);
                $query->where('receive' , $loginId);
     
            });
    
            $messages = $query->get();
            // dd($messages);
            $user = User::where('id', $param['send'])->get();
            $item = Item::findOrFail($itemId);
            dd($item );
    
            return view('chats.receivedChat' , compact('param' , 'messages','user','item','loginId'));
    }

}

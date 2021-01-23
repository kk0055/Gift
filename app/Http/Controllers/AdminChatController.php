<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Pusher\Pusher;
use App\Events\ChatMessagereceived;

class AdminChatController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
      
        
        
        //正しいやつ
        // $users = DB::select("select users.id, users.name, users.email,  count(is_read) as unread 
        // from users LEFT  JOIN  messages ON users.id = messages.send and is_read = 0 and messages.receive  = " . Auth::id() . "
        // where users.id != " . Auth::id() . " 
        // group by users.id, users.name,  users.email
        // order by messages.is_read desc
        // ");

        $users = DB::select("select users.id, users.name, users.email,  count( case is_read when '0' then 1 else null end ) as unread 
        from users LEFT  JOIN  messages ON users.id = messages.send  and messages.receive  = " . Auth::id() . "
        where messages.user_id = users.id AND  users.id != " . Auth::id() . " 
        group by users.id, users.name,  users.email
        ");

          //正しいやつ
        // $users = User::whereExists(function($q){

        //     $q->from('messages')
        //         ->whereRaw('messages.user_id = users.id')
        //         ->where('users.id' ,'!=', Auth::id());
                
        // })->get();

    
        return view('chats.adminChats', [
            'users' => $users,
         
            ]);
    }

    public function getMessage($user_id)
    {
        $my_id = Auth::id();

        // Make read all unread message
        Message::where(['send' => $user_id, 'receive' => $my_id])->update(['is_read' => 1]);

        // Get all message from selected user
        $messages = Message::where(function ($query) use ($user_id, $my_id) {
            $query->where('send', $user_id)->where('receive', $my_id);
        })->oRwhere(function ($query) use ($user_id, $my_id) {
            $query->where('send', $my_id)->where('receive', $user_id);
        })->get();

        // dd($messages);
        return view('chats.mainChats', ['messages' => $messages]);
    }

    public function sendMessage(Request $request )
    {
       
        $send = Auth::id();
        $receive = $request->input('receive');
        $message = $request->input('message');
        $item = $request->item_id;
       
        $data = new Message();
       
        $data->send = $send;
        $data->receive = $receive;
        $data->message = $message;
        $data->is_read = 0; // message will be unread when sending message
        $data->item_id = $item;
        $data->user_id = Auth::user()->id;
        $data->save();

        // pusher
        $options = array(
            'cluster' => 'ap3',
            'useTLS' => true
        );

        $pusher = new Pusher(
            env('PUSHER_APP_KEY'),
            env('PUSHER_APP_SECRET'),
            env('PUSHER_APP_ID'),
            $options
        );

        $data = ['send' => $send, 'receive' => $receive]; 
        $pusher->trigger('chat', 'chat_event', $data);
    }
}
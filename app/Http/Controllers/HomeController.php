<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Pusher\Pusher;

class HomeController extends Controller
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
        // select all users except logged in user
        

        // count how many message are unread from the selected user
        
        // $users = DB::select("select users.id, users.name, users.email,  count(is_read) as unread 
        // from users LEFT  JOIN  messages ON users.id = messages.send and is_read = 0 and messages.receive  = " . Auth::id() . "
        // where users.id != " . Auth::id() . " 
       
        // group by users.id, users.name,  users.email
        // ");
    //   order by 'messages' desc  and  messages.created_at 
       // ログイン者以外のユーザを取得する
    //    $users = User::where('id' ,'<>' , Auth::user()->id)->with('messages')->get();

     
        $users = User::where('id' ,'!=', Auth::id())->with('messages')->orderBy('created_at','desc')->get();
        // dd($users );
        return view('chats.adminChats', ['users' => $users]);
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
        $receive = $request->receiver_id;
        $message = $request->message;
        
        $data = new Message();
       
        $data->send = $send;
        $data->receive = $receive;
        $data->message = $message;
        $data->is_read = 0; // message will be unread when sending message
        $data->item_id = $request->input('item_id');
        $data->user_id = Auth::user()->id;
        $data->save();

        // pusher
        $options = array(
            'cluster' => 'ap2',
            'useTLS' => true
        );

        $pusher = new Pusher(
            env('PUSHER_APP_KEY'),
            env('PUSHER_APP_SECRET'),
            env('PUSHER_APP_ID'),
            $options
        );

        $data = ['send' => $send, 'receive' => $receive]; // sending from and to user id when pressed enter
        $pusher->trigger('chat', 'chat_event', $data);
    }
}
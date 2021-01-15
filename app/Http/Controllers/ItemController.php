<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\User;
use App\Models\Message;
use App\Http\Resources\Item as ItemResource;
use Illuminate\Support\Facades\Auth;

class ItemController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth'])->only(['store', 'destroy']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * 
     */
    public function index(User $user )
    {
       
        // Message receiveが欲しい
        // dd($send);

        $user = auth()->user();

        $receive = Message::where('receive',$user->id)->get();

        // dd($receive);
       

        $items = Item::orderBy('created_at','desc')->with(['user','messages'])->paginate(20);
        // dump($items);
        return view('main', [
            'user' => $user,
            'items' => $items,
       
        ]);
        // return ItemResource::collection($items);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    
        $this->validate($request, [
           'title' => 'required',
           'body' => 'required'
        ],
           [
                  'title.required' => 'タイトルは必須項目です。',
                  'body.required'  => '詳細は必須項目です。',
                
           ]);
        

        if($request->hasFile('image')){
        $filenameWithExt = $request->file('image')->getClientOriginalName();
        $filename = pathinfo($filenameWithExt ,PATHINFO_FILENAME);
        $extension = $request->file('image')->getClientOriginalExtension();
        $fileNameToStore = $filename . '_'. time(). '.'.$extension;
        $path = $request->file('image')->storeAs('public/image',  $fileNameToStore);
        }else {
        $fileNameToStore = null;
        }

        if($request->hasFile('image2')){
            $filenameWithExt = $request->file('image2')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt ,PATHINFO_FILENAME);
            $extension = $request->file('image2')->getClientOriginalExtension();
            $fileNameToStore2 = $filename . '_'. time(). '.'.$extension;
            $path = $request->file('image2')->storeAs('public/image',  $fileNameToStore2);
            }else {
            $fileNameToStore2 = null;
            }

        $request->user()->items()->create([
            'title' => $request->title,
            'body' => $request->body,
            'image' =>  $fileNameToStore,
            'image2' =>  $fileNameToStore2,
        ]);
    //    dd($request);
       return back()->with('info','投稿が完了しました。');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($itemId)
    {
        $item = Item::findOrFail($itemId);
    // dd($item);
        //一つのItemを返す
        return view('items.show',[
            'item' =>$item
        ]);
    }
        public function edit($itemId)
        {
            $item = Item::findOrFail($itemId);
        // dd($item);
            //一つのItemを返す

            // dd($item);
            return view('items.edit',[
                'item' =>$item
            ]);

      }


public function update(Request $request, $itemId)
{

$this->validate($request, [
'title' => 'required',
'body' => 'required'
],
[
    'title.required' => 'タイトルは必須項目です。',
    'body.required'  => '詳細は必須項目です。',
    
]);
$item = Item::findOrFail($itemId);

if($request->hasFile('image')){
$filenameWithExt = $request->file('image')->getClientOriginalName();
$filename = pathinfo($filenameWithExt ,PATHINFO_FILENAME);
$extension = $request->file('image')->getClientOriginalExtension();
$fileNameToStore = $filename . '_'. time(). '.'.$extension;
$path = $request->file('image')->storeAs('public/image',  $fileNameToStore);
}else {
$fileNameToStore = $item->image;
}

if($request->hasFile('image2')){
$filenameWithExt = $request->file('image2')->getClientOriginalName();
$filename = pathinfo($filenameWithExt ,PATHINFO_FILENAME);
$extension = $request->file('image2')->getClientOriginalExtension();
$fileNameToStore2 = $filename . '_'. time(). '.'.$extension;
$path = $request->file('image2')->storeAs('public/image',  $fileNameToStore2);
}else {
$fileNameToStore2 = $item->image2;
}


$item->update([
'title' => $request->title,
'body' => $request->body,
'image' =>  $fileNameToStore,
'image2' =>  $fileNameToStore2,
]);

//    dd($request);
return redirect()->route('item.show',['itemId'=> $item->id])->with('info','編集が完了しました。');
}

      
    public function destroy(Item $Item)
    {
        // $this->authorize('delete', $Item);

        $Item->delete();

        return back();
    }

}

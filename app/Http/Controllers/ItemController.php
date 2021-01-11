<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\User;
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
      
        $user = auth()->user();
        $items = Item::orderBy('created_at','desc')->with(['user'])->paginate(20);

       
        return view('main', [
            'user' => $user,
            'items' => $items
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
        

    //    $request->user()->items()->create([
    //         'title' => $request->title,
    //         'body' => $request->body,
    //         'image' => $request->image,
    //    ]);

        if($request->hasFile('image')){
        $filenameWithExt = $request->file('image')->getClientOriginalName();
        $filename = pathinfo($filenameWithExt ,PATHINFO_FILENAME);
        $extension = $request->file('image')->getClientOriginalExtension();
        $fileNameToStore = $filename . '_'. time(). '.'.$extension;
        $path = $request->file('image')->storeAs('public/image',  $fileNameToStore);
        }else {
        $fileNameToStore = null;
        }

        $request->user()->items()->create([
            'title' => $request->title,
            'body' => $request->body,
            'image' =>  $fileNameToStore,
        ]);

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
        return view('show',[
            'item' =>$item
        ]);

    }

    public function destroy(Item $Item)
    {
        // $this->authorize('delete', $Item);

        $Item->delete();

        return back();
    }

}

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
     */
    public function index(User $user)
    {
        // dd( auth()->user()->name);
       
        $user = auth()->user();
        $items = Item::orderBy('created_at','desc')->with(['user'])->paginate(20);
    //   dd($user);
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
        // $item = $request->isMethod('put') ? Item::findOrFail($request->item_id) : new Item;

        // // $item->id = $request->input('item_id');
        // $item->user_id = $item->user()->id;
        // $item->title = $request->input('title');
        // $item->body = $request->input('body');
        // $item->image = $request->input('image');

        // if($item->save()) {
        //     return new ItemResource($item);
        // }else{
        //     return 'Error';
        // }

        $this->validate($request, [
           'title' => 'required',
           'body' => 'required'
        ]);
        

       $request->user()->items()->create([
            'title' => $request->title,
            'body' => $request->body,
            'image' => $request->image,
       ]);

       return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = Item::findOrFail($id);

        //一つのItemを返す
        return new ItemResource($item);

    }

    public function destroy(Item $Item)
    {
        $this->authorize('delete', $Item);

        $Item->delete();

        return back();
    }

}

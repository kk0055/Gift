<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\User;
use App\Http\Resources\Item as ItemResource;
use Illuminate\Support\Facades\Auth;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Item::orderBy('created_at', 'desc')->paginate(5);

        return view('main')->with('items' ,$items);
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
        $item = $request->isMethod('put') ? Item::findOrFail($request->item_id) : new Item;

        // $item->id = $request->input('item_id');
        $item->user_id = $item->user()->id;
        $item->title = $request->input('title');
        $item->body = $request->input('body');
        $item->image = $request->input('image');

        if($item->save()) {
            return new ItemResource($item);
        }else{
            return 'Error';
        }
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Item::findOrFail($id);

        if($item->delete()) {
            return new ItemResource($item);
        }  
    }
}

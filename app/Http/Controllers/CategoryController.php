<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Category;

class CategoryController extends Controller
{
 

            /**
     * カテゴリ一覧画面
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
     public function category()
    {
        $categories = Category::paginate(20);
        // dump($items);
        return view('admin.category', [
            'categories' => $categories,
            
       
        ]);
    }

    public function show($category)
    {
        // dd($category);
         
        // $categories_products = Category::where('id',$category )->get();
        $categories_products =  Item::where('category_id',$category )->orderBy('created_at','desc')->get();
        $category = Category::find($category);
        // $pruducts = $categories_products->items;
        // dd($category);
            //一つのItemを返す
            return view('category.category',[
                'categories_products' => $categories_products ,
                'category' => $category
            ]);
    }

    public function store(Request $request)
    {
    
        $this->validate($request, [
           'name' => 'required',
           'slug' => 'required',
        ]);
        

        $category = Category::create([
            'name' => $request->name,
            'slug' =>  $request->slug,
            
        ]);
    //    dd($request);
       return back()->with('info','作成が完了しました。');
    }


}

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

        /**
     * カテゴリ編集・新規作成API
     *
     * @param AdminBlogRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function editCategory(Request $request)
    {
        $input = $request->input();
        $category_id = $request->input('category_id');

        $category = $this->category->updateOrCreate(compact('category_id'), $input);

        // APIなので json のレスポンスを返す
        return response()->json($category);
    }

    
    /**
     * カテゴリ削除API
     *
     * @param AdminBlogRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteCategory(Request $request)
    {
        $category_id = $request->input('category_id');
        $this->category->destroy($category_id);

        // APIなので json のレスポンスを返す
        return response()->json();
    }
}

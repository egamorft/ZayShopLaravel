<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Resources\CategoryResource;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return CategoryResource::collection(Category::orderBy('category_id', 'desc')->paginate(4));
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
        $request->validate([
            'category_name' => 'required|alpha',
            'category_status' => 'required',
        ]);
        $category = new Category;
        $category->category_name = $request->category_name;
        $category->category_desc = $request->category_desc;
        $category->category_status = $request->category_status;
        $category->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        return new CategoryResource($category);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        if($category->category_status == 0){
            $category->category_status = 1;
        }else{
            DB::table('tbl_subcategory')
            ->where('category_id', $category->category_id)
            ->update(['subcategory_status' => 0]);

            DB::table('tbl_product')
            ->where('category_id', $category->category_id)
            ->update(['product_status' => 0]);
            $category->category_status = 0;
        }
        $category->save();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'category_name' => 'required|alpha',
            'category_status' => 'required',
        ]);
        $category->category_name = $request->category_name;
        $category->category_desc = $request->category_desc;
        $category->category_status = $request->category_status;
        $category->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();
    }
    
    //public page

    public function shop_category(Request $request, $category_id)
    {
        $category = DB::table('tbl_category')
            ->where('category_status', '1')
            ->orderBy('category_id', 'asc')
            ->get();
        $subcategory = DB::table('tbl_subcategory')
            ->where('subcategory_status', '1')
            ->orderBy('category_id', 'asc')
            ->get();

        if (isset($_GET['sort_by'])) {
            $sort_by = $_GET['sort_by'];
            if ($sort_by == 'asc') {
                $category_by_id = Product::with('category')
                    ->where('tbl_product.category_id', $category_id)
                    ->where('tbl_product.product_status', 1)
                    ->orderBy('product_price', 'asc')
                    ->paginate(3)->appends(request()->query());
            } else if ($sort_by == 'desc') {
                $category_by_id = Product::with('category')
                    ->where('tbl_product.category_id', $category_id)
                    ->where('tbl_product.product_status', 1)
                    ->orderBy('product_price', 'desc')
                    ->paginate(3)->appends(request()->query());
            } else if ($sort_by == 'atoz') {
                $category_by_id = Product::with('category')
                    ->where('tbl_product.category_id', $category_id)
                    ->where('tbl_product.product_status', 1)
                    ->orderBy('product_name', 'asc')
                    ->paginate(3)->appends(request()->query());
            } else if ($sort_by == 'ztoa') {
                $category_by_id = Product::with('category')
                    ->where('tbl_product.category_id', $category_id)
                    ->where('tbl_product.product_status', 1)
                    ->orderBy('product_name', 'desc')
                    ->paginate(3)->appends(request()->query());
            } else {
                $category_by_id = Product::with('category')
                    ->where('tbl_product.category_id', $category_id)
                    ->where('tbl_product.product_status', 1)
                    ->paginate(3)->appends(request()->query());
            }
        } else {
            $category_by_id = Product::with('category')
                ->where('tbl_product.category_id', $category_id)
                ->where('tbl_product.product_status', 1)
                ->paginate(3)->appends(request()->query());
        }

        return view('pages.category.shop_category')
            ->with(compact('category', 'subcategory', 'category_by_id'));
    }

    //end public page
}

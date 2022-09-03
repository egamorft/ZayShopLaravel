<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\AdminCategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Product;
use App\SubCategory;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $all_category = Category::where('category_status', '1')->orderBy('category_id', 'asc')->pluck('category_id', 'category_name');
        $category_paginate = Category::orderBy('category_id', 'desc')->paginate(4);
        return CategoryResource::collection(['category' => $all_category, 'category_list' => $category_paginate]);
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
    public function store(AdminCategoryRequest $request)
    {
        $request->except('_token');
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
        if ($category->category_status == 0) {
            $category->category_status = 1;
        } else {
            SubCategory::where('category_id', $category->category_id)
                ->update(['subcategory_status' => 0]);

            SubCategory::where('category_id', $category->category_id)
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
    public function update(AdminCategoryRequest $request, Category $category)
    {
        $request->except('_token');
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
        $category = Category::where('category_status', '1')
            ->orderBy('category_id', 'asc')
            ->get();
        $subcategory = Category::where('subcategory_status', '1')
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

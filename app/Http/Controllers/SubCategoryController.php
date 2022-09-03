<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\AdminSubCategoryRequest;
use App\Http\Resources\SubCategoryResource;
use App\Product;
use App\SubCategory;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return SubCategoryResource::collection(SubCategory::with('category')->orderBy('subcategory_id', 'desc')->paginate(4));
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
    public function store(AdminSubCategoryRequest $request)
    {
        $request->except('_token');
        $subcategory = new SubCategory;
        $subcategory->subcategory_name = $request->subcategory_name;
        $subcategory->subcategory_desc = $request->subcategory_desc;
        $subcategory->category_id = $request->category_id;
        $subcategory->subcategory_status = $request->subcategory_status;
        $subcategory->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $subcategory
     * @return \Illuminate\Http\Response
     */
    public function show(SubCategory $subcategory)
    {
        return new SubCategoryResource($subcategory);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $subcategory
     * @return \Illuminate\Http\Response
     */
    public function edit(SubCategory $subcategory)
    {
        if ($subcategory->subcategory_status == 0) {
            $subcategory->subcategory_status = 1;
        } else {
            Product::where('subcategory_id', $subcategory->subcategory_id)
                ->update(['product_status' => 0]);
            $subcategory->subcategory_status = 0;
        }
        $subcategory->save();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $subcategory
     * @return \Illuminate\Http\Response
     */
    public function update(AdminSubCategoryRequest $request, SubCategory $subcategory)
    {
        $request->except('_token');
        $subcategory->subcategory_name = $request->subcategory_name;
        $subcategory->subcategory_desc = $request->subcategory_desc;
        $subcategory->category_id = $request->category_id;
        $subcategory->subcategory_status = $request->subcategory_status;
        $subcategory->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $subcategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(SubCategory $subcategory)
    {
        $subcategory->delete();
    }


    //public page
    public function shop_subcategory(Request $request, $subcategory_id)
    {
        $category = Category::where('category_status', '1')
            ->orderBy('category_id', 'asc')
            ->get();
        $subcategory = Subcategory::where('subcategory_status', '1')
            ->orderBy('category_id', 'asc')
            ->get();

        if (isset($_GET['sort_by'])) {
            $sort_by = $_GET['sort_by'];
            if ($sort_by == 'asc') {
                $subcategory_by_id = Product::with('subcategory')
                    ->where('tbl_product.subcategory_id', $subcategory_id)
                    ->where('tbl_product.product_status', 1)
                    ->orderBy('product_price', 'asc')
                    ->paginate(3)->appends(request()->query());
            } else if ($sort_by == 'desc') {
                $subcategory_by_id = Product::with('subcategory')
                    ->where('tbl_product.subcategory_id', $subcategory_id)
                    ->where('tbl_product.product_status', 1)
                    ->orderBy('product_price', 'desc')
                    ->paginate(3)->appends(request()->query());
            } else if ($sort_by == 'atoz') {
                $subcategory_by_id = Product::with('subcategory')
                    ->where('tbl_product.subcategory_id', $subcategory_id)
                    ->where('tbl_product.product_status', 1)
                    ->orderBy('product_name', 'asc')
                    ->paginate(3)->appends(request()->query());
            } else if ($sort_by == 'ztoa') {
                $subcategory_by_id = Product::with('subcategory')
                    ->where('tbl_product.subcategory_id', $subcategory_id)
                    ->where('tbl_product.product_status', 1)
                    ->orderBy('product_name', 'desc')
                    ->paginate(3)->appends(request()->query());
            } else {
                $subcategory_by_id = Product::with('subcategory')
                    ->where('tbl_product.subcategory_id', $subcategory_id)
                    ->where('tbl_product.product_status', 1)
                    ->paginate(3)->appends(request()->query());
            }
        } else {
            $subcategory_by_id = Product::with('subcategory')
                ->where('tbl_product.subcategory_id', $subcategory_id)
                ->where('tbl_product.product_status', 1)
                ->paginate(3)->appends(request()->query());
        }

        return view('pages.subcategory.shop_subcategory')
            ->with(compact('category', 'subcategory', 'subcategory_by_id'));
    }
    //end public page
}

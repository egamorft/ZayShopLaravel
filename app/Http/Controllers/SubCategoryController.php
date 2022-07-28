<?php

namespace App\Http\Controllers;

use App\Http\Resources\SubCategoryResource;
use App\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
    public function store(Request $request)
    {
        $request->validate([
            'subcategory_name' => 'required|alpha',
            'category_id' => 'required',
            'subcategory_status' => 'required',
        ]);
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
        if($subcategory->subcategory_status == 0){
            $subcategory->subcategory_status = 1;
        }else{
            DB::table('tbl_product')
            ->where('subcategory_id', $subcategory->subcategory_id)
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
    public function update(Request $request, SubCategory $subcategory)
    {
        $request->validate([
            'subcategory_name' => 'required|alpha',
            'category_id' => 'required',
            'subcategory_status' => 'required',
        ]);
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
}

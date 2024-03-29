<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\AdminProductRequest;
use App\Product;
use App\SubCategory;
use Hamcrest\Type\IsNumeric;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    //Admin Page
    public function show_product()
    {
        $get_category = Category::where('category_status', '1')
            ->get();
        $get_subcategory = SubCategory::where('subcategory_status', '1')
            ->get();

        if (isset($_GET['sort_by'])) {
            $sort_by = $_GET['sort_by'];
            if ($sort_by == 'asc') {
                $show_product = DB::table('tbl_product')
                    ->join('tbl_category', 'tbl_category.category_id', '=', 'tbl_product.category_id')
                    ->join('tbl_subcategory', 'tbl_subcategory.subcategory_id', '=', 'tbl_product.subcategory_id')
                    ->orderBy('tbl_product.product_price', 'asc')
                    ->paginate(4)->appends(request()->query());
            } elseif ($sort_by == 'desc') {
                $show_product = DB::table('tbl_product')
                    ->join('tbl_category', 'tbl_category.category_id', '=', 'tbl_product.category_id')
                    ->join('tbl_subcategory', 'tbl_subcategory.subcategory_id', '=', 'tbl_product.subcategory_id')
                    ->orderBy('tbl_product.product_price', 'desc')
                    ->paginate(4)->appends(request()->query());
            } else {
                $show_product = DB::table('tbl_product')
                    ->join('tbl_category', 'tbl_category.category_id', '=', 'tbl_product.category_id')
                    ->join('tbl_subcategory', 'tbl_subcategory.subcategory_id', '=', 'tbl_product.subcategory_id')
                    ->orderBy('tbl_product.product_id', 'desc')
                    ->paginate(4)->appends(request()->query());
            }
        } elseif (isset($_GET['filter_status_with'])) {
            $filter_status_with = $_GET['filter_status_with'];
            if ($filter_status_with == '1') {
                $show_product = DB::table('tbl_product')
                    ->join('tbl_category', 'tbl_category.category_id', '=', 'tbl_product.category_id')
                    ->join('tbl_subcategory', 'tbl_subcategory.subcategory_id', '=', 'tbl_product.subcategory_id')
                    ->where('tbl_product.product_status', '1')
                    ->paginate(4)->appends(request()->query());
            } elseif ($filter_status_with == '0') {
                $show_product = DB::table('tbl_product')
                    ->join('tbl_category', 'tbl_category.category_id', '=', 'tbl_product.category_id')
                    ->join('tbl_subcategory', 'tbl_subcategory.subcategory_id', '=', 'tbl_product.subcategory_id')
                    ->where('tbl_product.product_status', '0')
                    ->paginate(4)->appends(request()->query());
            } else {
                $show_product = DB::table('tbl_product')
                    ->join('tbl_category', 'tbl_category.category_id', '=', 'tbl_product.category_id')
                    ->join('tbl_subcategory', 'tbl_subcategory.subcategory_id', '=', 'tbl_product.subcategory_id')
                    ->orderBy('tbl_product.product_id', 'desc')
                    ->paginate(4)->appends(request()->query());
            }
        } elseif (isset($_GET['filter_category_with'])) {
            $filter_category_with = $_GET['filter_category_with'];
            if (is_numeric($filter_category_with)) {
                $show_product = DB::table('tbl_product')
                    ->join('tbl_category', 'tbl_category.category_id', '=', 'tbl_product.category_id')
                    ->join('tbl_subcategory', 'tbl_subcategory.subcategory_id', '=', 'tbl_product.subcategory_id')
                    ->where('tbl_product.category_id', $filter_category_with)
                    ->paginate(4)->appends(request()->query());
            } else {
                $show_product = DB::table('tbl_product')
                    ->join('tbl_category', 'tbl_category.category_id', '=', 'tbl_product.category_id')
                    ->join('tbl_subcategory', 'tbl_subcategory.subcategory_id', '=', 'tbl_product.subcategory_id')
                    ->orderBy('tbl_product.product_id', 'desc')
                    ->paginate(4)->appends(request()->query());
            }
        } elseif (isset($_GET['filter_subcategory_with'])) {
            $filter_subcategory_with = $_GET['filter_subcategory_with'];
            if (is_numeric($filter_subcategory_with)) {
                $show_product = DB::table('tbl_product')
                    ->join('tbl_category', 'tbl_category.category_id', '=', 'tbl_product.category_id')
                    ->join('tbl_subcategory', 'tbl_subcategory.subcategory_id', '=', 'tbl_product.subcategory_id')
                    ->where('tbl_product.subcategory_id', $filter_subcategory_with)
                    ->paginate(4)->appends(request()->query());
            } else {
                $show_product = DB::table('tbl_product')
                    ->join('tbl_category', 'tbl_category.category_id', '=', 'tbl_product.category_id')
                    ->join('tbl_subcategory', 'tbl_subcategory.subcategory_id', '=', 'tbl_product.subcategory_id')
                    ->orderBy('tbl_product.product_id', 'desc')
                    ->paginate(4)->appends(request()->query());
            }
        } else {
            $show_product = DB::table('tbl_product')
                ->join('tbl_category', 'tbl_category.category_id', '=', 'tbl_product.category_id')
                ->join('tbl_subcategory', 'tbl_subcategory.subcategory_id', '=', 'tbl_product.subcategory_id')
                ->orderBy('tbl_product.product_id', 'desc')
                ->paginate(4)->appends(request()->query());
        }

        $manager_product = view('admin.product.show_product')->with(compact('show_product', 'get_category', 'get_subcategory'));
        return view('components.admin_layout.admin_layout')->with('admin.show_product', $manager_product);
    }

    public function select_category(Request $request)
    {
        $data = $request->all();

        if ($data['action']) {
            $output = '';

            if ($data['action'] == "category") {
                $select_subcategory = Subcategory::where('category_id', $data['cate_id'])
                    ->where('subcategory_status', '1')
                    ->orderby('category_id', 'asc')
                    ->get();
                $output .= '<option value="">Choose your subcategory</option>';
                foreach ($select_subcategory as $key => $sub) {
                    $output .= '<option value="' . $sub->subcategory_id . '" >
                                    ' . $sub->subcategory_name . '
                                </option>';
                }
            }
            echo $output;
        }
    }

    public function add_product()
    {
        $get_category = Category::where('category_status', '1')
            ->get();
        $get_subcategory = SubCategory::where('subcategory_status', '1')
            ->get();

        return view('admin.product.add_product')->with(compact('get_category', 'get_subcategory'));
    }

    public function save_product(AdminProductRequest $request)
    {
        $request->except('_token');
        $data = array();
        $data['product_name'] = $request->product_name;
        $data['product_quantity'] = $request->product_quantity;
        $data['product_price'] = $request->product_price;
        $data['product_desc'] = $request->product_desc;
        $data['product_content'] = $request->product_content;
        $data['category_id'] = $request->category;
        $data['subcategory_id'] = $request->subcategory;
        $data['product_status'] = $request->product_status;
        $get_image = $request->file('product_image');

        if ($data['category_id'] == null  || $data['subcategory_id'] == null) {
            Session::put('error', 'Choose category and subcategory');
            return Redirect::to('/add-product')->withInput();
        } else {
            if ($get_image) {
                $get_name_image = $get_image->getClientOriginalName();
                $name_image = current(explode('.', $get_name_image));
                $new_image = $name_image . rand(0, 99)
                    . '.' . $get_image->getClientOriginalExtension();
                $get_image->move('storage/app/public/products', $new_image);
                $data['product_image'] = $new_image;
                Product::insert($data);
                Session::put('message', 'Add product');
                return Redirect::to('/show-product');
            }
        }
    }
    public function unactive_product($product_id)
    {
        $unactive_result = Product::where('product_id', $product_id)
            ->update(['product_status' => 0]);
        if ($unactive_result != 0) {
            Session::put('message', 'Unactive product ' . $product_id);
            return Redirect::to('/show-product');
        } else {
            abort(404);
        }
    }

    public function active_product($product_id)
    {
        $active_result = Product::where('product_id', $product_id)
            ->update(['product_status' => 1]);
        if ($active_result != 0) {
            Session::put('message', 'Active product ' . $product_id);
            return Redirect::to('/show-product');
        } else {
            abort(404);
        }
    }

    public function edit_product($product_id)
    {
        $get_category = Category::where('category_status', '1')
            ->get();
        $get_subcategory = SubCategory::where('subcategory_status', '1')
            ->get();
        $edit_product = Product::where('product_id', $product_id)
            ->get();

        $manager_product = view('admin.product.edit_product')
            ->with(compact(
                'edit_product',
                'get_category',
                'get_subcategory'
            ));

        return view('components.admin_layout.admin_layout')->with('admin.edit_product', $manager_product);
    }

    public function update_product(Request $request, $product_id)
    {
        $data = array();
        $data['product_name'] = $request->product_name;
        $data['product_quantity'] = $request->product_quantity;
        $data['product_price'] = $request->product_price;
        $data['product_desc'] = $request->product_desc;
        $data['product_content'] = $request->product_content;
        $data['category_id'] = $request->category;
        $data['subcategory_id'] = $request->subcategory;
        $get_image = $request->file('product_image');

        if ($data['category_id'] == null  || $data['subcategory_id'] == null) {
            Session::put('error', 'Choose category and subcategory');
            return Redirect::to('/edit-product' . '/' . $product_id);
        } else {
            if ($get_image) {
                $old_file_path = 'storage/app/public/products/' . $request->old_image;
                unlink($old_file_path);
                $get_name_image = $get_image->getClientOriginalName();
                $name_image = current(explode('.', $get_name_image));
                $new_image = $name_image . rand(0, 99) . '.' .
                    $get_image->getClientOriginalExtension();
                $get_image->move('storage/app/public/products', $new_image);
                $data['product_image'] = $new_image;
                Product::where('product_id', $product_id)
                    ->update($data);

                Session::put('message', 'Update product' . $product_id);
                return Redirect::to('/show-product');
            } else {
                Product::where('product_id', $product_id)
                    ->update($data);

                Session::put('message', 'Update product ' . $product_id . ' without change image');
                return Redirect::to('/show-product');
            }
        }
    }

    public function delete_product($product_id)
    {
        $product = Product::find($product_id);
        $product_image = $product->product_image;
        $old_file_path = 'storage/app/public/products/' . $product_image;
        unlink($old_file_path);
        $delete_result = Product::where('product_id', $product_id)
            ->delete();
        if ($delete_result != 0) {
            Session::put('message', 'Successfully delete product ' . $product_id);
            return Redirect::to('/show-product');
        } else {
            abort(404);
        }
    }

    //End Admin Page

    public function product_details($product_id)
    {
        $product_details = DB::table('tbl_product')
            ->join('tbl_category', 'tbl_category.category_id', '=', 'tbl_product.category_id')
            ->join('tbl_subcategory', 'tbl_subcategory.subcategory_id', '=', 'tbl_product.subcategory_id')
            ->where('tbl_product.product_id', $product_id)
            ->where('product_status', 1)->get();

        $category_id = '';
        foreach ($product_details as $key => $value) {
            $category_id = $value->category_id;
        }

        $related_product = DB::table('tbl_product')
            ->join('tbl_category', 'tbl_category.category_id', '=', 'tbl_product.category_id')
            ->join('tbl_subcategory', 'tbl_subcategory.subcategory_id', '=', 'tbl_product.subcategory_id')
            ->where('tbl_category.category_id', $category_id)
            ->where('product_status', 1)
            ->whereNotIn('tbl_product.product_id', [$product_id])
            ->take(4)
            ->get();

        return view('pages.product.shop_details')
            ->with(compact('product_details', 'related_product'));
    }
}

@extends('components.admin_layout.admin_layout')
@section('admin_content')
@extends('components.alert.alert')

<div class="container">
    <div class="col-lg-11">
        @foreach($edit_product as $key => $edit_value)
        <div class="card">
            <div class="card-header pb-0">
                <div class="row">
                    <div class="col-lg-6 col-7">
                        <h6>
                            Edit product: {{$edit_value->product_name}}
                        </h6>
                    </div>
                    <div class="col-lg-6 col-5 my-auto text-end">
                        <div class="dropdown float-lg-end pe-4">
                            <a class="cursor-pointer" id="dropdownTable" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fa fa-ellipsis-v text-secondary"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body px-0 pb-2">
                <div class="col-md-7 container">
                    <form role="form" method="POST" action="{{URL::to('/update-product/'.$edit_value->product_id)}}" enctype="multipart/form-data">
                        @csrf
                        <div class="input-group input-group-outline my-3">
                            <label class="form-label">
                                Product Name
                            </label>
                            <input value="{{$edit_value->product_name}}" name="product_name" type="text" class="form-control">
                        </div>
                        <div class="input-group input-group-outline my-3">
                            <label class="form-label">
                                Product Quantity
                            </label>
                            <input value="{{$edit_value->product_quantity}}" name="product_quantity" type="text" class="form-control">
                        </div>
                        <div class="input-group input-group-outline my-3">
                            <label class="form-label">
                                Product Price
                            </label>
                            <input value="{{$edit_value->product_price}}" name="product_price" type="text" class="form-control">
                        </div>
                        <div class="input-group input-group-outline mb-3">
                            <div class="col-md-3">
                                <span class="form-label">
                                    Product Image
                                </span>
                            </div>
                            <div class="col-md-9">
                                <input name="product_image" type="file" class="form-control" id="productImage" onchange="preview()">
                            </div>
                            
                            <img id="frame" src="../public/upload/product/{{$edit_value->product_image}}" width="200" alt="No image available" />
                        </div>
                        <div class="input-group input-group-outline mb-3">
                            <label class="form-label" for="ckeditorAdd">
                                Product Description
                            </label>
                            <textarea name="product_desc" placeholder="Enter Product Description" class="form-control" id="ckeditorAdd" rows="8">
                                {{$edit_value->product_desc}} 
                            </textarea>
                        </div>
                        <div class="input-group input-group-outline mb-3">
                            <label class="form-label" for="ckeditorAdd1">
                                Product Content
                            </label>
                            <textarea name="product_content" placeholder="Enter Product Content" class="form-control" id="ckeditorAdd1" rows="8">
                                {{$edit_value->product_content}}
                            </textarea>
                        </div>
                        <div class="input-group input-group-outline mb-3">
                            <select name="category" id="category" class="form-control choose category">
                                <option value="">
                                    Choose your category
                                </option>
                                @foreach($get_category as $key => $get_category)
                                    <option value="{{$get_category->category_id}}" 
                                        {{$get_category->category_id == $edit_value->category_id?'selected':''}}>
                                            {{$get_category->category_name}}
                                @endforeach
                            </select>
                        </div>
                        <div class="input-group input-group-outline mb-3">
                            <select name="subcategory" id="subcategory" class="form-control subcategory choose">
                                @foreach($get_subcategory as $key => $get_subcategory)
                                    <option value="{{$get_subcategory->subcategory_id}}" 
                                        {{$get_subcategory->subcategory_id == $edit_value->subcategory_id?'selected':''}}>
                                            {{$get_subcategory->subcategory_name}}
                                @endforeach
                            </select>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn bg-gradient-primary w-100 my-4 mb-2">
                                Save product
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

@endsection
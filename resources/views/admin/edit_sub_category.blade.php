@extends('components.admin_layout')
@section('admin_content')
@extends('components.alert')

<div class="container">
    <div class="col-lg-11">
    @foreach($edit_sub_category as $key => $edit_value)
        <div class="card">
            <div class="card-header pb-0">
                <div class="row">
                    <div class="col-lg-6 col-7">
                        <h6>Edit subcategory: {{$edit_value->subcategory_name}}</h6>
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
                    <form role="form" method="POST" action="{{URL::to('/update-sub-category/'.$edit_value->subcategory_id)}}">
                        @csrf
                        <div class="input-group input-group-outline my-3">
                            <label class="form-label">SubCategory Name</label>
                            <input value="{{$edit_value->subcategory_name}}" name="subcategory_name" type="text" class="form-control">
                        </div>
                        <div class="input-group input-group-outline mb-3">
                            <label class="form-label" for="ckeditorAdd">Category Description</label>
                            <textarea name="subcategory_desc" placeholder="Enter SubCategory Description" class="form-control" id="ckeditorAdd" rows="8"> {{$edit_value->subcategory_desc}} </textarea>
                        </div>
                        <div class="input-group input-group-outline mb-3">
                            <!-- <label for="category_id" class="form-label">Choose your category from the list:</label> -->
                            <input class="form-control" list="category" name="category_id" id="category_id" value="{{$edit_value->category_id}}">
                            <datalist id="category">
                                @foreach($get_category as $key => $get_category)
                                <option {{($edit_value->category_id == $get_category->category_id) ? 'selected' : ''}}  value="{{$get_category->category_id}}">{{$get_category->category_name}}
                                @endforeach
                            </datalist>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn bg-gradient-primary w-100 my-4 mb-2">Save subcategory</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

@endsection
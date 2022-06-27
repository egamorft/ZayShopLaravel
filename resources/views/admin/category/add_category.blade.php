@extends('components.admin_layout.admin_layout')
@section('admin_content')
@extends('components.alert.alert')

<div class="container">
    <div class="col-lg-11">
        <div class="card">
            <div class="card-header pb-0">
                <div class="row">
                    <div class="col-lg-6 col-7">
                        <h6>
                            Add category
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
                    <form role="form" method="POST" action="{{URL::to('/save-category')}}">
                        @csrf
                        <div class="input-group input-group-outline my-3">
                            <label class="form-label">
                                Category Name
                            </label>
                            <input name="category_name" type="text" class="form-control" value="{{ old('category_name') }}">
                        </div>
                        <div class="input-group input-group-outline mb-3">
                            <label class="form-label" for="ckeditorAdd">
                                Category Description
                            </label>
                            <textarea name="category_desc" placeholder="Enter Category Description" 
                                class="form-control" id="ckeditorAdd" rows="8">
                                {{ old('category_desc') }}
                            </textarea>
                        </div>
                        <div class="form-check mb-3 ">
                            <label for="show">
                                Show
                            </label>
                            <input class="form-check-input" type="radio" name="category_status" id="show" value="1" checked>
                            <label class="form-check-label" for="hide">
                                Hide
                            </label>
                            <input class="form-check-input" type="radio" name="category_status" id="hide" value="0">
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn bg-gradient-primary w-100 my-4 mb-2">
                                Add category
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
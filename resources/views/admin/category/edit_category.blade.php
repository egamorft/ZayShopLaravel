@extends('components.admin_layout.admin_layout')
@section('admin_content')
@extends('components.alert.alert')

<div class="container">
    <div class="col-lg-11">
    @if(!$edit_category->isEmpty())
    @foreach($edit_category as $key => $edit_value)
        <div class="card">
            <div class="card-header pb-0">
                <div class="row">
                    <div class="col-lg-6 col-7">
                        <h6>
                            Edit category: {{$edit_value->category_name}}
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
                    <form role="form" method="POST" action="{{URL::to('/update-category/'.$edit_value->category_id)}}">
                        @csrf
                        <div class="input-group input-group-outline my-3">
                            <label class="form-label">
                                Category Name
                            </label>
                            <input value="{{$edit_value->category_name}}" name="category_name" type="text" class="form-control">
                        </div>
                        <div class="input-group input-group-outline mb-3">
                            <label class="form-label" for="ckeditorAdd">
                                Category Description
                            </label>
                            <textarea name="category_desc" placeholder="Enter Category Description" class="form-control" id="ckeditorAdd" rows="8">
                                {{$edit_value->category_desc}} 
                            </textarea>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn bg-gradient-primary w-100 my-4 mb-2">
                                Save category
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
        @else
        <center>
            <h3>
                Nothing here
            </h3>
        </center>
        @endif
    </div>
</div>

@endsection
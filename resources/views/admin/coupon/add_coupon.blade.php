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
                            Add coupon
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
                    <form role="form" method="POST" action="{{URL::to('/save-coupon')}}">
                        @csrf
                        <div class="input-group input-group-outline my-3">
                            <label class="form-label">
                                Coupon Name
                            </label>
                            <input name="coupon_name" type="text" class="form-control" value="{{ old('coupon_name') }}">
                        </div>
                        @error('coupon_name')
                            <span style="color: red">
                                {{$message}}
                            </span>
                        @enderror
                        <div class="input-group input-group-outline my-3">
                            <label class="form-label">
                                Coupon Code
                            </label>
                            <input name="coupon_code" type="text" class="form-control" value="{{ old('coupon_code') }}">
                        </div>
                        @error('coupon_code')
                            <span style="color: red">
                                {{$message}}
                            </span>
                        @enderror
                        <div class="input-group input-group-outline my-3">
                            <label class="form-label">
                                Coupon Time
                            </label>
                            <input name="coupon_time" type="text" class="form-control" value="{{ old('coupon_time') }}">
                        </div>
                        @error('coupon_time')
                            <span style="color: red">
                                {{$message}}
                            </span>
                        @enderror
                        <div class="input-group input-group-outline mb-3">
                            <select name="coupon_condition" class="form-control choose category">
                                <option value="">
                                    Choose coupon condition
                                </option>
                                <option value="1" selected>
                                    Discount by percentage
                                </option>
                                <option value="2">
                                    Discount by money
                                </option>
                            </select>
                        </div>
                        <div class="input-group input-group-outline my-3">
                            <label class="form-label">
                                Enter % or number of sale
                            </label>
                            <input name="coupon_number" type="text" class="form-control" value="{{ old('coupon_number') }}">
                        </div>
                        @error('coupon_number')
                            <span style="color: red">
                                {{$message}}
                            </span>
                        @enderror
                        <div class="text-center">
                            <button type="submit" class="btn bg-gradient-primary w-100 my-4 mb-2">
                                Add coupon
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
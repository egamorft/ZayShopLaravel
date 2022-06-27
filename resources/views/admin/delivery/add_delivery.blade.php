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
                            Delivery
                        </h6>
                    </div>
                    <div class="col-lg-6 col-5 my-auto text-end">
                        <div class="dropdown float-lg-end pe-4">
                            <a class="cursor-pointer" id="dropdownTable" ata-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fa fa-ellipsis-v text-secondary"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <form>
                @csrf
                <div class="card-body px-0 pb-2">
                    <div class="col-md-7 container">
                        <div class="input-group input-group-outline mb-3">
                            <select name="city" id="city" class="form-control choose city">
                                <option value="">
                                    -----Choose your city-----
                                </option>
                                @foreach($city as $key => $ci)
                                    <option value="{{$ci->matp}}">
                                        {{$ci->name_city}}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="input-group input-group-outline mb-3">
                            <select name="province" id="province" class="form-control province choose">
                                <option value="">
                                    -----Choose your province-----
                                </option>
                            </select>
                        </div>
                        <div class="input-group input-group-outline mb-3">
                            <select name="wards" id="wards" class="form-control wards">
                                <option value="">
                                    -----Choose your wards-----
                                </option>
                            </select>
                        </div>
                        <div class="input-group input-group-outline my-3">
                            <label class="form-label">
                                Delivery fee
                            </label>
                            <input type="text" name="fee_ship" id="wards" id="freeShip" class="form-control fee_ship">
                        </div>
                        @error('fee_ship')
                            <span style="color: red">
                                {{$message}}
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="text-center">
                    <button type="button" name="add_delivery" class="btn btn-info add_delivery">
                        Add delivery
                    </button>
                </div>
            </form>
            <hr class="my-4">
            <div id="load_delivery">

            </div>
        </div>
    </div>
</div>

@endsection
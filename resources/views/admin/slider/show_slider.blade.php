@extends('components.admin_layout.admin_layout')
@section('admin_content')
@extends('components.alert.alert')

<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                        <h6 class="text-white text-capitalize ps-3">
                            Slider table
                        </h6>
                    </div>
                </div>
                <div class="col-11 text-end">
                    <a href="{{URL::to('/add-slider')}}" class="btn bg-gradient-dark mb-0">
                        <i class="material-icons text-sm">
                            add
                        </i>&nbsp;&nbsp;
                        Add Slider
                    </a>
                </div>
                <div class="card-body px-0 pb-2">
                    <div class="table-responsive p-0">
                        <div class="container mt-3">
                            <div class="d-flex justify-content-between">
                                <div class="input-group input-group-outline m-3">
                                    <label class="form-label">
                                        Search your slider name
                                    </label>
                                    <input type="text" id="myOrder" onkeyup="myFilterOrder()" class="form-control">
                                </div>
                                <form class="input-group input-group-outline m-3">
                                    @csrf
                                    <select name="order_sort" id="order_sort" class="form-control">
                                        <option value="{{Request::url()}}?sort_by=none">Sort ORDER DATE by</option>
                                        <option value="{{Request::url()}}?sort_by=asc" {{Request::fullurl() == Request::url().'?sort_by=asc' ? "selected" : ""}}>Ascending</option>
                                        <option value="{{Request::url()}}?sort_by=desc" {{Request::fullurl() == Request::url().'?sort_by=desc' ? "selected" : ""}}>Descending</option>
                                    </select>
                                </form>
                                <form class="input-group input-group-outline m-3">
                                    @csrf
                                    <select name="order_filter" id="order_filter" class="form-control">
                                        <option value="{{Request::url()}}?filter_with=none">Filter ORDER STATUS by</option>
                                        <option value="{{Request::url()}}?filter_with=1" {{Request::fullurl() == Request::url().'?filter_with=1' ? "selected" : ""}}>Not handle</option>
                                        <option value="{{Request::url()}}?filter_with=2" {{Request::fullurl() == Request::url().'?filter_with=2' ? "selected" : ""}}>Delivering</option>
                                        <option value="{{Request::url()}}?filter_with=3" {{Request::fullurl() == Request::url().'?filter_with=3' ? "selected" : ""}}>Cancel/ Pending</option>
                                        <option value="{{Request::url()}}?filter_with=4" {{Request::fullurl() == Request::url().'?filter_with=4' ? "selected" : ""}}>Complete</option>
                                    </select>
                                </form>
                            </div>
                        </div>
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary font-weight-bolder opacity-7">
                                        ID
                                    </th>
                                    <th class="text-uppercase text-secondary font-weight-bolder opacity-7 ps-2">
                                        Slider Name
                                    </th>
                                    <th class="text-uppercase text-secondary font-weight-bolder opacity-7 ps-2">
                                        Slider Image
                                    </th>
                                    <th class="text-center text-uppercase text-secondary font-weight-bolder opacity-7">
                                        Show/Hide
                                    </th>
                                    <th class="text-secondary opacity-7">
                                    </th>
                                    <th class="text-secondary opacity-7">
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($slider as $key => $sli)
                                <tr>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <div class="justify-content-center">
                                                {{$sli->slider_id}}
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="font-weight-bold mb-0">
                                            {{$sli->slider_name}}
                                        </p>
                                    </td>
                                    <td>
                                        <p class="font-weight-bold mb-0">
                                            <img src="public/upload/slider/{{$sli->slider_image}}" width="45%" alt="No image available">
                                        </p>
                                    </td>

                                    <td class="align-middle text-center">
                                        <?php
                                        if ($sli->slider_status == 1) {
                                        ?>
                                            <a href="{{URL::to('/unactive-slider/'.$sli->slider_id)}}">
                                                <i class="material-icons" style="font-size: 40px; color:green;">
                                                    thumb_up
                                                </i>
                                            </a>
                                        <?php
                                        } else {
                                        ?>
                                            <a href="{{URL::to('/active-slider/'.$sli->slider_id)}}">
                                                <i class="material-icons" style="font-size: 40px; color:red;">
                                                    thumb_down
                                                </i>
                                            </a>
                                        <?php
                                        }
                                        ?>
                                    </td>
                                    <td class="align-middle">
                                        <a href="{{URL::to('/edit-slider/'.$sli->slider_id)}}" class="font-weight-bold" data-toggle="tooltip">
                                            <i class="material-icons" style="font-size: 30px;">
                                                edit
                                            </i>
                                        </a>
                                    </td>
                                    <td class="align-middle">
                                        <a onclick="return confirm('Are you sure to delete?')" href="{{URL::to('/delete-slider/'.$sli->slider_id)}}" class="font-weight-bold" data-toggle="tooltip">
                                            <i class="material-icons" style="font-size: 30px;">
                                                delete
                                            </i>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            {!! $slider->render('components.admin_paginate.admin_pagination')!!}
        </div>
    </div>

    @endsection
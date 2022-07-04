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
                            Order table
                        </h6>
                    </div>
                </div>
                <div class="card-body px-0 pb-2">
                    <div class="table-responsive p-0">
                        <div class="container mt-3">
                            <div class="d-flex justify-content-between">
                                <div class="input-group input-group-outline m-3">
                                    <label class="form-label">
                                        Search your order code
                                    </label>
                                    <input type="text" id="myFilter" onkeyup="myFilter()" class="form-control">
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
                        <table class="table align-items-center mb-0" id="filterTable">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary font-weight-bolder opacity-7">
                                        Order Id
                                    </th>
                                    <th class="text-uppercase text-secondary font-weight-bolder opacity-7 ps-2">
                                        Order Code
                                    </th>
                                    <th class="text-uppercase text-secondary font-weight-bolder opacity-7 ps-2">
                                        Order Date
                                    </th>
                                    <th class="text-uppercase text-secondary font-weight-bolder opacity-7 ps-2">
                                        Order Status
                                    </th>
                                    <th class="text-secondary opacity-7">
                                    </th>
                                    <th class="text-secondary opacity-7">
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($order as $key => $od)
                                <tr>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <div class="justify-content-center">
                                                {{$od->order_id}}
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="font-weight-bold mb-0">
                                            {{$od->order_code}}
                                        </p>
                                    </td>
                                    <td>
                                        <p class="font-weight-bold mb-0">
                                            {{$od->created_at}}
                                        </p>
                                    </td>
                                    <td>
                                        @if($od->order_status == 1)

                                        <p class="font-weight-bold mb-0">
                                            Not handle
                                        </p>

                                        @elseif($od->order_status == 2)

                                        Delivering

                                        @elseif($od->order_status == 3)

                                        Cancel/ Pending

                                        @elseif($od->order_status == 4)

                                        <p style="color:green;" class="font-weight-bold mb-0">
                                            Completed
                                        </p>
                                        @endif
                                    </td>
                                    <td class="align-middle">
                                        <a href="{{URL::to('/view-order/'.$od->order_code)}}" class="font-weight-bold" data-toggle="tooltip">
                                            <i class="material-icons" style="font-size: 30px;">
                                                visibility
                                            </i>
                                        </a>
                                    </td>
                                    <td class="align-middle">
                                        <a onclick="return confirm('Are you sure to delete?')" href="{{URL::to('/delete-order/'.$od->order_code)}}" class="font-weight-bold" data-toggle="tooltip">
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
            {!! $order->render('components.admin_paginate.admin_pagination')!!}
        </div>
    </div>

    @endsection
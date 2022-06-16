@extends('admin_layout')
@section('admin_content')

<!-- Alert -->
@if(session()->has('message'))
<div class="container">
    <div class="row">
        <div class="col-9"></div>
        <div class="col-sm-3">
            <div id="alertMessage" class="alert alert-success">
                <strong>Success! </strong>
                {{session()->get('message')}}
            </div>
        </div>
    </div>
</div>
</div>
<?php
Session::put('message', null);
?>
@elseif(session()->has('error'))
<div class="container">
    <div class="row">
        <div class="col-9"></div>
        <div class="col-sm-3">
            <div id="alertMessage" class="alert alert-danger">
                <strong>Error! </strong>
                {{session()->get('error')}}
            </div>
        </div>
    </div>
</div>
</div>
<?php
Session::put('error', null);
?>
@endif
<!-- End Alert -->

<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                        <h6 class="text-white text-capitalize ps-3">Order table</h6>
                    </div>
                </div>
                <div class="card-body px-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary font-weight-bolder opacity-7">Index</th>
                                    <th class="text-uppercase text-secondary font-weight-bolder opacity-7 ps-2">Order Code</th>
                                    <th class="text-uppercase text-secondary font-weight-bolder opacity-7 ps-2">Order Date</th>
                                    <th class="text-uppercase text-secondary font-weight-bolder opacity-7 ps-2">Order Status</th>
                                    <th class="text-secondary opacity-7"></th>
                                    <th class="text-secondary opacity-7"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $i = 0;
                                @endphp
                                @foreach($order as $key => $od)
                                @php
                                $i++;
                                @endphp
                                <tr>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <div class="justify-content-center">
                                                {{$i}}
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
                                            New order
                                        </p>
                                        @else
                                        Handled
                                        @endif
                                    </td>
                                    <td class="align-middle">
                                        <a href="{{URL::to('/view-order/'.$od->order_code)}}" class="font-weight-bold" data-toggle="tooltip">
                                            <i class="material-icons" style="font-size: 30px;">visibility</i>
                                        </a>
                                    </td>
                                    <td class="align-middle">
                                        <a onclick="return confirm('Are you sure to delete?')" href="{{URL::to('/delete-order/'.$od->order_code)}}" class="font-weight-bold" data-toggle="tooltip">
                                            <i class="material-icons" style="font-size: 30px;">delete</i>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @endsection
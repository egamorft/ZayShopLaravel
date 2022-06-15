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
                        <h6 class="text-white text-capitalize ps-3">Coupon table</h6>
                    </div>
                </div>
                <div class="col-11 text-end">
                    <a href="{{URL::to('/add-coupon')}}" class="btn bg-gradient-dark mb-0"><i class="material-icons text-sm">add</i>&nbsp;&nbsp;Add Coupon</a>
                </div>
                <div class="card-body px-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary font-weight-bolder opacity-7">ID</th>
                                    <th class="text-uppercase text-secondary font-weight-bolder opacity-7 ps-2">Coupon Name</th>
                                    <th class="text-uppercase text-secondary font-weight-bolder opacity-7 ps-2">Coupon Code</th>
                                    <th class="text-uppercase text-secondary font-weight-bolder opacity-7">Coupon Time</th>
                                    <th class="text-uppercase text-secondary font-weight-bolder opacity-7 ps-2">Coupon Condition</th>
                                    <th class="text-uppercase text-secondary font-weight-bolder opacity-7 ps-2">Coupon Number</th>
                                    <th class="text-secondary opacity-7"></th>
                                    <th class="text-secondary opacity-7"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($show_coupon as $key => $cou)
                                <tr>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <div class="justify-content-center">
                                                {{$cou->coupon_id}}
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="font-weight-bold mb-0">
                                            {{$cou->coupon_name}}
                                        </p>
                                    </td>
                                    <td>
                                        <p class="font-weight-bold mb-0">
                                            {{$cou->coupon_code}}
                                        </p>
                                    </td>
                                    <td>
                                        <p class="font-weight-bold mb-0">
                                            {{$cou->coupon_time}}
                                        </p>
                                    </td>
                                    <td>
                                        <?php
                                        if ($cou->coupon_condition == 1) {
                                        ?>
                                            <p class="font-weight-bold mb-0"> Sale by %
                                            </p>
                                        <?php
                                        } else {
                                        ?>
                                            <p class="font-weight-bold mb-0"> Sale by VND
                                            </p>
                                        <?php
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        if ($cou->coupon_condition == 1) {
                                        ?>

                                            <p class="font-weight-bold mb-0">
                                                Sale {{$cou->coupon_number}}%
                                            </p>
                                        <?php
                                        } else {
                                        ?>
                                            <p class="font-weight-bold mb-0">
                                                Sale {{number_format($cou->coupon_number, ',' , '.')}} VND
                                            </p>
                                        <?php
                                        }
                                        ?>
                                    </td>
                                    <td class="align-middle">
                                        <a onclick="return confirm('Are you sure to delete this coupon?')" href="{{URL::to('/delete-coupon/'.$cou->coupon_id)}}" class="font-weight-bold" data-toggle="tooltip">
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
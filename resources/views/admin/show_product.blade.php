@extends('components.admin_layout')
@section('admin_content')
@extends('components.alert')

<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                        <h6 class="text-white text-capitalize ps-3">Product table</h6>
                    </div>
                </div>
                <div class="col-11 text-end">
                    <a href="{{URL::to('/add-product')}}" class="btn bg-gradient-dark mb-0"><i class="material-icons text-sm">add</i>&nbsp;&nbsp;Add Product</a>
                </div>
                <div class="card-body px-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary font-weight-bolder opacity-7">ID</th>
                                    <th class="text-uppercase text-secondary font-weight-bolder opacity-7 ps-2">Product Name</th>
                                    <th class="text-uppercase text-secondary font-weight-bolder opacity-7">Product Quantity</th>
                                    <th class="text-uppercase text-secondary font-weight-bolder opacity-7">Product Price</th>
                                    <th class="text-uppercase text-secondary font-weight-bolder opacity-7 ps-2">Product Image</th>
                                    <th class="text-uppercase text-secondary font-weight-bolder opacity-7 ps-2">Category</th>
                                    <th class="text-uppercase text-secondary font-weight-bolder opacity-7 ps-2">Subcategory</th>
                                    <th class="text-center text-uppercase text-secondary font-weight-bolder opacity-7">Show/Hide</th>
                                    <th class="text-secondary opacity-7"></th>
                                    <th class="text-secondary opacity-7"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($show_product as $key => $pro)
                                <tr>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <div class="justify-content-center">
                                                {{$pro->product_id}}
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="font-weight-bold mb-0">
                                            {{$pro->product_name}}
                                        </p>
                                    </td>
                                    <td>
                                        <p class="font-weight-bold mb-0">
                                            {{$pro->product_quantity}}
                                        </p>
                                    </td>
                                    <td>
                                        <p class="font-weight-bold mb-0">
                                            {{$pro->product_price}}
                                        </p>
                                    </td>
                                    <td>
                                        <p class="font-weight-bold mb-0">
                                            <img src="public/upload/product/{{$pro->product_image}}" height="130" width="130" alt="No image available">
                                        </p>
                                    </td>
                                    <td>
                                        <p class="font-weight-bold mb-0">
                                            {{$pro->category_name}}
                                        </p>
                                    </td>
                                    <td>
                                        <p class="font-weight-bold mb-0">
                                            {{$pro->subcategory_name}}
                                        </p>
                                    </td>

                                    <td class="align-middle text-center">
                                        <?php
                                        if ($pro->product_status == 1) {
                                        ?>
                                            <a href="{{URL::to('/unactive-product/'.$pro->product_id)}}"><i class="material-icons" style="font-size: 40px; color:green;">thumb_up</i></a>
                                        <?php
                                        } else {
                                        ?>
                                            <a href="{{URL::to('/active-product/'.$pro->product_id)}}"><i class="material-icons" style="font-size: 40px; color:red;">thumb_down</i></a>
                                        <?php
                                        }
                                        ?>
                                    </td>
                                    <td class="align-middle">
                                        <a href="{{URL::to('/edit-product/'.$pro->product_id)}}" class="font-weight-bold" data-toggle="tooltip">
                                            <i class="material-icons" style="font-size: 30px;">edit</i>
                                        </a>
                                    </td>
                                    <td class="align-middle">
                                        <a onclick="return confirm('Are you sure to delete?')" href="{{URL::to('/delete-product/'.$pro->product_id)}}" class="font-weight-bold" data-toggle="tooltip">
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
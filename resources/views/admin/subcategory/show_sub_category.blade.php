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
                            SubCategory table
                        </h6>
                    </div>
                </div>
                <div class="col-11 text-end">
                    <a href="{{URL::to('/add-sub-category')}}" class="btn bg-gradient-dark mb-0">
                        <i class="material-icons text-sm">
                            add
                        </i>&nbsp;&nbsp;
                        Add SubCategory
                    </a>
                </div>
                <div class="card-body px-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary font-weight-bolder opacity-7">
                                        ID
                                    </th>
                                    <th class="text-uppercase text-secondary font-weight-bolder opacity-7 ps-2">
                                        SubCategory Name
                                    </th>
                                    <th class="text-uppercase text-secondary font-weight-bolder opacity-7 ps-2">
                                        Category Name
                                    </th>
                                    <th class="text-center text-uppercase text-secondary font-weight-bolder opacity-7">
                                        Show/Hide
                                    </th>
                                    <th class="text-secondary opacity-7"></th>
                                    <th class="text-secondary opacity-7"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($show_sub_category as $key => $sub)
                                <tr>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <div class="justify-content-center">
                                                {{$sub->subcategory_id}}
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="font-weight-bold mb-0">
                                            {{$sub->subcategory_name}}
                                        </p>
                                    </td>
                                    <td>
                                        <p class="font-weight-bold mb-0">
                                            {{$sub->category_name}}
                                        </p>
                                    </td>

                                    <td class="align-middle text-center">
                                        <?php
                                        if ($sub->subcategory_status == 1) {
                                        ?>
                                            <a onclick="return confirm('This action also unactive their product status. Continue?')" 
                                                href="{{URL::to('/unactive-sub-category/'.$sub->subcategory_id)}}">
                                                <i class="material-icons" style="font-size: 40px; color:green;">
                                                    thumb_up
                                                </i>
                                            </a>
                                        <?php
                                        } else {
                                        ?>
                                            <a href="{{URL::to('/active-sub-category/'.$sub->subcategory_id)}}">
                                                <i class="material-icons" style="font-size: 40px; color:red;">
                                                    thumb_down
                                                </i>
                                            </a>
                                        <?php
                                        }
                                        ?>
                                    </td>
                                    <td class="align-middle">
                                        <a href="{{URL::to('/edit-sub-category/'.$sub->subcategory_id)}}" class="font-weight-bold" data-toggle="tooltip">
                                            <i class="material-icons" style="font-size: 30px;">
                                                edit
                                            </i>
                                        </a>
                                    </td>
                                    <td class="align-middle">
                                        <a onclick="return confirm('Are you sure to delete?')" 
                                            href="{{URL::to('/delete-sub-category/'.$sub->subcategory_id)}}" class="font-weight-bold" data-toggle="tooltip">
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
            {!! $show_sub_category->render('components.admin_paginate.admin_pagination')!!}
        </div>
    </div>

    @endsection
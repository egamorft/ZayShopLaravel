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
                            Category table
                        </h6>
                    </div>
                </div>
                <div class="col-11 text-end">
                    <a href="{{URL::to('/add-category')}}" class="btn bg-gradient-dark mb-0">
                        <i class="material-icons text-sm">
                            add
                        </i>&nbsp;&nbsp;
                        Add Category
                    </a>
                </div>
                <div class="card-body px-0 pb-2">
                    <div class="table-responsive p-0">
                        <div class="container mt-3">
                            <div class="d-flex justify-content-between">
                                <div class="input-group input-group-outline m-3">
                                    <label class="form-label">
                                            Search your category name
                                    </label>
                                    <input type="text" id="myFilter" onkeyup="myFilter()" class="form-control">
                                </div>
                                <form class="input-group input-group-outline m-3">
                                    @csrf
                                    <select name="category_filter" id="category_filter" class="form-control">
                                        <option value="{{Request::url()}}?filter_with=none">Filter CATEGORY STATUS by</option>
                                        <option value="{{Request::url()}}?filter_with=1" {{Request::fullurl() == Request::url().'?filter_with=1' ? "selected" : ""}}>Show</option>
                                        <option value="{{Request::url()}}?filter_with=0" {{Request::fullurl() == Request::url().'?filter_with=0' ? "selected" : ""}}>Hide</option>
                                    </select>
                                </form>
                            </div>
                        </div>
                            <table class="table align-items-center mb-0" id="filterTable">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary font-weight-bolder opacity-7">
                                            ID
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
                                    @if(!$show_category->isEmpty())
                                    @foreach($show_category as $key => $cate)
                                    <tr>
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div class="justify-content-center">
                                                    {{$cate->category_id}}
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <p class="font-weight-bold mb-0">
                                                {{$cate->category_name}}
                                            </p>
                                        </td>

                                        <td class="align-middle text-center">
                                            <?php
                                            if ($cate->category_status == 1) {
                                            ?>
                                                <a onclick="return confirm('This action also unactive their subcategory and product status. Continue?')" 
                                                    href="{{URL::to('/unactive-category/'.$cate->category_id)}}">
                                                        <i class="material-icons" style="font-size: 40px; color:green;">
                                                            thumb_up
                                                        </i>
                                                </a>
                                            <?php
                                            } else {
                                            ?>
                                                <a href="{{URL::to('/active-category/'.$cate->category_id)}}">
                                                    <i class="material-icons" style="font-size: 40px; color:red;">
                                                        thumb_down
                                                    </i>
                                                </a>
                                            <?php
                                            }
                                            ?>
                                        </td>
                                        <td class="align-middle">
                                            <a href="{{URL::to('/edit-category/'.$cate->category_id)}}" class="font-weight-bold" data-toggle="tooltip">
                                                <i class="material-icons" style="font-size: 30px;">
                                                    edit
                                                </i>
                                            </a>
                                        </td>
                                        <td class="align-middle">
                                            <a onclick="return confirm('Are you sure to delete?')" 
                                                href="{{URL::to('/delete-category/'.$cate->category_id)}}" class="font-weight-bold" data-toggle="tooltip">
                                                <i class="material-icons" style="font-size: 30px;">
                                                    delete
                                                </i>
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                    @else
                                    <td colspan="5">
                                        <center>
                                            <h3>
                                                Nothing here
                                            </h3>
                                        </center>
                                    </td>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                </div>
            </div>
            {!! $show_category->render('components.admin_paginate.admin_pagination')!!}
        </div>
    </div>

    @endsection
@extends('components.admin_layout.admin_layout')
@section('admin_content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-header p-3 pt-2">
                    <div class="icon icon-lg icon-shape bg-gradient-success shadow-success text-center border-radius-xl mt-n4 position-absolute">
                        <i class="material-icons opacity-10">transcribe</i>
                    </div>
                    <div class="text-end pt-1">
                        <p class="text-sm mb-0 text-capitalize">{{ __('admin/dashboard.Current Online')}}</p>
                        <h4 class="mb-0">{{$visitors_now_count}}</h4>
                    </div>
                </div>
                <hr class="dark horizontal my-0">
                <div class="card-footer p-3">
                    @php
                        if($visitors_yesterday_count != 0){
                            $increase = $visitors_now_count - $visitors_yesterday_count;
                            $percentage_increase = $increase / $visitors_yesterday_count * 100;
                        }else{
                            $increase=0;
                            $percentage_increase = $visitors_now_count;
                        }
                    @endphp

                    @if($increase < 0) 
                        <p class="mb-0"><span class="text-danger text-sm font-weight-bolder">{{number_format($percentage_increase, 1)}}%</span> {{ __('admin/dashboard.than yesterday')}}</p>
                    @elseif($increase > 0)
                        <p class="mb-0"><span class="text-success text-sm font-weight-bolder">+{{number_format($percentage_increase, 1)}}%</span> {{ __('admin/dashboard.than yesterday')}}</p>
                    @else
                        <p class="mb-0"><span class="text-success text-sm font-weight-bolder">+{{$percentage_increase}}</span> {{ __('admin/dashboard.than yesterday')}}</p>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-header p-3 pt-2">
                    <div class="icon icon-lg icon-shape bg-gradient-primary shadow-primary text-center border-radius-xl mt-n4 position-absolute">
                        <i class="material-icons opacity-10">co_present</i>
                    </div>
                    <div class="text-end pt-1">
                        <p class="text-sm mb-0 text-capitalize">{{ __('admin/dashboard.This month visitors')}}</p>
                        <h4 class="mb-0">{{$visitors_of_this_month_count}}</h4>
                    </div>
                </div>
                <hr class="dark horizontal my-0">
                <div class="card-footer p-3">
                    @php
                        if($visitors_of_last_month_count != 0){
                            $increase = $visitors_of_this_month_count - $visitors_of_last_month_count;
                            $percentage_increase = $increase / $visitors_of_last_month_count * 100;
                        }else{
                            $increase=0;
                            $percentage_increase = $visitors_of_this_month_count;
                        }
                    @endphp

                    @if($increase < 0) 
                        <p class="mb-0"><span class="text-danger text-sm font-weight-bolder">{{number_format($percentage_increase, 1)}}%</span> {{ __('admin/dashboard.than last month')}}</p>
                    @elseif($increase > 0)
                        <p class="mb-0"><span class="text-success text-sm font-weight-bolder">+{{number_format($percentage_increase, 1)}}%</span> {{ __('admin/dashboard.than last month')}}</p>
                    @else
                        <p class="mb-0"><span class="text-success text-sm font-weight-bolder">+{{$percentage_increase}}</span> {{ __('admin/dashboard.than last month')}}</p>
                    @endif

                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-header p-3 pt-2">
                    <div class="icon icon-lg icon-shape bg-gradient-dark shadow-dark text-center border-radius-xl mt-n4 position-absolute">
                        <i class="material-icons opacity-10">person</i>
                    </div>
                    <div class="text-end pt-1">
                        <p class="text-sm mb-0 text-capitalize">{{ __('admin/dashboard.This Year Visitors')}}</p>
                        <h4 class="mb-0">{{$visitors_of_this_year_count}}</h4>
                    </div>
                </div>
                <hr class="dark horizontal my-0">
                <div class="card-footer p-3">
                    @php
                        if($visitors_of_last_year_count != 0){
                            $increase = $visitors_of_this_year_count - $visitors_of_last_year_count;
                            $percentage_increase = $increase / $visitors_of_last_year_count * 100;
                        }else{
                            $increase=0;
                            $percentage_increase = $visitors_of_this_year_count;
                        }
                    @endphp

                    @if($increase < 0) 
                        <p class="mb-0"><span class="text-danger text-sm font-weight-bolder">{{number_format($percentage_increase, 1)}}%</span> {{ __('admin/dashboard.than last year')}}</p>
                    @elseif($increase > 0)
                        <p class="mb-0"><span class="text-success text-sm font-weight-bolder">+{{number_format($percentage_increase, 1)}}%</span> {{ __('admin/dashboard.than last year')}}</p>
                    @else
                        <p class="mb-0"><span class="text-success text-sm font-weight-bolder">+{{$percentage_increase}}</span> {{ __('admin/dashboard.than last year')}}</p>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6">
            <div class="card">
                <div class="card-header p-3 pt-2">
                    <div class="icon icon-lg icon-shape bg-gradient-info shadow-info text-center border-radius-xl mt-n4 position-absolute">
                        <i class="material-icons opacity-10">settings_accessibility</i>
                    </div>
                    <div class="text-end pt-1">
                        <p class="text-sm mb-0 text-capitalize">{{ __('admin/dashboard.Total Pages Visitors')}}</p>
                        <h4 class="mb-0">{{$visitors_total_count}}</h4>
                    </div>
                </div>
                <hr class="dark horizontal my-0">
                <div class="card-footer p-3">
                </div>
                <div class="card-footer p-3">
                </div>

            </div>
        </div>
    </div>
    <div class="row mt-4 justify-content-md-center">
        <div class="col-md-6 mt-4 mb-4">
            <div class="card z-index-4 ">
                <h6 class="text-capitalize ps-3 my-3">{{ __('admin/dashboard.Sales statistic')}}</h6>
                <form action="" autocomplete="off">
                    @csrf
                    <div class="d-flex col-md-12">
                        <div class="input-group input-group-outline my-3 mx-3">
                            <label class="form-label">
                                {{ __('admin/dashboard.From date:')}}
                            </label>
                            <input id="datepicker1" type="text" class="form-control">
                        </div>
                        <div class="input-group input-group-outline my-3 mx-3">
                            <label class="form-label">
                                {{ __('admin/dashboard.End date:')}}
                            </label>
                            <input id="datepicker2" type="text" class="form-control">
                        </div>
                    </div>
                    <div class="d-flex justify-content-center m-3">
                        <input id="btn-dashboard-filter" type="button" class="btn btn-success" value="{{ __('admin/dashboard.Filter')}}">
                    </div>
                </form>
            </div>
        </div>
        <div class="col-md-3 mt-4 mb-4">
            <div class="card z-index-4 ">
                <h6 class="text-capitalize ps-3 my-3">{{ __('admin/dashboard.Dashboard Filter')}}</h6>
                <div class="d-flex col-md-12">
                    <div class="input-group input-group-outline m-3">
                        <select class="text-center form-control dashboard-filter">
                            <option>{{ __('admin/dashboard.Choose type filter')}}</option>
                            <option value="7days">{{ __('admin/dashboard.7 last days')}}</option>
                            <option value="lastmonth">{{ __('admin/dashboard.Last month')}}</option>
                            <option value="thismonth">{{ __('admin/dashboard.This month')}}</option>
                            <option value="last365days">{{ __('admin/dashboard.Last 365 days')}}</option>
                        </select>
                    </div>
                </div>
                <div class="d-flex justify-content-center m-3">
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-lg-12 col-md-6 mt-4 mb-4">
            <div class="card z-index-2 ">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2 bg-transparent">
                    <div class="bg-gradient-primary shadow-primary border-radius-lg py-3 pe-1">
                        <div class="chart">
                            <div id="chart" style="height: 290px;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- <div class="col-lg-4 col-md-6 mt-4 mb-4">
            <div class="card z-index-2  ">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2 bg-transparent">
                    <div class="bg-gradient-success shadow-success border-radius-lg py-3 pe-1">
                        <div class="chart">
                            <canvas id="chart-line" class="chart-canvas" height="170"></canvas>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <h6 class="mb-0 "> Daily Sales </h6>
                    <p class="text-sm "> (<span class="font-weight-bolder">+15%</span>) increase in today sales. </p>
                    <hr class="dark horizontal">
                    <div class="d-flex ">
                        <i class="material-icons text-sm my-auto me-1">schedule</i>
                        <p class="mb-0 text-sm"> updated 4 min ago </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 mt-4 mb-3">
            <div class="card z-index-2 ">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2 bg-transparent">
                    <div class="bg-gradient-dark shadow-dark border-radius-lg py-3 pe-1">
                        <div class="chart">
                            <canvas id="chart-line-tasks" class="chart-canvas" height="170"></canvas>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <h6 class="mb-0 ">Completed Tasks</h6>
                    <p class="text-sm ">Last Campaign Performance</p>
                    <hr class="dark horizontal">
                    <div class="d-flex ">
                        <i class="material-icons text-sm my-auto me-1">schedule</i>
                        <p class="mb-0 text-sm">just updated</p>
                    </div>
                </div>
            </div>
        </div> -->
    </div>
    <div class="row justify-content-md-center">
        <div class="col-md-3 mt-4 mb-4">
            <div class="card z-index-4 ">
                <h6 class="text-capitalize ps-3 my-3 text-center">{{ __('admin/dashboard.Pages Statistic')}}</h6>
                <div class="d-flex col-md-12" id="donut">
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
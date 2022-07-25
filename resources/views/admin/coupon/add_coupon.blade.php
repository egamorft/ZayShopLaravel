@extends('components.admin_layout.admin_layout')
@section('admin_content')
@extends('components.alert.alert')
<div id="vue">
    <coupon-add></coupon-add>
</div>
<script src="{{url('public/js/app.js')}}"></script>
@endsection
<?php
/**
 * Created by PhpStorm.
 * User: QuanVH
 * Date: 01/11/2016
 * Time: 23:07 CH
 */
        ?>
@extends('admin.layout_master')

@section('main-header')
    <h1>Đơn hàng <small>cập nhật trạng thái</small></h1>
@endsection

@section('main-content')
    <form role="form" method="post" id="frmOrder" enctype="multipart/form-data">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="lbId" id="lbId" value="{!! $order->od_id !!}">

        @include('admin.order.order_info_sale',['order'=>$order])

        <div class="form-group">
            <label>Trạng thái đơn hàng</label>
            <input type="text" class="form-control" disabled value="{!! $order->status->stt_valueA !!}">
        </div>

        @include('admin.order.suggest_factory',[$order])

        @if($order->od_status == 11)
            @include('admin.order.make_suggest',[$order])
        @else
            @include('admin.order.suggest_customer',[$order])
        @endif

        @include('admin.order.history_service',['odId'=>$order->od_id])

        <!-- action assignee employee -->
        <div class="row form-group">
            @if(!$order->od_sale)
                <div class="col-md-6">
                    <a href="{!! route('admin.order.getAssign',$order->od_id) !!}"
                        class="btn btn-block btn-warning">Giao sale</a>
                </div>
            @endif
            @if($order->od_status < 10 || $order->od_status == 36)
                <div class="col-md-6">
                    <a href="{!! route('admin.order.getAssignSupplier', $order->od_id) !!}"
                        class="btn btn-block btn-warning">Giao xưởng</a>
                </div>
            @endif
        </div>
        <!-- end action assignee employee -->

        @include('admin.order.order_note',['odId'=>$order->od_id])

        <div class="row">
            <div class="col-md-6">
                <button class="btn btn-block btn-primary" type="submit">Cập nhật</button>
            </div>
            <div class="col-md-6">
                <button class="btn btn-block btn-primary" type="button" onclick="goBack()">Hủy</button>
            </div>
        </div>

    </form>
@endsection

@section('main-script')
    <script type="text/javascript">
        var currentCountry = "<?php echo $order ? $order->od_country : 0 ?>";
        var currentCity = "<?php echo $order ? $order->od_city : 0 ?>";
        var currentDistrict = "<?php echo $order ? $order->od_district : 0 ?>";
        var currentTotalNum = "<?php echo $order ? $order->od_quantity : 0 ?>"
    </script>
    <script type="text/javascript" src="/js/admin/admin_order.js?v=1.0"></script>
@endsection
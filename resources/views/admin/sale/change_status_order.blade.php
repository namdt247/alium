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
    <h1>Đơn hàng <small>xử lí đơn hàng</small></h1>
@endsection

@section('main-content')
    @if(isset($order))
        <form role="form" method="post" id="frmOrder" enctype="multipart/form-data">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="lbId" id="lbId" value="{!! $order->od_id!!}">

        @if($order->od_status == 9)
            @include('admin.order.order_edit_sale',[$order])
        @else
            @include('admin.order.order_info_sale',[$order])
            @include('admin.order.suggest_customer',[$order])
        @endif
        <div class="form-group">
            <label>Trạng thái đơn hàng</label>
            <input type="text" class="form-control" readonly value="{!! $order->status->stt_valueA !!}">
        </div>

        @if($order->od_status == 14)
            <div class="form-group">
                @foreach($order->suggest as $suggest)
                    @if($suggest->od_assigneeTo == $order->od_assigneeTo)
                        <?php $detailValue = unserialize($suggest->od_detail) ?>
                        <label>Thanh toán lần 1:</label>
                        <input type="text" class="form-control price" name="payment"
                               value="{!! $detailValue['payment1'] !!}">
                    @endif
                @endforeach
            </div>
        @endif
        @if($order->od_status == 20)
            <div class="form-group">
                @foreach($order->suggest as $suggest)
                    @if($suggest->od_assigneeTo == $order->od_assigneeTo)
                        <?php $detailValue = unserialize($suggest->od_detail) ?>
                        <label>Thanh toán lần 2:</label>
                        <input type="text" class="form-control price" name="payment"
                               value="{!! $detailValue['payment2'] !!}">
                    @endif
                @endforeach
            </div>
        @endif

        @if($order->od_status == 28)
            <div class="form-group">
                @foreach($order->suggest as $suggest)
                    @if($suggest->od_assigneeTo == $order->od_assigneeTo)
                        <?php $detailValue = unserialize($suggest->od_detail) ?>
                        <label>Thanh toán lần 3:</label>
                        <input type="text" class="form-control price" name="payment"
                               value="{!! $detailValue['payment3'] !!}" >
                    @endif
                @endforeach
            </div>
        @endif

        @if($order->od_status == 9)
            <div class="form-group">
                <label for="changeStt">Chuyển trạng thái sang</label>
                <input type="text" class="form-control" name="changeStt" readonly="readonly"
                       value="Duyệt đơn hàng">
            </div>
        @endif

        @if($order->od_status == 16)
            <div class="form-group">
                <label for="changeStt">Chuyển trạng thái sang</label>
                <input type="text" class="form-control" name="changeStt" readonly="readonly"
                       value="Duyệt mẫu">
            </div>
        @endif
        @if($order->od_status == 18)
            <div class="form-group">
                <label for="changeStt">Chuyển trạng thái sang</label>
                <input type="text" class="form-control" name="changeStt" readonly="readonly"
                       value="Duyệt mẫu">
            </div>
        @endif
        @if($order->od_status == 27 && $order->od_total<=$order->od_paid)
            <div class="form-group">
                <label for="changeStt">Chuyển trạng thái sang</label>
                <input type="text" class="form-control" name="changeStt" readonly="readonly"
                       value="Vận chuyển">
            </div>
        @endif
        @if($order->od_status == 30)
            <div class="form-group">
                <label for="changeStt">Chuyển trạng thái sang</label>
                <input type="text" class="form-control" name="changeStt" readonly="readonly"
                       value="Đã hoàn thành">
            </div>
        @endif

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
    @endif
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
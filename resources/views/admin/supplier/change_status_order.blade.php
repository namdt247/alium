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
    @if($order)
        <form role="form" method="post" id="frmOrder" enctype="multipart/form-data">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" name="lbId" id="lbId" value="{!! $order->od_id !!}">
            @include('admin.order.order_info_supplier',[$order])

            <div class="form-group">
                <label>Trạng thái đơn hàng</label>
                <input type="text" class="form-control" disabled value="{!! $order->status->stt_valueA !!}">
            </div>

        @if($order->od_status == 10)
            <?php $dal_order = new \App\Http\DAL\DAL_Order();?>
            <?php $lstOrder  = $dal_order->getListSuggestByOrder($order->od_id) ?>     
            @include('admin.order.list_suggest_for_supplier',[$lstOrder])
                <br>
            @include('admin.order.make_suggest_for_supplier',[$order])
        @else
            @include('admin.order.suggest_factory',[$order])
        @endif

        @if($order->od_status == 15 || $order->od_status == 17)
            <div class="form-group">
                <label for="changeStt">Chuyển trạng thái sang</label>
                <input type="text" class="form-control" name="changeStt" readonly="readonly"
                       value="Duyệt mẫu">
            </div>
        @endif

        @if(in_array($order->od_status,[35,21,22,23,24,25,26]))
            @if( $order->od_total-$order->od_paid > 0)
            <div class="form-group">
                <label for="changeStt">Chuyển trạng thái sang</label>
                <input type="text" class="form-control" name="changeStt" readonly="readonly"
                       value="Sản xuất xong">
            </div>
            @else
                <div class="form-group">
                    <label for="changeStt">Chuyển trạng thái sang</label>
                    <input type="text" class="form-control" name="changeStt" readonly="readonly"
                           value="Vận chuyển">
                </div>
            @endif
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
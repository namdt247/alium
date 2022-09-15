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
    <h1>Đơn hàng <small>Giao đơn hàng cho nhân viên</small></h1>
@endsection

@section('main-content')
    <form role="form" method="post" id="frmOrder" enctype="multipart/form-data">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="lbId" id="lbId" value="{!! $order->od_id !!}">

        @include('admin.order.order_info_sale',['order'=>$order])

        @can('sale manager')
        <div class="form-group">
            <label for="">Gán cho sale</label>
            <select name="sale" id="sale" class="form-control">
                <option value="0">--- Chọn nhân viên ---</option>
                <?php $lstSale = \App\Models\User::permission('sale')
                    ->where('user_role',\App\Http\DAL\DAL_Config::ROLE_USER_MOD)->get() ?>
                @foreach($lstSale as $sale)
                    <option value="{!! $sale->user_id !!}">{!! $sale->user_showName !!}</option>
                @endforeach
            </select>
        </div>
        @endcan

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
    <script>
        $(document).ready(function () {
            $("#sale").select2();
        })
    </script>
@endsection
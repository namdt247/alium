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
    <h1>Đơn hàng <small>danh sách</small></h1>
@endsection

@section('main-content')
    <form class="box-body form-inline">
        <label>Lọc theo:</label>
        <input class="form-control" type="text" name="search" placeholder="Tìm kiếm..."
            value="{!! isset($_GET['search']) ? $_GET['search'] : '' !!}" />
        <select class="form-control select2" id="sltStatus" name="filter" style="min-width:25%">
            <option value="0">- Trạng thái -</option>
            <?php $lstStatus = \App\Models\Order_status::where('stt_parent','==',0)->get() ?>
            @foreach($lstStatus as $status)
                <option value="{!! $status->stt_id !!}"
                        @if(isset($_GET['filter']) && $_GET['filter']==$status->stt_id) selected @endif
                >{!! $status->stt_name !!}</option>
            @endforeach
        </select>
        <button type="submit" class="btn btn-primary">Lọc</button>
    </form>

    <div class="box">
        <div class="box-body" style="overflow-x: auto;">
            <table id="tblMain" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Khách hàng</th>
                    <th>Tỉnh/tp</th>
                    <th>Dòng sản phẩm</th>
                    <th>Số lượng</th>
                    <th>Chất lượng</th>
                    <th>Giá mong muốn</th>
                    <th>Lý do huỷ</th>
                    <th>Trạng thái</th>
                    <th>Thao tác</th>
                </tr>
                </thead>
                <tbody>
                @foreach($lstOrder as $order)
                    <tr>
                        <td>{!! $order->od_code !!}</td>
                        <td>{!! $order->demander->user_showName !!}</td>
                        <td>{!! isset($order->city->city_name) ? $order->city->city_name : 'Không xác định' !!}</td>
                        <td>{!! $order->product->prd_name !!}</td>
                        <td>{!! $order->od_quantity !!}</td>
                        <td>{!! $order->quality !!}</td>
                        <td>{!! number_format($order->od_wantedPrice,0,',','.') !!}</td>
                        <td>
                            @if($order->getReasonCancel())
                                {!! $order->getReasonCancel()->od_coupon !!}
                            @endif
                        </td>
                        <td>{!! $order->status->stt_name !!}</td>
                        <td><a href="{!! route('admin.sale.getChangeOrder',$order->od_id) !!}">Xử lí đơn hàng</a></td>
                    </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <th>#</th>
                    <th>Khách hàng</th>
                    <th>Tỉnh/tp</th>
                    <th>Dòng sản phẩm</th>
                    <th>Số lượng</th>
                    <th>Chất lượng</th>
                    <th>Giá mong muốn</th>
                    <th>Lý do huỷ</th>
                    <th>Trạng thái</th>
                    <th>Thao tác</th>
                </tr>
                </tfoot>
            </table>
            @if($lstOrder instanceof \Illuminate\Pagination\LengthAwarePaginator )
                {!! $lstOrder->links() !!}
            @endif
        </div>
        <!-- /.box-body -->
    </div>
    <!-- /.box -->
@endsection

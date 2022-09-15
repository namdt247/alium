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
        <div class="box-body" style="overflow-x:auto;">
            <table id="tblMain" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Dòng sản phẩm</th>
                    <th>Số lượng</th>
                    <th>Chất lượng</th>
                    <th>Giá mong muốn</th>
                    <th>Trạng thái</th>
                    <th>Thao tác</th>
                </tr>
                </thead>
                <tbody>
                @foreach($lstOrder as $order)
                    <?php $odDetail = unserialize($order->od_content) ?>
                    <tr>
                        <td>{!! $order->od_code !!}</td>
                        <td>{!! $order->product->prd_name !!}</td>
                        <td>{!! $order->od_quantity !!}</td>
                        <td>{!! $order->quality !!}</td>
                        <td>{!! is_array($odDetail)
                            && array_key_exists('price_factory', $odDetail)?$odDetail['price_factory']:0 !!}</td>
                        <td>{!! $order->status->stt_name !!}</td>
                        <td>
                            <a href="{!! route('admin.supplier.getChangeOrderSupplier',$order->od_id) !!}">Xử lí đơn hàng</a>
                            @if(!in_array($order->status->stt_parent,[7,8]))
                            <br>
                                <a class="text-danger" onclick="ConfirmDelete(event);"
                                    href="{!! route('admin.order.getCancel', $order->od_id) !!}">Hủy đơn hàng</a>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <th>#</th>
                    <th>Dòng sản phẩm</th>
                    <th>Số lượng</th>
                    <th>Chất lượng</th>
                    <th>Giá mong muốn</th>
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

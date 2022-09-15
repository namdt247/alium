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
    <h1>Đặt sản xuất <small>danh sách</small></h1>
    <a href="{!! route('admin.order.getAdd') !!}" class="btn btn-warning pull-right"
       target="_blank"><i class="fa fa-plus"></i> Thêm đơn hàng</a>
@endsection

@section('main-content')
    @include('admin.include.cancel_order_modal')
    <div class="box-body form-inline">
        <label>Lọc theo:</label>
        <select class="form-control select2" id="sltProduct">
            <option value="0">--- Dòng sản phẩm ---</option>
            <?php $dal_product = new \App\Http\DAL\DAL_Product(); ?>
            <?php $lstProduct = $dal_product->getListPublicProduct(); ?>
            @foreach($lstProduct as $product)
                <option value="{!! $product->prd_id !!}">
                    {!! $product->prd_name !!}</option>
            @endforeach
        </select>
        <select class="form-control select2" id="sltCity">
            <option value="0">--- Tỉnh/TP ---</option>
            <?php $dal_user = new \App\Http\DAL\DAL_User(); ?>
            <?php $lstCity = $dal_user->getListCity(245); ?>
            @foreach($lstCity as $city)
                <option value="{!! $city->city_id !!}">
                    {!! $city->city_name !!}</option>
            @endforeach
        </select>
        <select class="form-control select2" id="sltStatus">
            <option value="0">--- Trạng thái ---</option>
            <?php $lstStatus = \App\Models\Order_status::where('stt_parent','==',0)->get() ?>
            @foreach($lstStatus as $status)
                <option value="{!! $status->stt_id !!}">{!! $status->stt_name !!}</option>
            @endforeach
        </select>
        <select name="employee" id="employee" class="form-control select2">
            <option value="0">--- Chọn nhân viên ---</option>
            <?php $lstSale = \App\Models\User::permission('sale')
                ->where('user_role',\App\Http\DAL\DAL_Config::ROLE_USER_MOD)->get() ?>
            <optgroup label="NV Kinh doanh">
                @foreach($lstSale as $sale)
                    <option value="{!! $sale->user_id !!}">{!! $sale->user_showName !!}</option>
                @endforeach
            </optgroup>
            <?php $lstSupplier = \App\Models\User::permission('supplier')
                ->where('user_role',\App\Http\DAL\DAL_Config::ROLE_USER_MOD)->get() ?>
            <optgroup label="NV Xưởng">
                @foreach($lstSupplier as $supplier)
                    <option value="{!! $supplier->user_id !!}">{!! $supplier->user_showName !!}</option>
                @endforeach
            </optgroup>
        </select>

    </div>
    <div class="box">
        <div class="box-body">
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
                    <th>Ngày đặt</th>
                    <th>Ngày giao</th>
                    <th>Giai đoạn</th>
                    <th>Trạng thái</th>
                    <th>Thao tác</th>
                </tr>
                </thead>
                <tfoot>
                <tr>
                    <th>#</th>
                    <th>Khách hàng</th>
                    <th>Tỉnh/tp</th>
                    <th>Dòng sản phẩm</th>
                    <th>Số lượng</th>
                    <th>Chất lượng</th>
                    <th>Giá mong muốn</th>
                    <th>Ngày đặt</th>
                    <th>Ngày giao</th>
                    <th>Giai đoạn</th>
                    <th>Trạng thái</th>
                    <th>Thao tác</th>
                </tr>
                </tfoot>
            </table>
        </div>
        <!-- /.box-body -->
    </div>
    <!-- /.box -->
@endsection

@section('main-script')
    <script>
        $(function () {
            $('.select2').select2();
            var table = $('#tblMain').DataTable({
                "ajax": {
                    url: '{!! route('admin.order.getListData') !!}',
                    data: function ( d ) {
                        d.city = $("#sltCity").val();
                        d.product = $("#sltProduct").val();
                        d.status = $("#sltStatus").val();
                        d.employee = $("#employee").val();
                    },
                    dataFilter: function(data){
                        var json = jQuery.parseJSON( data );
                        json.recordsTotal = json.total;
                        json.recordsFiltered = json.total;
                        return JSON.stringify( json ); // return JSON string
                    }
                },
                "columns": [
                    { data: "od_code" },
                    { data: "demander.user_showName" },
                    { data: "city.city_name" },
                    { data: "product.prd_name" },
                    { data: "od_quantity" },
                    { data: "quality", defaultValue: 'Không xác định' },
                    {
                        data: "od_wantedPrice",
                        render: function (data) {
                            return new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' }).format(data)
                        }
                    },
                    {
                        data: "created_at",
                        render: function (data) {
                            return moment(data).format("DD/MM/YYYY");
                        }
                    },
                    {
                        data: "od_deliveredTime",
                        render: function (data) {
                            return moment(data).format("DD/MM/YYYY");
                        }
                    },
                    { data: "stage" },
                    {
                        data: "status",
                        render: function (data) {
                            if(data) return data.stt_valueA;
                            else return 'Hủy';
                        },
                        defaultValue: 'Không xác định'
                    },
                    {
                        data: "od_id",
                        render: function (data,meta, full) {
                            let editUrl = "{!! route('admin.order.getEdit',':id') !!}";
                            editUrl = editUrl.replace(':id', data);

                            let cancelUrl = "{!! route('admin.order.getCancel',':id') !!}";
                            cancelUrl = cancelUrl.replace(':id', data);

                            let changeStatus = "{!! route('admin.order.changeStatus',':id') !!}";
                            changeStatus = changeStatus.replace(':id', data);

                            let assignUrl = "{!! route('admin.order.getAssign',':id') !!}";
                            assignUrl = assignUrl.replace(':id',data);

                            let assignSupplierUrl = "{!! route('admin.order.getAssignSupplier',':id') !!}";
                            assignSupplierUrl = assignSupplierUrl.replace(':id',data);

                            let assignSupplierEmployeeUrl = "{!! route('admin.order.getAssignSupplierEmployee',':id') !!}";
                            assignSupplierEmployeeUrl = assignSupplierEmployeeUrl.replace(':id',data);

                            var str = '<i class="fa fa-lg fa-pencil fa-fw"></i>';
                            str += '<a href="' + editUrl + '">Sửa thông tin</a>';

                            str += '<br>';
                            str += '<i class="fa fa-lg fa-pencil fa-fw"></i>';
                            str += '<a href="' + changeStatus + '">Xử lí</a>';

                            if (full.status && (full.status.stt_parent === 7 || full.status.stt_parent === 8)) {
                                str += '<br>'
                                if (full.sale && full.od_sale && full.od_sale > 0) {
                                    str += '<span>Sale: &nbsp;' + full.sale.user_showName + '</span>';
                                }

                                str += '<br>'
                                if (full.supply_employee && full.od_supplier && full.od_supplier > 0) {
                                    str += '<span>Xưởng: &nbsp;' + full.supply_employee.user_showName + '</span>';
                                }

                            }
                            else {
                                str += '<br>'
                                str += '<i class="fa fa-lg fa-pencil fa-fw"></i>';
                                str += '<a href="' + assignUrl + '">Gán sale</a>';

                                if (full.sale && full.od_sale && full.od_sale > 0) {
                                    str += '<span>&nbsp;' + full.sale.user_showName + '</span>';
                                }

                                str += '<br>'
                                str += '<i class="fa fa-lg fa-pencil fa-fw"></i>';
                                str += '<a href="' + assignSupplierEmployeeUrl + '">Gán nv xưởng</a>';

                                if (full.supply_employee && full.od_supplier && full.od_supplier > 0) {
                                    str += '<span>&nbsp;' + full.supply_employee.user_showName + '</span>';
                                }

                                if (full.od_status === 10 || full.od_status === 36) {
                                    str += '<br>'
                                    str += '<i class="fa fa-lg fa-pencil fa-fw"></i>';
                                    str += '<a href="' + assignSupplierUrl + '">Gán xưởng</a>';
                                }

                                str += '<br>'
                                // str += '<a class="text-danger" onclick="ConfirmDelete(event);" href="' + cancelUrl +
                                //     '"><i class="fa fa-lg fa-trash-o fa-fw"></i>Hủy</a>';

                                str += '<span style="cursor: pointer" class="text-danger" id="cancelOrder">\n' +
                                        '<i class="fa fa-lg fa-trash-o fa-fw"></i>Huỷ</span>'
                            }
                            return str;
                        }
                    },
                ],
                pageLength: 30,
                lengthChange: false,
                processing: true,
                serverSide: true,
                paging: true,
                "searching": true,
                ordering: false,
                info: true,
                autoWidth: false,
                "scrollX": true,
            });
            $('select#sltProduct, select#sltCity, select#sltStatus, select#employee').on('change',function (event) {
                table.ajax.reload();
            })
            table.on('click', '#cancelOrder', function () {
                $tr = $(this).closest('tr');
                let data = table.row($tr).data();
                $('#odId').val(data['od_id']);
                let cancelUrl = "{!! route('admin.order.postCancel',':id') !!}";
                cancelUrl = cancelUrl.replace(':id', data['od_id']);
                $('#cancelOrderForm').attr('action', cancelUrl);
                $('#modalCancel').modal('show');
            });

            $("#cancelOrderForm").validate({
                rules: {
                    reasonCancel: {
                        required: true,
                    },
                },
                messages: {
                    reasonCancel: {
                        required: 'Vui lòng chọn lý do huỷ',
                    }
                },
                errorLabelContainer: '.txtError',
            });
        });
    </script>
@endsection
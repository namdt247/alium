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
    <h1>Phản hồi khách hàng <small>danh sách</small></h1>
@endsection


@section('main-content')
    <div class="box">
        <div class="box-body">
            <table id="tblMain" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>Họ Tên</th>
                    <th>Email</th>
                    <th>SDT</th>
                    <th>Đơn hàng</th>
                    <th>Thao tác</th>
                </tr>
                </thead>
                <tfoot>
                <tr>
                    <th>Họ Tên</th>
                    <th>Email</th>
                    <th>SDT</th>
                    <th>Đơn hàng</th>
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
            $('#tblMain').DataTable({
                ajax: {
                    url: '{!! route('admin.feedback.getListData') !!}',
                    dataFilter: function(data){
                        var json = jQuery.parseJSON( data );
                        json.recordsTotal = json.total;
                        json.recordsFiltered = json.total;
                        return JSON.stringify( json ); // return JSON string
                    }
                },
                columns: [
                    { data: "fb_name" },
                    { data: "fb_email" },
                    { data: "fb_phone" },
                    {
                        data: "fb_order",
                        defaultValue: 'Không xác định',
                    },
                    {
                        data: "fb_id",
                        render: function (data) {
                            let editUrl = "{!! route('admin.feedback.getEdit',':id') !!}";
                            editUrl = editUrl.replace(':id', data);

                            var str = '<i class="fa fa-lg fa-pencil fa-fw"></i>';
                            str += '<a href="' + editUrl + '">Chi tiết</a>';
                            return str;
                        }
                    },
                ],
                pageLength: 30,
                lengthChange: false,
                processing: true,
                serverSide: true,
                paging: true,
                searching: false,
                ordering: false,
                info: true,
                autoWidth: false
            });
        });

    </script>
    @endsection
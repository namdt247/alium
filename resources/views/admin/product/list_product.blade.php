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
    <h1>Dòng sản phẩm <small>danh sách</small></h1>
    <a class="btn btn-warning pull-right" href="{!! route('admin.product.cate.getList') !!}">Danh mục</a>

    <a class="btn btn-warning pull-right" href="{!! route('admin.product.getAdd') !!}">Thêm dòng sp</a>
@endsection

@section('main-content')
    <div class="box">
        <div class="box-body">
            <table id="tblMain" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Hình ảnh</th>
                    <th>Tên SP</th>
                    <th>Thao tác</th>
                </tr>
                </thead>
                <tfoot>
                <tr>
                    <th>#</th>
                    <th>Hình ảnh</th>
                    <th>Tên SP</th>
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
                    url: '{!! route('admin.product.listData') !!}',
                    dataFilter: function(data){
                        var json = jQuery.parseJSON( data );
                        json.recordsTotal = json.total;
                        json.recordsFiltered = json.total;
                        return JSON.stringify( json ); // return JSON string
                    }
                },
                columns: [
                    { data: "prd_id" },
                    {
                        data: "image",
                        defaultContent : '',
                        render: function (data) {
                            if (data.length <= 0)
                                return '<img src="/img/order-template.png" class="img img-responsive" alt="" width="160">';
                            else {
                                var str = '<img src="{!! \App\Helper\Common::GetThumb(':id') !!}" ' +
                                'class="img img-responsive" alt="" width="160">';
                                return str.replace(':id', data[0].img_src);
                            }
                        }
                    },
                    { 
                        data: "prd_name",
                        defaultContent: 'Không xác định'
                    },
                    {
                        data: "prd_id",
                        orderable:false,
                        render: function(data, type, full, meta ){
                            var str = '<i class="fa fa-pencil fa-fw"></i>';
                            str += '<a href="{!! route('admin.product.getEdit',':id') !!}">Edit</a>';
                            str = str.replace(':id', data);
                            str += '<span> | </span>';
                            str += '<i class="fa fa-trash-o fa-fw"></i>';
                            str += '<a onclick="return ConfirmDelete(event);" href="{!! route('admin.product.delete',':id') !!}">Delete</a>';
                            str = str.replace(':id', data);
                            return str;
                        }
                    }
                ],
                pageLength: 30,
                lengthChange: false,
                processing: true,
                serverSide: true,
                paging: true,
                searching: true,
                ordering: false,
                info: true,
                autoWidth: false
            });
        });
    </script>
@endsection
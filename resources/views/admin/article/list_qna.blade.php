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
    <h1>Câu hỏi <small>danh sách</small></h1>
    <a href="{!! route('admin.qna.getAdd',$cateId) !!}" class="btn btn-warning pull-right"
       target="_blank"><i class="fa fa-plus"></i> Thêm câu hỏi</a>
@endsection


@section('main-content')
    <div class="box">
        <input type="hidden" id="lbId" value="{!! $cateId !!}">
        <div class="box-body">
            <table id="tblMain" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Câu hỏi</th>
                    <th>Ngày tạo</th>
                    <th>Thao tác</th>
                </tr>
                </thead>
                <tfoot>
                <tr>
                    <th>#</th>
                    <th>Câu hỏi</th>
                    <th>Ngày tạo</th>
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
                    url: '{!! route('admin.qna.getListData') !!}',
                    data: function( d ){
                        d.cate = $("#lbId").val();
                    },
                    dataFilter: function(data){
                        let json = jQuery.parseJSON( data );
                        json.recordsTotal = json.total;
                        json.recordsFiltered = json.total;
                        return JSON.stringify( json ); // return JSON string
                    }
                },
                columns: [
                    { data: "atc_id" },
                    { data: "atc_sapo" },
                    {
                        data: "atc_publicDate",
                        render: function (data) {
                            let d = new Date(data);
                            return d.toLocaleDateString('vi-VN');
                        }
                    },
                    {
                        data: "atc_id",
                        render: function (data) {
                            let editUrl = "{!! route('admin.qna.getEdit',':id') !!}";
                            editUrl = editUrl.replace(':id', data);

                            let deleteUrl = "{!! route('admin.qna.getDelete',':id') !!}";
                            deleteUrl = deleteUrl.replace(':id', data);

                            let str = '<i class="fa fa-lg fa-pencil fa-fw"></i>';
                            str += '<a href="' + editUrl + '">Sửa</a>';
                            str += '<span> | </span>'
                            str += '<a class="text-danger" onclick="ConfirmDelete(event);" href="' +deleteUrl+
                              '"><i class="fa fa-lg fa-trash-o fa-fw"></i>Xóa</a>';
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
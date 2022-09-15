@extends('admin.layout_master')

@section('main-header')
    <h1 class="page-header">Đánh giá <small>danh sách</small></h1>
    <a href="{!! route('admin.rate.getAdd') !!}" class="btn btn-warning pull-right">
        <i class="fa fa-plus"></i> Thêm mới</a>
    <div style="height: 10px;" class="clearfix"></div>
@endsection

@section('main-content')
    <table id="tblMain" class="table table-bordered table-striped">
        <thead>
        <tr>
            <th>#</th>
            <th>Thời gian</th>
            <th>Xưởng</th>
            <th>Khách hàng</th>
            <th>Đơn hàng</th>
            <th>Đánh giá</th>
            <th>Thao tác</th>
        </tr>
        </thead>
        <tfoot>
        <tr>
            <th>#</th>
            <th>Thời gian</th>
            <th>Xưởng</th>
            <th>Khách hàng</th>
            <th>Đơn hàng</th>
            <th>Đánh giá</th>
            <th>Thao tác</th>
        </tr>
        </tfoot>
    </table>
@endsection

@section('main-script')
    <script>
        $(document).ready(function() {
            $('#tblMain').DataTable( {
                paging: true,
                processing: true,
                serverSide: true,
                searching: true,
                lengthChange: false,
                ordering:  false,
                ajax: {
                    url: "{!! route('admin.rate.getListData') !!}",
                    dataFilter: function(data){
                        var json = jQuery.parseJSON( data );
                        json.recordsTotal = json.total;
                        json.recordsFiltered = json.total;
                        return JSON.stringify( json ); // return JSON string
                    }
                },
                columns: [
                    { data: "rate_id" },
                    {
                        data: "created_at",
                        render: function (data) {
                            return moment(data).format("DD/MM/YYYY");
                        }
                    },
                    {
                        data: "supplier",
                        render: function (data) {
                            if(data) return data.sp_code + ' - ' + data.sp_name;
                            return 'Không xác định'
                        }
                    },
                    { data: "user.user_showName" },
                    { data: "order.od_code", defaultContent: 'Không xác định' },
                    {
                        data: "rate_star",
                        render: function (data) {
                            let str = '';
                            for (let i = 0; i < 5; i++) {
                                if (i >= parseInt(data)) str += '<span class="fa fa-star"></span>'
                                else str += '<span class="fa fa-star checked"></span>';
                            }
                            return str;
                        }
                    },
                    {
                        data: "rate_id",
                        orderable:false,
                        render: function(data, type, full, meta ){
                            var str = '<i class="fa fa-pencil fa-fw"></i>';
                            str += '<a href="{!! route('admin.rate.getEdit',':id') !!}">Duyệt</a>';
                            str = str.replace(':id', data);
                            return str;
                        }
                    }
                ],
            } );
        } );
    </script>
@endsection
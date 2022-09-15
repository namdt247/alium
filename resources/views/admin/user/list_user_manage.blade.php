@extends('admin.layout_master')

@section('main-header')
    <h1 class="page-header pull-left">Quản trị viên
        <small>Danh sách</small>
    </h1>
    <a href="{!! route('admin.user.getAddManage') !!}" class="btn btn-warning pull-right"
       target="_blank"><i class="fa fa-plus"></i>  Thêm quản trị</a>
@endsection

@section('main-content')
<table id="tblMain" class="table table-bordered table-striped">
    <thead>
    <tr>
        <th>#</th>
        <th>Email</th>
        <th>Họ tên</th>
        <th>Cấp bậc</th>
        <th>Thao tác</th>
    </tr>
    </thead>
    <tfoot>
    <tr>
        <th>#</th>
        <th>Email</th>
        <th>Họ tên</th>
        <th>Cấp bậc</th>
        <th>Thao tác</th>
    </tr>
    </tfoot>
</table>
@endsection
@section('main-script')
<script>
    $(document).ready(function() {
        $('#tblMain').DataTable( {
            pageLength: 30,
            lengthChange: false,
            // "sDom":'fptip',
            paging: true,
            processing: true,
            serverSide: true,
            searching: true,
            ordering:  false,
            ajax: {
                url: "{!! route('admin.user.getListManageData') !!}",
                dataFilter: function(data){
                    var json = jQuery.parseJSON( data );
                    json.recordsTotal = json.total;
                    json.recordsFiltered = json.total;
                    return JSON.stringify( json ); // return JSON string
                }
            },
            columns: [
                { data: "user_id" },
                { data: "user_email", orderable:false, },
                { data: "user_showName", orderable:false, },
                { data: "user_role", render:function (data) {
                        if (parseInt(data) === 2) return "Admin";
                        else if (parseInt(data) === 3) return "Quản trị viên";
                        else  return "";
                    }},
                {
                    data: "user_id",
                    orderable:false,
                    render: function(data, type, full, meta ){
                        let editUrl = "{!! route('admin.user.getEdit',':id') !!}";
                        editUrl = editUrl.replace(':id', data);

                        let deleteUrl = "{!! route('admin.user.getDelete',':id') !!}";
                        deleteUrl = deleteUrl.replace(':id', data);

                        let lockUrl = "{!! route('admin.user.getLock',':id') !!}";
                        lockUrl = lockUrl.replace(':id', data);

                        let str = '';
                        str += '<i class="fa fa-pencil fa-fw"></i>';
                        str += '<a href="' +editUrl+ '">Chỉnh sửa</a>';

                        str += '<span> | </span>';
                        str += '<i class="fa fa-lock fa-fw"></i>';
                        str += '<a href="' +lockUrl+ '">Khóa</a>';

                        str += '<span> | </span>';
                        str += '<i class="fa fa-trash-o fa-fw"></i>';
                        str += '<a href="' +deleteUrl+ '">Xóa</a>';

                        return str;
                    }
                }
            ],
        } );
    });

</script>
    @endsection
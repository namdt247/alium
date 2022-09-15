@extends('admin.layout_master')

@section('main-header')
    <h1 class="">Xưởng may <small>danh sách</small></h1>
@endsection

@section('main-content')
    <div class=" form-inline">
        <label>Lọc theo:</label><br />
        <select class="form-control select2" id="sltType">
            <option value="0">--- Phân loại xưởng ---</option>
            <?php $lstType = \App\Http\DAL\DAL_Config::getConfigByLocale(4); ?>
            @foreach($lstType as $config)
                <?php $config = (object)$config; ?>
                <option value="{!! $config->id !!}">{!! $config->name !!}</option>
            @endforeach
        </select>
        <select class="form-control select2" id="sltOrderQuanlity">
            <option value="0">--- Chất lượng đơn hàng ---</option>
            <?php $lstQuanlity = \App\Http\DAL\DAL_Config::getConfigByLocale(3); ?>
            @foreach($lstQuanlity as $config)
                <option value="{!! $config['id'] !!}">{!! $config['name'] !!}</option>
            @endforeach
        </select>
        <select class="form-control select2" id="sltProduct">
            <option value="0">--- Dòng sản phẩm ---</option>
            <?php $dal_product = new \App\Http\DAL\DAL_Product(); ?>
            <?php $lstProduct = $dal_product->getListPublicProduct(); ?>
            @foreach($lstProduct as $product)
                <option value="{!! $product->prd_id !!}">
                    {!! $product->prd_name !!}</option>
            @endforeach
        </select>

    </div>
    <table id="tblMain" class="table table-bordered table-striped">
        <thead>
        <tr>
            <th>#</th>
            <th>Tên</th>
            <th>Email</th>
            <th>SDT</th>
            <th>Tỉnh/TP</th>
            <th>Phân loại xưởng</th>
            <th>Chất lượng hàng</th>
            <th>Thao tác</th>
        </tr>
        </thead>
        <tfoot>
        <tr>
            <th>#</th>
            <th>Tên</th>
            <th>Email</th>
            <th>SDT</th>
            <th>Tỉnh/TP</th>
            <th>Phân loại xưởng</th>
            <th>Chất lượng hàng</th>
            <th>Thao tác</th>
        </tr>
        </tfoot>
    </table>

@endsection

@section('main-script')
    <script>
        $(document).ready(function() {
            var table = $('#tblMain').DataTable( {
                "scrollX": true,
                paging: true,
                processing: true,
                serverSide: true,
                searching: true,
                ordering:  false,
                lengthChange: false,
                pageLength: 30,
                ajax: {
                    url: "{!! route('admin.supplier.getListData') !!}",
                    data: function ( d ) {
                        d.type = $("#sltType").val();
                        d.quanlity = $("#sltOrderQuanlity").val();
                        d.product = $("#sltProduct").val();
                    },
                    dataFilter: function(data){
                        var json = jQuery.parseJSON( data );
                        json.recordsTotal = json.total;
                        json.recordsFiltered = json.total;
                        return JSON.stringify( json ); // return JSON string
                    }
                },
                columns: [
                    { data: "sp_code" },
                    { data: "sp_name" },
                    { data: "sp_email" },
                    { data: "sp_phone" },
                    { data: "city.city_name", defaultContent: 'Không xác định' },
                    { data: "typeSupplier" },
                    { data: "qualityOrder" },
                    {
                        data: {},
                        orderable:false,
                        render: function(data){
                            let editUrl = "{!! route('admin.supplier.getEdit',':id') !!}";
                            editUrl = editUrl.replace(':id', data.sp_id);

                            let deleteUrl = "{!! route('admin.supplier.getDelete',':id') !!}";
                            deleteUrl = deleteUrl.replace(':id', data.sp_id);

                            let activeUrl = "{!! route('admin.supplier.getActive',':id') !!}";
                            activeUrl = activeUrl.replace(':id', data.sp_id);

                            let registerUserUrl = "{!! route('admin.user.getAddUserSupplier',':id') !!}";
                            registerUserUrl = registerUserUrl.replace(':id', data.sp_id);

                            var str = '<i class="fa fa-lg fa-pencil fa-fw"></i>';
                            str += '<a href="' + editUrl + '">Sửa</a>';
                            str += '<br></br>';

                            if(data.sp_status === 0) {
                                str += '<i class="fa fa-check fa-fw"></i>';
                                str += '<a onclick="ConfirmSupplierActive(event);" href="' + activeUrl + '">Kích hoạt</a>';
                            }
                            if(!data.sp_manager){
                                str += '<i class="fa fa-lg fa-user fa-fw"></i>';
                                str += '<a href="' + registerUserUrl + '">Tạo user</a>';
                                str += '<br></br>';
                            }
                            // str += '<br></br> ';
                            // str += '<a class="text-danger" onclick="ConfirmDelete(event);" href="' +deleteUrl+
                            //     '"><i class="fa fa-lg fa-trash-o fa-fw"></i>Xóa</a>';

                            return str;
                        }
                    },
                ]
            } );

            $('select').on('change',function (event) {
                table.ajax.reload();
            });
            $(".select2").select2({minimumResultsForSearch:-1});
        } );
    </script>
@endsection

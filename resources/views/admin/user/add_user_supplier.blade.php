@extends('admin.layout_master')

@section('main-header')
    <h1 class="page-header">Tài khoản xưởng <small>Thêm mới</small></h1>
@endsection

@section('main-content')
    <form action="" id="addUserSupplier" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="spId" value="{{ $supplier->sp_id }}">

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Email (<span class="text-danger">*</span>) </label>
                    <input class="form-control" name="txtEmail" value="{!! $supplier->sp_email !!}" required/>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>SDT (<span class="text-danger">*</span>) </label>
                    <input class="form-control" name="txtPhone" value="{!! $supplier->sp_phone !!}"
                           minlength="9" required/>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Họ tên (<span class="text-danger">*</span>) </label>
                    <input class="form-control" name="txtShowName" placeholder="Họ tên"
                           value="{!! $supplier->sp_name !!}" required />
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Thêm mới</button>
    </form>
@endsection

@section('main-script')
    <script>
        $(document).ready(function() {
            //Date picker
            $.fn.datepicker.dates['vi'] = {
                days: ["Chủ nhật", "Thứ hai", "Thứ ba", "Thứ tư", "Thứ năm", "Thứ sáu", "Thứ bảy"],
                daysShort: ["CN", "Hai", "Ba", "Tư", "Năm", "Sáu", "Bảy"],
                daysMin: ["CN", "T2", "T3", "T4", "T5", "T6", "T7"],
                months: ["Tháng một", "Tháng hai", "Tháng ba", "Tháng tư", "Tháng năm", "Tháng sáu", "Tháng bảy",
                    "Tháng tám", "Tháng chín", "Tháng mười", "Tháng M.một", "Tháng M.hai"],
                monthsShort: ["T1", "T2", "T3", "T4", "T5", "T6", "T7", "T8",
                    "T9", "T10", "T11", "T12"],
                today: "Hôm nay",
                clear: "Đóng",
                format: "mm/dd/yyyy",
                titleFormat: "MM yyyy", /* Leverages same syntax as 'format' */
                weekStart: 0
            };
            $('#datepicker').datepicker({
                autoclose: true,
                todayHighlight: true,
                startView: "years",
                language: 'vi'
            });
            $(".select2").select2();

            $("#addUserRegister").validate({
                rules: {
                    txtEmail: {
                        required: true,
                        email: true
                    },
                    txtPhone: {
                        required: true,
                        digits: true
                    },
                    txtShowName: {
                        required: true
                    }
                }
            });
        });
    </script>
@endsection
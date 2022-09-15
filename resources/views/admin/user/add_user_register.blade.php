@extends('admin.layout_master')

@section('main-header')
    <h1 class="page-header">Người dùng <small>Thêm mới</small></h1>
@endsection

@section('main-content')
    <form action="" id="addUserRegister" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Email</label>
                    <input class="form-control" name="txtEmail" value="{!! old('txtEmail') !!}"/>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>SDT (<span class="text-danger">*</span>) </label>
                    <input class="form-control" name="txtPhone" value="{!! old('txtPhone') !!}"
                           minlength="9" required/>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Mật khẩu (<span class="text-danger">*</span>) </label>
                    <input class="form-control" type="password" name="txtPassword" value="" required minlength="8"/>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Nhập lại mật khẩu (<span class="text-danger">*</span>) </label>
                    <input class="form-control" type="password" name="txtPassword_confirmation"
                           value="" required minlength="8"/>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Họ tên</label>
                    <input class="form-control" name="txtShowName" placeholder="Họ tên" value="{!! old('txtShowName') !!}"/>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Tỉnh/thành phố</label>
                    <select class="form-control select2" name="sltCity">
                        <?php $dal_user = new \App\Http\DAL\DAL_User(); ?>
                        <?php $lstCity = $dal_user->getListCity(245); ?>
                        <option value="0"> --- Tỉnh/thành phố --- </option>
                        @foreach($lstCity as $city)
                            <option value="{!! $city->city_id !!}" @if($city->city_id == old('sltCity')) selected @endif>
                                {!! $city->city_name !!}</option>
                        @endforeach
                    </select>

                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Ngày tháng năm sinh:</label>

                    <div class="input-group date">
                        <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </div>
                        <input type="text" class="form-control pull-right" id="datepicker"
                               value="{!! old('birthday') !!}" name="birthday">
                    </div>
                    <!-- /.input group -->
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Giới tính</label>
                    <select class="form-control" name="sltGender">
                        <option value="Không xác định">Không xác định</option>
                        <option value="Nam">Nam</option>
                        <option value="Nữ">Nữ</option>
                    </select>
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
                        required: false,
                        email: true
                    },
                    txtPhone: {
                        required: true,
                        digits: true
                    }
                }
            });
        });
    </script>
    @endsection
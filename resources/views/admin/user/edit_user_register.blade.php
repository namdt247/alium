@extends('admin.layout_master')

@section('main-header')
    <h1 class="page-header">Người dùng <small>Chỉnh sửa thông tin</small></h1>
@endsection

@section('main-content')
    <form action="" id="editUserRegister" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="lbId" value="{!! $user->user_id !!}">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="txtEmail">Email (<span class="text-danger">*</span>) </label>
                    <input class="form-control" name="txtEmail" value="{!! $user->user_email !!}" required/>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="txtPhone">SDT (<span class="text-danger">*</span>) </label>
                    <input class="form-control" name="txtPhone" value="{!! $user->user_phone !!}"
                           required minlength="9"/>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="txtShowName">Họ tên</label>
                    <input class="form-control" name="txtShowName" placeholder="Họ tên" value="{!! $user->user_showName !!}"/>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="sltCity">Tỉnh/thành phố</label>
                    <select class="form-control city-select" name="sltCity">
                        <?php $dal_user = new \App\Http\DAL\DAL_User(); ?>
                        <?php $lstCity = $dal_user->getListCity(245); ?>
                        <option value="0"> --- Tỉnh/thành phố --- </option>
                        @foreach($lstCity as $city)
                            <option value="{!! $city->city_id !!}" @if($city->city_id == $user->user_city) selected @endif>
                                {!! $city->city_name !!}</option>
                        @endforeach
                    </select>

                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="txtAddress">Địa chỉ</label>
                    <input class="form-control" name="txtAddress" placeholder="Địa chỉ..."
                           value="{!! $user->user_address !!}"/>
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
                               value="{!! $user->user_birthday ? date('m/d/Y',strtotime($user->user_birthday)):'' !!}"
                               name="birthday">
                    </div>
                    <!-- /.input group -->
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Giới tính</label>
                    <select class="form-control" name="sltGender">
                        <option value="Không xác định"
                                @if($user->user_gender == 'Không xác định') selected @endif>Không xác định</option>
                        <option value="Nam" @if($user->user_gender == 'Nam') selected @endif>Nam</option>
                        <option value="Nữ" @if($user->user_gender == 'Nữ') selected @endif>Nữ</option>
                    </select>
                </div>
            </div>

        </div>

        <button type="submit" class="btn btn-warning">Cập nhật</button>
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
            $(".city-select").select2();
            $("#editUserRegister").validate({
                rules: {
                    txtEmail: {
                        required: true,
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
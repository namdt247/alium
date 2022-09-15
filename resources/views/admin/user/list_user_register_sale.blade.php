@extends('admin.layout_master')

@section('main-header')
    <h1 class="page-header">Người dùng <small>Danh sách</small></h1>
    <a href="{!! route('admin.user.getAddUserSale') !!}" class="btn btn-warning pull-right"
       target="_blank"><i class="fa fa-plus"></i> Thêm người dùng</a>
@endsection

@section('main-content')
    <?php $dal_user = new \App\Http\DAL\DAL_User(); ?>
    <?php
    $textSearch = isset($_GET['query']) ? $_GET['query'] : '';
    $dateRange = isset($_GET['date']) ? $_GET['date'] : '';
    $cityId = isset($_GET['city']) ? $_GET['city'] : 0;
    $currentCity = $dal_user->getDetailCity($cityId);
    $startDate = ''; $endDate = '';
    if($dateRange != '') {
        $lstDate = explode('-', $dateRange);
        $startDate = trim($lstDate[0]);
        $endDate = trim($lstDate[1]);
    }
    ?>
    <form class=" form-inline" style="margin-bottom: 20px;" method="get">
        <div class="form-group">
            <input type="text" class="form-control" name="query"
                   value="{!! $textSearch !!}" placeholder="Tìm kiếm...">
        </div>
        <div class="form-group">
            <label>Ngày đăng ký:</label>
            <div class="input-group">
                <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                </div>
                <input type="text" class="form-control pull-right" value="{!! $dateRange !!}" id="reservation" name="date">
            </div>
            <!-- /.input group -->
        </div>
        <select class="form-control select2" name="city">
            <?php $lstCity = $dal_user->getListCity(245); ?>
            <option value="0"> --- Tỉnh/thành phố --- </option>
            @foreach($lstCity as $city)
                <option value="{!! $city->city_id !!}" @if($city->city_id == $cityId) selected @endif>
                    {!! $city->city_name !!}</option>
            @endforeach
        </select>
        <button type="submit" class="btn btn-default">Tìm kiếm</button>
    </form>
    <div style="overflow-x: auto;">
        <table class="table table-bordered table-striped">
            <tbody>
            <tr>
                <th style="width: 10px">#</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Full name</th>
                <th>City</th>
                <th>Date</th>
                <th>Source</th>
                <th>Note</th>
                <th>Action</th>
            </tr>
            @foreach($lstUser as $user)
                @php
                    $dataSource = '';
                    $dataNote = '';
                @endphp
                @foreach($user->userDetail as $detail)
                    @if($detail->dt_name == \App\Helper\_ObjectType::KEY_SOURCE)
                        <?php $dataSource = $detail->dt_value; ?>
                    @endif
                    @if($detail->dt_name == \App\Helper\_ObjectType::KEY_NOTE)
                        <?php $dataNote = $detail->dt_value; ?>
                    @endif
                @endforeach
                <tr>
                    <td>{!! $user->user_id !!}</td>
                    <td>{!! $user->user_email !!}</td>
                    <td>{!! $user->user_phone !!}</td>
                    <td>{!! $user->user_showName !!}</td>
                    <td>
                        @if(isset($user->city))
                            {!! $user->city->city_name !!}
                        @elseif($currentCity)
                            {!! $currentCity->city_name !!}
                        @elseif($user->user_city > 0)
                            <?php $itemCity = $dal_user->getDetailCity($user->user_city); ?>
                            {!! $itemCity->city_name !!}
                        @else
                            Không xách định
                        @endif
                    </td>
                    <td>{!! date('d/m/Y',strtotime($user->created_at)) !!}</td>
                    <td>{!! $dataSource !!}</td>
                    <td>{!! $dataNote !!}</td>
                    <td>
                        <i class="fa fa-pencil fa-fw"></i>
                        <a href="{!! route('admin.user.getEdit',$user->user_id) !!}" target="_blank">Sửa</a>
{{--                        <span> | </span>--}}
{{--                        @if($user->user_status == \App\Http\DAL\DAL_Config::USER_STATUS_PENDING)--}}
{{--                            <i class="fa fa-check fa-fw"></i>--}}
{{--                            <a href="{!! route('admin.user.getActiveRegister',$user->user_id) !!}">Kích hoạt</a>--}}
{{--                        @endif--}}
{{--                        @if($user->user_status == \App\Http\DAL\DAL_Config::USER_STATUS_LOCKED)--}}
{{--                            <i class="fa fa-lock fa-fw"></i>--}}
{{--                            <a href="{!! route('admin.user.getLock',$user->user_id) !!}">Mở khóa</a>--}}
{{--                        @else--}}
{{--                            <i class="fa fa-lock fa-fw"></i>--}}
{{--                            <a href="{!! route('admin.user.getLock',$user->user_id) !!}">Khóa</a>--}}
{{--                        @endif--}}
{{--                        <span> | </span>--}}
{{--                        @if($user->user_verify != 1)--}}
{{--                            <i class="fa fa-envelope fa-fw"></i>--}}
{{--                            <a href="{!! route('admin.user.getEmailActiveRegister',$user->user_id) !!}">Gửi email KH</a>--}}
{{--                            <span> | </span>--}}
{{--                        @endif--}}
{{--                        <i class="fa fa-trash fa-fw"></i>--}}
{{--                        <a href="{!! route('admin.user.getDelete',$user->user_id) !!}">Xóa</a>--}}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <div class="text-right" style="margin: -1.5rem 0">
        @if(method_exists($lstUser, 'links')) {!! $lstUser->links() !!} @endif
    </div>
@endsection
@section('main-script')
    <script>
        $(function () {
            let startDate = "{!! $startDate !!}";
            if(!startDate) startDate = moment().subtract(7, 'days');
            let endDate = "{!! $endDate !!}";
            if (!endDate) endDate = moment();
            $('#reservation').daterangepicker({
                startDate: startDate,
                endDate: endDate,
                minDate: moment().subtract(30, 'days'),
                maxDate: moment(),
                autoApply: true,
            });
            $(".select2").select2();
        })
    </script>
@endsection
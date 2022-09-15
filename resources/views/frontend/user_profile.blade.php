@extends('frontend.layout_user_info')

@section('user_content')
    <h2 class="info-header">@lang('message.myAccount.profile')</h2>
    <form class="user-info-content" method="post">
        <!-- Flash message -->
        @if( \Illuminate\Support\Facades\Session::has('success_message'))
            <label for="" class="text-success">
                {{ \Illuminate\Support\Facades\Session::get('success_message') }}
            </label>
        @endif

        @if( \Illuminate\Support\Facades\Session::has('error_message'))
            <label for="" class="text-danger">
                {{ \Illuminate\Support\Facades\Session::get('error_message') }}
            </label>
        @endif
        {{--<!-- end flash message -->--}}
        {!! csrf_field() !!}
        <div class="row pt-3">
            <?php $user = $data['user']; ?>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="">@lang('message.question.fullName')</label>
                    <input type="text" class="form-control form-control-lg" 
                        placeholder="@lang('message.question.fullName')"
                        name="name" value="{!! $user->user_showName !!}">
                </div>
                <div class="form-group">
                    <label for="">@lang('message.question.phoneNum') *</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <button class="btn btn-outline-secondary dropdown-toggle" type="button"
                                    data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false">+84</button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="#">+84</a>
                            </div>
                        </div>
                        <input type="tel" class="form-control form-control-lg" aria-label="số điện thoại"
                            readonly name="phone" value="{!! $user->user_phone !!}">
                    </div>
                </div>

                <div class="form-group">
                    <label for="">@lang('message.question.email')</label>
                    <input type="email" class="form-control form-control-lg" placeholder="Email" readonly
                        name="email" value="{!! $user->user_email !!}">
                </div>
                <div class="form-group">
                    <label for="">@lang('message.myAccount.address')</label>
                    <input type="text" class="form-control form-control-lg" placeholder="Địa chỉ"
                        name="address" value="{!! $user->user_address !!}">
                </div>
                <div class="form-group">
                    <label for="">@lang('message.myAccount.city')</label>
                    <?php $dal_user = new \App\Http\DAL\DAL_User();?>
                    <?php $lstCity = $dal_user->getListCity(245);?>
                    <select  class="form-control form-control-lg city" name="city">
                        @foreach($lstCity as $city)
                            <option value="{!! $city->city_id !!}"
                                @if($city->city_id == $user->user_city) selected @endif >
                                {!! $city->city_name !!}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-6 pt-5 pt-md-0">
                <div class="form-group" >
                    <label class="d-block" for="">@lang('message.myAccount.gender')</label>
                    <label class="mr-3">
                        <input type="radio" name="gender" class="minimal" value="Nam"
                               @if(!$user->user_gender || $user->user_gender == 'Nam' ) checked @endif> 
                               @lang('message.myAccount.male')
                    </label>
                    <label>
                        <input type="radio" name="gender" class="minimal" value="Nữ"
                               @if($user->user_gender == 'Nữ') checked @endif> 
                               @lang('message.myAccount.female')
                    </label>
                </div>
                <div class="form-group">
                    <label for="">@lang('message.myAccount.birthday')</label>
{{--                    <div class="d-flex justify-content-between">--}}
{{--                        <div class="" style="width:30%">--}}
{{--                            <select class="form-control form-control-lg city" name="" id="">--}}
{{--                                <option value="0">1</option>--}}
{{--                            </select>--}}
{{--                        </div>--}}
{{--                        <div class="" style="width:30%">--}}
{{--                            <select class="form-control form-control-lg city" name="" id="">--}}
{{--                                <option value="0">1</option>--}}
{{--                            </select>--}}
{{--                        </div>--}}
{{--                        <div class="" style="width:30%">--}}
{{--                            <select class="form-control form-control-lg city" name="" id="">--}}
{{--                                <option value="0">1993</option>--}}
{{--                            </select>--}}
{{--                        </div>--}}
{{--                    </div>--}}
                    <input type="text" class="form-control-lg date form-control"
                           name="birthday" placeholder="01/01/1990"
                           value="{!! date_format(date_create($user->user_birthday),'m/d/Y') !!}">
                </div>
                <div class="form-group">
                    <label for="">@lang('message.myAccount.money')</label>
                    <select class="form-control form-control-lg cash" name="cash" disabled>
                        <option value="1">@lang('message.odPayment.unit')</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <button type="submit" class="btn btn-block text-center btnSave mt-3">
                    @lang('message.myAccount.save')
                </button>
            </div>
        </div>
    </form>
@endsection

@section('main-script')
    <script>
        $(document).ready(function () {
            $(".city").select2();
            $(".cash").select2();
        });
        $('input.date').datepicker({
            autoclose: true,
            startView: 'year',
            clearBtn: true,
            todayHighlight: true
        });
    </script>
@endsection

@extends('frontend.layout_master')

@section('main-content')
    <div class="user content">
        <div class="container">
            <div class="row">
                <div class="col-md-3 user-menu">
                    <div class="row align-items-center my-1 py-3">
                        <div class="col-3 pr-0">
                            <?php
                            $userAvatar = Auth::user()->user_avatar ?
                                \App\Helper\Common::GetThumb(Auth::user()->user_avatar) : asset('img/user_default.png');
                            ?>

                            <img src="{!! $userAvatar !!}" alt="{!! Auth::user()->user_showName !!}"
                                 class="img img-fluid rounded-circle">
                        </div>
                        <div class="col-9">
                            <h4>{!! Auth::user()->user_showName !!}</h4>
                            <button class="btn btnImage d-none">Chọn ảnh</button>
                        </div>
                    </div>
                    <h3>@lang('message.header.myAccount')</h3>
                    <ul class="pl-4">
                        <li><a href="{!! route('frontend.user.getProfile') !!}"
                                    @if($data['sidebar'] == 10) class="active" @endif>
                                @lang('message.myAccount.profile')
                            </a></li>
                        <li><a href="{!! route('frontend.user.getChangePass') !!}"
                                @if($data['sidebar'] == 11) class="active" @endif>
                                @lang('message.myAccount.changePw')
                            </a></li>
                    </ul>
                    <h3>@lang('message.header.notice')</h3>
                    <ul class="pl-4">
                        <li><a href="{!! route('frontend.notify.getList',['filter'=>1]) !!}"
                                @if($data['sidebar'] == 1) class="active" @endif>
                                @lang('message.notice.updateOrder')
                            </a></li>
                        <li><a href="{!! route('frontend.notify.getList') !!}"
                                @if($data['sidebar'] == 2) class="active" @endif>
                                @lang('message.notice.promotion')
                            </a></li>
                        <li><a href="{!! route('frontend.notify.getList') !!}"
                                @if($data['sidebar'] == 0) class="active" @endif>
                                @lang('message.manageOd.all')
                            </a></li>
                    </ul>
                </div>
                <div class="col-md-9">
                    <div class="user-info user-info-mobile">
                        @yield('user_content')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

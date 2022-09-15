@extends('frontend.layout_user_info')

@section('user_content')
    <h2 class="info-header">
        @if($data['sidebar'] == 1)
            @lang('message.notice.updateOrder')
        @elseif($data['sidebar'] == 2)
            @lang('message.notice.promotion')
        @else
            @lang('message.manageOd.all')
        @endif
    </h2>
    <div class="user-info-content user-info-content-mobile">
        @foreach($data['lstNotify'] as $notification)
            @if($notification->read())
                <div class="notify-item d-flex">
                    @if(isset($notification->data['image']))
                    <img src="{!! $notification->data['image'] !!}" alt="@lang('message.odInfo.imgAlt')" 
                        class="img img-fluid">
                    @else
                        <img class="img img-fluid" src="/img/order-template.png"
                             alt="{!! $notification->data['title'] !!}">
                    @endif
                    <div class="pl-4 w-50 noti-mobile">
                        <p class="header" style="color: #aaa;">{!! $notification->data['title'] !!}</p>
                        <p>{!! $notification->data['name'] !!}</p>
                        <p>{!! $notification->data['message'] !!}</p>
                    </div>
                    <a href="{!! $notification->data['url'] !!}" class="ml-auto action-mobile text-center"
                            style="background-color: #aaa;">
                        {!! $notification->data['action'] !!}
                    </a>
                </div>
            @elseif(in_array($notification->data['type'],[2,13]))
                <div class="notify-item d-flex">
                    <img src="{!! $notification->data['image'] !!}" alt="@lang('message.odInfo.imgAlt')" 
                        class="img img-fluid">
                    <div class="pl-4 w-50 noti-mobile">
                        <p class="header" style="color: #ff3918;">{!! $notification->data['title'] !!}</p>
                        <p>{!! $notification->data['name'] !!}</p>
                        <p>{!! $notification->data['message'] !!}</p>
                    </div>
                    <a href="{!! $notification->data['url'] !!}" class="ml-auto action-mobile text-center"
                            style="background-color: #ff3918;">
                        {!! $notification->data['action'] !!}
                    </a>
                </div>
            @else
                <div class="notify-item d-flex">
                    <img src="{!! $notification->data['image'] !!}" alt="@lang('message.odInfo.imgAlt')" 
                        class="img img-fluid">
                    <div class="pl-4 w-50 noti-mobile">
                        <p class="header">{!! $notification->data['title'] !!}</p>
                        <p>{!! $notification->data['name'] !!}</p>
                        <p>{!! $notification->data['message'] !!}</p>
                    </div>
                    <a href="{!! $notification->data['url'] !!}" class="ml-auto action-mobile text-center"
                            style="">
                        {!! $notification->data['action'] !!}
                    </a>
                </div>
            @endif
        @endforeach
    </div>
@endsection
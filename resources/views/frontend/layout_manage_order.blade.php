
@extends('frontend.layout_master')

@section('main-content')
    <div id="manageOrder" class="content">
        <div class="container">
            <div class="row pt-4">
                <div class="col-md-2">
                    <ul class="nav flex-orderList" id="" role="tablist" aria-orientation="vertical">
                        <li class="nav-item">
                            <a class="nav-link @if($data['sidebar'] == 1) active @endif"
                               href="{!! route('frontend.order.getList') !!}">
                               @lang('message.header.order')
                            </a>
                        </li>
                        <li class="nav-item mt-4">
                            <a class="nav-link @if($data['sidebar'] == 2) active @endif"
                               href="{!! route('frontend.order.getHistory') !!}">
                               @lang('message.manageOd.history')
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="col-md-10">
                    @yield('content-order')
                </div>
            </div>
        </div>
    </div>
@endsection

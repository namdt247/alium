@extends('frontend.layout_master')

@section('main-content')
    <div class="content" style="min-height: 500px;">
        <div class="container">
            <div class="row mb-10">
                <div class="col-md-3 user-menu pt-4">
                    <h3 class="header mb-3">@lang('message.question.questions')</h3>
                    <ul class="pl-4">
                        <li><a href="{!! route('frontend.faq.getGuide','dat-san-xuat') !!}"
                               @if(isset($data) && $data['alias'] == 'dat-san-xuat') class="active" @endif
                            >@lang('message.footer.guideProduce')</a></li>
                        <li><a href="{!! route('frontend.faq.getGuide','dang-ky-xuong') !!}"
                               @if(isset($data) && $data['alias'] == 'dang-ky-xuong') class="active" @endif
                            >@lang('message.footer.guideRegisterSup')</a></li>
                        <li><a href="{!! route('frontend.faq.getGuide','thanh-toan') !!}"
                               @if(isset($data) && $data['alias'] == 'thanh-toan') class="active" @endif
                            >@lang('message.footer.payment')</a></li>
                    </ul>
                    <a href="{!! route('frontend.faq.getAdd') !!}" class="btn btn-block" style="padding: .75rem; color: white; background-color: #3e9364;"
                        >@lang('message.footer.customerCare')</a>
                </div>

                <div class="col-md-9">
                    <div class="user-info">
                        @yield('main-service')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

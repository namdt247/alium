<?php
/**
 * Created by PhpStorm.
 * User: quanvu
 * Date: 2019-07-07
 * Time: 10:18
 */
?>

@extends('frontend.layout_master')

@section('main-content')
    <div class="content" style="min-height: 500px;">
        <div class="container">
            <h3 class="py-4 text-center" style="color: #3e9364;">
                @lang('message.userActivate.activate')
            </h3>
        </div>
        <div class="page-content" style="border-top: 1px solid #e5e5e5;">
            <div class="container p-8">
                @if($errorCode == \App\Helper\_ApiCode::SUCCESS)
                    <p>@lang('message.userActivate.content1')</p>
                    <p>@lang('message.userActivate.content2')
                        <a href="{!! route('frontend.login') !!}">
                            @lang('message.header.login')</a> @lang('message.userActivate.content3')
                    </p>
                @else
                    <p>@lang('message.userActivate.content1')</p>
                    <p>@lang('message.userActivate.content4')
                        <a href="tel:{!! \Illuminate\Support\Facades\Config::get('app.hotline') !!}"
                            >{!! \Illuminate\Support\Facades\Config::get('app.hotline') !!}</a> 
                            @lang('message.userActivate.content5')</p>
                @endif
            </div>
        </div>
    </div>
@endsection

@section('main-script')

@endsection
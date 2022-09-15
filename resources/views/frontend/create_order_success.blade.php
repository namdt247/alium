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
    @if(Auth::check())
        <section style="border-top: solid 1px #000; border-bottom: solid 1px #000;">
            <div class="container text-center">
                <div class="row">
                    <ul class="nav nav-tabs" id="orderStep" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link" id="tab-step1" data-toggle="tab"
                               href="#orderSuccess"
                               role="tab" aria-controls="content-javascript" aria-selected="false">
                                <span>1</span> @lang('message.order.step1')
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="tab-css" data-toggle="tab"
                               href="#orderSuccess"
                               role="tab" aria-controls="content-css" aria-selected="false">
                                <span>2</span> @lang('message.order.step2')
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" id="tab-step3" data-toggle="tab"
                               href="#orderSuccess"
                               role="tab" aria-controls="content-bootstrap" aria-selected="true">
                                <span>3</span> @lang('message.order.step3')
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </section>
        <div class="clearfix"></div>
        <section class="container">
            <div class="order tab-content my-5">
                <div class="tab-pane fade show active" id="orderSuccess"
                     role="tabpanel" aria-labelledby="tab-step1">
                    <div class="order-success order-success-mobile">
                        <img src="/img/order-success.png" alt="" class="img-success-mobile">
                        <h2 class="py-4 title-step-mobile">@lang('message.createOd.success')</h2>
                        <p class="font-weight-bold">{!! $order->product->prd_name !!} - ID: {!! $order->od_code !!}</p>
                        <p class="status">@lang('message.createOd.success.confirm')</p>
                        <div class="pb-4">
                            <span class="dot"></span>
                            <span class="dot"></span>
                            <span class="dot"></span>
                            <span class="dot"></span>
                            <span class="dot"></span>
                        </div>
                        <a href="{!! route('frontend.order.getList') !!}" class="">
                            @lang('message.createOd.success.detail')
                        </a>
                    </div>
                </div>
            </div>
        </section>
    @else
        <input type="hidden" value="0" id="userLogin">
    @endif
@endsection

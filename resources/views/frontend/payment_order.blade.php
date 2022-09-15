@extends('frontend.layout_master')

@section('main-content')
    <?php $order = $data['order']; ?>
    <?php $countPayment = 0 ?>
    <input type="hidden" name="od_code" value="{!! $order->od_code !!}">
    {!! csrf_field() !!}
    <div class="content">
        <div class="container">
            <div class="row py-4 clearfix d-flex">
                <div class="col-2">
                    <span class="text-dark" style="cursor: pointer;" onclick="window.history.back();">
                        &lt;@lang('message.dtOrder.back')
                    </span>
                </div>
                <div class="col-8 text-center">
                    <h4 style="color:#3e9364;">@lang('message.footer.payment')</h4>
                </div>
            </div>
        </div>
    </div>
    <div class="content">
        <div class="container">
            <div class="payment-order">
                <div class="row pt-4">
                    <div class="col-md-6">
                        <div class="order-info border-0">
                            <div class="info-header px-0 py-4 mb-3 clearfix">
                                <h3>@lang('message.odDeliver.information')</h3>
                            </div>

                            <div class="info-header px-0 clearfix">
                                <h4>{!! $order->product->prd_name !!}</h4>
                            </div>
                            <div class="py-2">
                                <span class="order-id">ID: {!! $order->od_code !!}</span>
                                <span class="order-date float-right"
                                    >@lang('message.odInfo.create'): {!! date('d/m/Y',strtotime($order->created_at)) !!}</span>
                            </div>
                            <div class="order-image d-flex py-2 imageOder">
                                @foreach($order->image as $image)
                                    <div class="order-image-item">
                                        <img class="img img-fluid p-1"
                                             src="{!! \App\Helper\Common::GetThumb($image->img_src) !!}"
                                             alt="@lang('message.odInfo.imgAlt')">
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="order-info border-0">
                            <div class="info-header px-0 py-4 mb-3 clearfix">
                                <h3>@lang('message.odSupplier.information')</h3>
                            </div>
                            <div class="order-supplier order-info border-0">
                                <div class="info-header px-0 clearfix">
                                    <h4 class="float-left">{!! $order->supplier->sp_code !!}</h4>
                                    <div class="float-right text-right">
                                        <p class="header-note">
                                            ({!! $order->supplier->sp_numRate !!} @lang('message.odSupplier.rate'))
                                        </p>
                                        <span>
                                            @if($order->supplier->sp_rate < 1)
                                            @elseif($order->supplier->sp_rate <= 2)
                                                @lang('message.odSupplier.rate1')
                                            @elseif($order->supplier->sp_rate <= 3)
                                                @lang('message.odSupplier.rate2')
                                            @elseif($order->supplier->sp_rate <= 4)
                                                @lang('message.odSupplier.rate3')
                                            @elseif($order->supplier->sp_rate <= 5)
                                                @lang('message.odSupplier.rate4')
                                            @else
                                                @lang('message.odSupplier.rate5')
                                            @endif
                                    &nbsp;
                                            @for($i=1;$i<=5; $i++)
                                                @if($i<=$order->supplier->sp_rate)
                                                    <i class="fa fa-star star-select"></i>
                                                @else
                                                    <i class="fa fa-star"></i>
                                                @endif
                                            @endfor
                                        </span>
                                    </div>
                                </div>
                                <div class="row order-info-inner px-0">
                                    <div class="col-md-3">
                                        <img class="img img-fluid"
                                             src="{!! \App\Helper\Common::GetThumb($order->supplier->sp_avatar) !!}"
                                             alt="{!! $order->supplier->sp_code !!}">
                                    </div>
                                    <div class="col-md-6">
                                        <p class="info-item">
                                            <svg
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    xmlns:xlink="http://www.w3.org/1999/xlink"
                                                    width="20px" height="20px">
                                                <path fill-rule="evenodd" fill="rgb(62, 147, 100)"
                                                      d="M10.000,-0.000 C15.523,-0.000 20.000,4.477 20.000,10.000 C20.000,15.523 15.523,
                                              20.000 10.000,20.000 C4.477,20.000 -0.000,15.523 -0.000,10.000 C-0.000,4.477 4.477,
                                              -0.000 10.000,-0.000 Z"/>
                                            </svg>
                                            &nbsp;&nbsp;
                                            {!! $order->supplier->city->city_name !!}
                                        </p>
                                        <p class="info-item">
                                            <svg
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    xmlns:xlink="http://www.w3.org/1999/xlink"
                                                    width="20px" height="20px">
                                                <path fill-rule="evenodd" fill="rgb(62, 147, 100)"
                                                      d="M10.000,-0.000 C15.523,-0.000 20.000,4.477 20.000,10.000 C20.000,15.523 15.523,
                                              20.000 10.000,20.000 C4.477,20.000 -0.000,15.523 -0.000,10.000 C-0.000,4.477 4.477,
                                              -0.000 10.000,-0.000 Z"/>
                                            </svg>
                                            &nbsp;&nbsp;
                                            {!! $order->supplier->sp_numEmployee !!} @lang('message.odSupplier.worker')
                                        </p>
                                        <p class="info-item">
                                            <svg
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    xmlns:xlink="http://www.w3.org/1999/xlink"
                                                    width="20px" height="20px">
                                                <path fill-rule="evenodd" fill="rgb(62, 147, 100)"
                                                      d="M10.000,-0.000 C15.523,-0.000 20.000,4.477 20.000,10.000 C20.000,15.523 15.523,
                                              20.000 10.000,20.000 C4.477,20.000 -0.000,15.523 -0.000,10.000 C-0.000,4.477 4.477,
                                              -0.000 10.000,-0.000 Z"/>
                                            </svg>
                                            &nbsp;&nbsp;
                                            @foreach($order->suggest as $suggest)
                                                @if($order->od_assigneeTo == $suggest->od_assigneeTo)
                                                    <?php $suggestDetail = unserialize($suggest->od_detail) ?>
                                                    {!! $suggestDetail['time_finish'] !!} @lang('message.odSupplier.day')
                                                @endif
                                            @endforeach
                                        </p>
                                    </div>
                                    <div class="col-md-3 text-center">
                                        <img class="img img-fluid rounded-circle" width="50%" src="/img/user_default.png" alt="">
                                        <p>@lang('message.odSupplier.goldSp')</p>
                                    </div>
                                </div>
                            </div>

                            <div class="order-payment order-info border-0">
                                <div class="info-header px-0 clearfix">
                                    <h4>@lang('message.footer.payment')</h4>
                                </div>
                                <div class="order-info-inner px-0">
                                    <div class="info-item justify-content-between">
                                        <span class="">@lang('message.odInfo.quantity')</span>
                                        <span class="">x{!! $order->od_quantity !!}</span>
                                    </div>
                                    <div class="info-item justify-content-between">
                                        <span>@lang('message.odPayment.price')</span>
                                        <span class="text-danger">
                                            {!! number_format($order->od_priceUnit,0,',','.') !!} 
                                            @lang('message.odPayment.unit')
                                        </span>
                                    </div>
                                    <div class="info-item justify-content-between border-0">
                                        <span>@lang('message.odInfo.form')</span>
                                        <span class="text-danger">
                                            {!! number_format($order->od_templatePrice,0,',','.') !!} 
                                            @lang('message.odPayment.unit')
                                        </span>
                                    </div>
                                    <div class="info-item value-total justify-content-between">
                                        <b>@lang('message.odPayment.amount')</b>
                                        <b class="text-danger">
                                            {!! number_format($order->od_total,0,',','.') !!} 
                                            @lang('message.odPayment.unit')
                                        </b>
                                    </div>
                                    <div class="info-item justify-content-between">
                                        <span>@lang('message.odPayment.amountWithoutVAT')</span>
                                        <span>
                                            {!! number_format($order->od_priceUnit*$order->od_quantity+$order->od_templatePrice ,0,',','.') !!} 
                                            @lang('message.odPayment.unit')
                                        </span>
                                    </div>
                                    <div class="info-item justify-content-between border-0">
                                        <span>@lang('message.odPayment.amountVAT')</span>
                                        @if($order->orderType['bill'])
                                            <span>
                                                {!! number_format(0.1*$order->od_priceUnit*$order->od_quantity,0,',','.') !!} 
                                                @lang('message.odPayment.unit')
                                            </span>
                                        @else
                                            <span>0 @lang('message.odPayment.unit')</span>
                                        @endif
                                    </div>
                                    <div class="info-item value-total justify-content-between">
                                        <b>@lang('message.odPayment.totalPayment')</b>
                                        <b class="text-danger">
                                            {!! number_format($order->od_total,0,',','.') !!} @lang('message.odPayment.unit')
                                        </b>
                                    </div>
                                    <div class="pb-2"></div>
                                    <?php $dal_order = new \App\Http\DAL\DAL_Order(); ?>
                                    <?php $lstPayment = $dal_order->getListPaymentOrder($order->od_id); ?>
                                    <?php $countPayment = count($lstPayment) ?>
                                    @foreach($lstPayment as $key=>$payment)
                                        <div class="info-item value-payment justify-content-between">
                                            <span>@lang('message.odPayment.partPayment') {!! $key+1 !!}</span>
                                            <span>{!! date('d/m/Y',strtotime($payment->created_at)) !!}</span>
                                            <span>
                                                {!! number_format(unserialize($payment->od_detail)['payment'],0,',','.') !!} 
                                                @lang('message.odPayment.unit')
                                            </span>
                                        </div>
                                    @endforeach
                                    <div class="info-item value-total justify-content-between">
                                        <b>@lang('message.odPayment.remainPayment')</b>
                                        <b class="text-danger">
                                            {!! number_format($order->od_total-$order->od_paid,0,',','.') !!} 
                                            @lang('message.odPayment.unit')
                                        </b>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5 offset-1">
                        <div class="order-deliver order-info border-0">
                            <div class="info-header px-0 clearfix">
                                <h3>@lang('message.odDeliver.information')</h3>
                            </div>

                            <div class="order-info-inner px-0">
                                <div class="info-item">
                                    <span class="info-item-name">@lang('message.question.fullName')</span>
                                    <span class="info-item-value">{!! $order->od_name !!}</span>
                                </div>
                                <div class="info-item">
                                    <span class="info-item-name">@lang('message.question.phoneNum')</span>
                                    <span class="info-item-value">{!! $order->od_phone !!}</span>
                                </div>
                                <div class="info-item">
                                    <span class="info-item-name">@lang('message.odDeliver.time')</span>
                                    <span class="info-item-value">{!! date('d/m/Y',strtotime($order->od_requiredDate)) !!}</span>
                                </div>
                                <div class="info-item">
                                    <span class="info-item-name">@lang('message.order.step3.address') *</span>
                                    <span class="info-item-value">{!! $order->od_address !!}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="order-payment payment-method order-info border-0">
                            <div class="info-header px-0 clearfix">
                                <h4>@lang('message.odPayment.methodPay')</h4>
                            </div>
                            <div class="order-info-inner px-0">
                                <ul class="nav justify-content-around">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-toggle="tab" href="#bank">
                                            @lang('message.odPayment.methodBank')
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#cash">
                                            @lang('message.odPayment.methodDirect')
                                        </a>
                                    </li>
                                </ul>

                                <!-- Tab panes -->
                                <div class="tab-content">
                                    <div class="tab-pane container active" id="bank">
                                        <div class="mb-3">
                                            <h4>@lang('message.odPayment.bankInfo')</h4>
                                            <p>@lang('message.odPayment.bankInfo1')</p>
                                            <p>@lang('message.odPayment.bankInfo2')</p>
                                            <p>@lang('message.odPayment.bankInfo3')</p>
                                            <p>@lang('message.odPayment.bankInfo4')</p>
                                        </div>
                                    </div>
                                    <div class="tab-pane container fade" id="cash">
                                        <p>@lang('message.odPayment.office')</p>
                                        <p>@lang('message.footer.address')</p>
                                        <p>@lang('message.odPayment.officePhone')</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5 offset-1 mt-5">
                        <?php $orderContent = unserialize($order->od_content) ?>
                        @if( in_array($order->od_status,[13,19,27]) && $order->od_total-$order->od_paid > 0)
                            <div class="message">
                                <h5>*@lang('message.odPayment.note'):</h5>
                                <p>@lang('message.odPayment.notice1') {!! $countPayment+1 !!} @lang('message.odPayment.notice1Is'):
                                    <span class="text-danger">
                                        {!! number_format($orderContent['payment_expected'.($countPayment+1)],0,',','.') !!} Đ
                                    </span>
                                    @lang('message.odPayment.notice2')</p>
                            </div>
                        @endif
                    </div>
                </div>
                @if(in_array($order->od_status, [13,19,27]) && $order->od_total-$order->od_paid > 0)
                    <div class="row">
                        <div class="col-12">
                            <label class="item-checkbox">
                                <input type="checkbox" class="minimal" name="term" value="1" checked disabled>
                                @lang('message.odPayment.notice3')
                                <?php $cfgSecure = \App\Models\Config::find(103);?>
                                <a class="text-dark" href="{!! route('frontend.policy.getPage',$cfgSecure->cfg_alias) !!}"
                                    >@lang('message.footer.security')</a> &
                                <?php $cfgTerm = \App\Models\Config::find(102); ?>
                                <a class="text-dark" href="{!! route('frontend.policy.getPage',$cfgTerm->cfg_alias) !!}"
                                    >@lang('message.register.rules')</a>
                            </label>
                        </div>
                        <div class="col-md-4">
                            <button class="btn btn-block btnPayment btnPaymentAction">@lang('message.footer.payment')</button>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection


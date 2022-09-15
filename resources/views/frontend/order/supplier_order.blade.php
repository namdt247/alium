@foreach($order->suggest as $suggest)
    @if($order->od_assigneeTo == $suggest->od_assigneeTo)
        <?php $suggestDetail = unserialize($suggest->od_detail) ?>
        <div class="order-supplier order-info">
            <div class="info-header clearfix">
                <h4 class="float-left">
                    @lang('message.odSupplier.information') {!! $order->supplier->sp_code !!}
                </h4>
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
            <div class="row order-info-inner">
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
                        {!! $suggestDetail['time_finish'] !!} @lang('message.odSupplier.day')
                    </p>
                </div>
                <div class="col-md-3 text-center">
                    <img class="img img-fluid rounded-circle" width="50%" src="/img/user_default.png" alt="">
                    <p>@lang('message.odSupplier.goldSp')</p>
                </div>
            </div>
            <div class="order-info-inner">
                <div class="info-item justify-content-between">
                    <span class="">@lang('message.odSupplier.material')</span>
                    <span class="">{!! $suggestDetail['material'] !!}</span>
                </div>
                <div class="info-item justify-content-between">
                    <span>@lang('message.odPayment.price')</span>
                    <span class="text-danger">
                        {!! number_format($suggest->od_priceUnit,0,',','.') !!} @lang('message.odPayment.unit')
                    </span>
                </div>
                <div class="info-item justify-content-between border-0">
                    <span>@lang('message.odInfo.form')</span>
                    <span class="text-danger">
                        {!! number_format($suggestDetail['price_template'],0,',','.') !!} 
                        @lang('message.odPayment.unit')
                    </span>
                </div>
            </div>
        </div>
    @endif
@endforeach
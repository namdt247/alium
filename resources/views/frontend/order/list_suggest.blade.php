@foreach($order->suggest as $suggest)
    <?php $suggestDetail = unserialize($suggest->od_detail) ?>
    <?php $dal_supplier = new \App\Http\DAL\DAL_Supplier(); ?>
    <?php $supplier = $dal_supplier->getDetailSupplier($suggest->od_assigneeTo); ?>
    <div class="order-supplier order-info">
        <div class="info-header clearfix">
            <h4 class="float-left">@lang('message.odSupplier.information') {!! $supplier->sp_code !!}</h4>
            <div class="float-right text-right">
                <p class="header-note">
                    ({!! $supplier->sp_numRate !!} @lang('message.odSupplier.rate'))
                </p>
                <span>
                            @if($supplier->sp_rate < 1)
                    @elseif($supplier->sp_rate <= 2)
                        @lang('message.odSupplier.rate1')
                    @elseif($supplier->sp_rate <= 3)
                        @lang('message.odSupplier.rate2')
                    @elseif($supplier->sp_rate <= 4)
                        @lang('message.odSupplier.rate3')
                    @elseif($supplier->sp_rate <= 5)
                        @lang('message.odSupplier.rate4')
                    @else
                        @lang('message.odSupplier.rate5')
                    @endif
                            &nbsp;
                            @for($i=1;$i<=5; $i++)
                        @if($i<=$supplier->sp_rate)
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
                <img class="img img-fluid" src="{!! \App\Helper\Common::GetThumb($supplier->sp_avatar) !!}"
                     alt="{!! $supplier->sp_name !!}">
            </div>
            <div class="col-md-6">
                <p class="info-item">
                    <svg xmlns="http://www.w3.org/2000/svg"
                         xmlns:xlink="http://www.w3.org/1999/xlink"
                         width="20px" height="20px">
                        <path fill-rule="evenodd" fill="rgb(62, 147, 100)"
                              d="M10.000,-0.000 C15.523,-0.000 20.000,4.477 20.000,10.000 C20.000,15.523 15.523,
                                      20.000 10.000,20.000 C4.477,20.000 -0.000,15.523 -0.000,10.000 C-0.000,4.477 4.477,
                                      -0.000 10.000,-0.000 Z"/>
                    </svg>
                    &nbsp;&nbsp;
                    {!! $supplier->city->city_name !!}
                </p>
                <p class="info-item">
                    <svg xmlns="http://www.w3.org/2000/svg"
                         xmlns:xlink="http://www.w3.org/1999/xlink"
                         width="20px" height="20px">
                        <path fill-rule="evenodd" fill="rgb(62, 147, 100)"
                              d="M10.000,-0.000 C15.523,-0.000 20.000,4.477 20.000,10.000 C20.000,15.523 15.523,
                                      20.000 10.000,20.000 C4.477,20.000 -0.000,15.523 -0.000,10.000 C-0.000,4.477 4.477,
                                      -0.000 10.000,-0.000 Z"/>
                    </svg>
                    &nbsp;&nbsp;
                    {!! $supplier->sp_numEmployee !!} @lang('message.odSupplier.worker')
                </p>
                <p class="info-item">
                    <svg xmlns="http://www.w3.org/2000/svg"
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
                <span class="text-danger">{!! number_format($suggest->od_priceUnit,0,',','.') !!} Đ</span>
            </div>
            <div class="info-item justify-content-between border-0">
                <span>@lang('message.odInfo.form')</span>
                <span class="text-danger">
                            {!! number_format($suggestDetail['price_template'],0,',','.') !!} Đ</span>
            </div>
        </div>
        <div class="rating">
            <button type="button" class="btn btnMoreInfo" data-to="{!! $suggest->od_assigneeTo !!}"
            >@lang('message.listSuggest.moreInfo')</button>
        </div>
        <div class="rating">
            <button type="button" class="btn btnSelectSupplier" data-to="{!! $suggest->od_assigneeTo !!}"
            >@lang('message.home.feature.produce')</button>
        </div>

        <div class="order-info-inner pt-5 supplier-more-info supplier-{!! $suggest->od_assigneeTo !!}"
             style="display: none;">
            <div class="order-require">
                <div class="info-heading">
                    <span>@lang('message.listSuggest.product')</span>
                </div>
                <div class="order-image d-flex mt-4">
                    @foreach(\App\Helper\Common::buildTagArray($suggestDetail['image']) as $image)
                        <div class="order-image-item">
                            <img src="{!! \App\Helper\Common::GetThumb($image,'c1') !!}"
                                 alt="" class="img img-fluid">
                        </div>
                    @endforeach
                </div>
                <div class="info-heading">
                    <span>@lang('message.listSuggest.opinion')</span>
                </div>
                <div class="info-section-content">
                    <div class="d-flex">
                        <div class="text-right pr-3">
                            <b class="d-block rate-name">
                                @if($supplier->sp_rate < 1)
                                    @lang('message.manageOd.rate')
                                @elseif($supplier->sp_rate <= 2)
                                    @lang('message.odSupplier.rate1')
                                @elseif($supplier->sp_rate <= 3)
                                    @lang('message.odSupplier.rate2')
                                @elseif($supplier->sp_rate <= 4)
                                    @lang('message.odSupplier.rate3')
                                @elseif($supplier->sp_rate <= 5)
                                    @lang('message.odSupplier.rate4')
                                @else
                                    @lang('message.odSupplier.rate5')
                                @endif
                            </b>
                            <span class="font-italic rate-number" style="font-size: 0.625rem;">
                                        ({!! $supplier->sp_numRate !!} @lang('message.odSupplier.rate'))</span>
                        </div>
                        <div class="pl-3" style="border-left: 1px solid #c6c6c6;">
                            <b class="d-block">{!! $supplier->sp_rate !!}/5</b>
                            <div class="float-right text-right">
                                        <span>
                                            @for($i=1;$i<=5; $i++)
                                                @if($i<=$supplier->sp_rate)
                                                    <i class="fa fa-star star-select"></i>
                                                @else
                                                    <i class="fa fa-star"></i>
                                                @endif
                                            @endfor
                                        </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="feedback-content">
                </div>

            </div>
        </div>
    </div>
@endforeach
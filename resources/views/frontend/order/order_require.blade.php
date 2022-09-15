<div class="order-info">
    <div class="info-header" id="deliverHeading">
        <button class="btn p-0" type="button" data-toggle="collapse" data-target="#orderContent"
                aria-expanded="true" aria-controls="deliverContent">
            @lang('message.odRequire.odRequire')
        </button>
        <span class="float-right"><i class="fa fa-2x fa-caret-down"></i></span>
    </div>

    <div id="orderContent" class="collapse show order-info-inner" aria-labelledby="deliverHeading">
        <div class="order-image d-flex imageOder">
            @foreach($order->image as $image)
                <div class="order-image-item">
                    <img class="img img-fluid" src="{!! \App\Helper\Common::GetThumb($image->img_src,'c1') !!}"
                         alt="@lang('message.odInfo.imgAlt')" style="max-width: 100%;">
                </div>
            @endforeach
        </div>
        <div class="order-require">
            <div class="info-heading" id="requireHeading">
                <button class="btn p-0" type="button">
                    @lang('message.order.step2.require') *
                </button>
            </div>
            <div id="requireContent">
                <div class="info-section-content">
                    <?php $lstRequire = \App\Http\DAL\DAL_Config::getConfigByLocale(8); ?>
                    @foreach($lstRequire as $key=>$config)
                        @if($key%2==1) <div> @endif
                            <?php $config = (object)$config; ?>
                            <label class="item-checkbox">
                                <input type="checkbox" class="minimal" name="require[]"
                                       value="{!! $config->id !!}" disabled
                                       @foreach($order->requiredType as $requiredType)
                                       @if($requiredType == $config->id) checked @endif @endforeach>
                                @if($config->id == 1)
                                    @lang('message.order.step2.require1')
                                @elseif($config->id == 2)
                                    @lang('message.order.step2.require2')
                                @elseif($config->id == 3)
                                    @lang('message.order.step2.require3')
                                @elseif($config->id == 4)
                                    @lang('message.order.step2.require4')
                                @elseif($config->id == 5)
                                    @lang('message.order.step2.require5')
                                @elseif($config->id == 6)
                                    @lang('message.order.step2.require6')
                                @endif
                            </label>
                            @if($key%2==0 || $key == count($lstRequire)) </div> @endif
                    @endforeach
                </div>
            </div>
            <div class="info-heading">
                <span>@lang('message.odRequire.otherRequire')</span>
                <span class="float-right">@lang('message.odRequire.quality')</span>
            </div>
            <div class="info-section-content">
                <div class="info-other-require">
                    <label class="mr-5">
                        <input type="checkbox" name="other-require" class="minimal" value="4"
                               @if($order->orderType['otherRequire'] >= 4) selected @else disabled @endif>
                        @lang('message.order.step2.otherRequire1')
                    </label>
                    <label class="">
                        <input type="checkbox" name="other-require" class="minimal" value="2"
                               @if($order->orderType['otherRequire']%4 >= 2) selected @else disabled @endif>
                        @lang('message.order.step2.otherRequire2')
                    </label>
                </div>
                <?php $lstQuality = \App\Http\DAL\DAL_Config::getConfigByLocale(7); ?>
                @foreach($lstQuality as $config)
                    <?php $config = (object)$config; ?>
                    @if($config->id == $order->od_quality)
                        <label for="">
                            @if($order->od_quality == 1)
                                @lang('message.order.step2.quality1')
                            @elseif($order->od_quality == 2)
                                @lang('message.order.step2.quality2')
                            @elseif($order->od_quality == 3)
                                @lang('message.order.step2.quality3')
                            @elseif($order->od_quality == 4)
                                @lang('message.order.step2.quality4')
                            @endif
                        </label>
                    @endif
                @endforeach
            </div>
            <textarea class="form-control" name="" id="" cols="30" rows="5" disabled
                placeholder="@lang('message.order.odRequire.note')">{!! $order->od_message !!}
            </textarea>
        </div>
    </div>

</div>
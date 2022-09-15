<div class="order-payment order-info">
    <?php $dal_order = new \App\Http\DAL\DAL_Order(); ?>
    <?php $contentOrder = unserialize($order->od_content) ?>
    <div class="info-header">
        <span class="order-id">@lang('message.odInfo.ID'): {!! $order->od_code !!}</span>
        <span class="order-date float-right">
            @lang('message.odInfo.create'): {!! date('d/m/Y',strtotime($order->created_at)) !!}
        </span>
    </div>
    <div class="order-info-inner">
        <div class="info-item justify-content-between">
            <span class="">@lang('message.odInfo.quantity')</span>
            <span class="">x{!! $order->od_quantity !!}</span>
        </div>
        <div class="info-item justify-content-between">
            <span>@lang('message.odPayment.price')</span>
            <span class="text-danger">
                {!! number_format($order->od_priceUnit,0,',','.') !!} @lang('message.odPayment.unit')
            </span>
        </div>
        <div class="info-item justify-content-between border-0">
            <span>@lang('message.odInfo.form')</span>
            <span class="text-danger">
                {!! number_format($order->od_templatePrice,0,',','.') !!} @lang('message.odPayment.unit')
            </span>
        </div>
        <div class="info-item value-total justify-content-between">
            <b>@lang('message.odPayment.amount')</b>
            <b class="text-danger">
                @if ($contentOrder && isset($contentOrder['price_order']))
                    {!! number_format($contentOrder['price_order'],0,',','.') !!} @lang('message.odPayment.unit')
                @else
                    0 @lang('message.odPayment.unit')
                @endif
            </b>
        </div>
        <div class="info-item justify-content-between">
            <span>@lang('message.odPayment.amountWithoutVAT')</span>
            <span>
                @if ($contentOrder && isset($contentOrder['price_order']))
                    {!! number_format($contentOrder['price_order'] ,0,',','.') !!} @lang('message.odPayment.unit')
                @else
                    0 @lang('message.odPayment.unit')
                @endif
            </span>
        </div>
        <div class="info-item justify-content-between border-0">
            <span>@lang('message.odPayment.amountVAT')</span>
            @if($order->orderType['bill'])
                <span>
                    @if ($contentOrder)
                        {!! number_format($contentOrder['price_vat'],0,',','.') !!} @lang('message.odPayment.unit')
                    @else
                        0 @lang('message.odPayment.unit')
                    @endif
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

<div class="order-deliver order-info">
    <div class="info-header" id="deliverHeading">
        <button class="btn p-0" type="button" data-toggle="collapse" data-target="#deliverContent"
                aria-expanded="true" aria-controls="deliverContent">
            @lang('message.odDeliver.information')
        </button>
        <span class="float-right"><i class="fa fa-2x fa-caret-down"></i></span>
    </div>

    <div id="deliverContent" class="collapse show order-info-inner" aria-labelledby="deliverHeading">
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
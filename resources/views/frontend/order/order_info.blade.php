<div class="order-info">
    <div class="info-header">
        <span class="order-id">@lang('message.odInfo.ID'): {!! $order->od_code !!}</span>
        <span class="order-date float-right">
                @lang('message.odInfo.create'): {!! date('d/m/Y',strtotime($order->created_at)) !!}
        </span>
    </div>
    <div  class="order-info-inner pt-0 order-info-new">
        <div class="d-flex align-items-center">
            @if($order->image && count($order->image) > 0)
                <img src="{!! \App\Helper\Common::GetThumb($order->image[0]->img_src,'c1') !!}"
                     alt="@lang('message.odInfo.imgAlt')" class="img img-fluid">
            @else
                <img src="/img/order-template.png" alt="{!! $order->od_code !!}">
            @endif
            <div class="pl-4">
                <h3 class="py-3 order-name">{!! $order->product->prd_name !!}</h3>
                <p class="mb-0">@lang('message.odInfo.quantity')</p>
                <p class="mb-0 text-danger">x {!! $order->od_quantity !!}</p>
            </div>
            <div class="ml-auto order-price">
                <p class="mb-0">@lang('message.odInfo.price')</p>
                <p class="text-danger">{!! number_format($order->od_wantedPrice,0,',','.') !!} Đ</p>
            </div>
        </div>
        <div>
            <div class="clearfix d-flex info-template">
                <span class="ml-auto left">@lang('message.odInfo.form')</span>
                <span class="right">
                    @if($order->orderType['template']) @lang('message.odInfo.yes') 
                    @else @lang('message.odInfo.no') @endif
                </span>
            </div>
            <div class="clearfix d-flex info-template">
                <span class="ml-auto left">@lang('message.odInfo.bill')</span>
                <span class="right">
                    @if($order->orderType['bill']) @lang('message.odInfo.yes') 
                    @else @lang('message.odInfo.no') @endif
                </span>
            </div>
        </div>
    </div>
    <div class="rating">
        <button type="button" class="btn btnCancel">@lang('message.odInfo.cancel')</button>
    </div>
</div>
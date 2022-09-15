@extends('frontend.layout_manage_order')

@section('content-order')
    <?php $order = $data['order']; ?>
    <?php $dal_order = new \App\Http\DAL\DAL_Order(); ?>
    <div class="p-4 clearfix">
        <span class="text-dark" style="cursor: pointer;" onclick="window.history.back();">
            &lt; @lang('message.dtOrder.back')
        </span>
        <span class="float-right text-danger">
            @if(in_array($order->status->stt_id,[9,36]))
                @lang('message.orderStatus.listSt1')
            @elseif(in_array($order->status->stt_id,[10,11]))
                @lang('message.orderStatus.listSt2')
            @elseif($order->status->stt_id == 12)
                @lang('message.orderStatus.listSt3')
            @elseif(in_array($order->status->stt_id,[13,14,19,20,27,28]))
                @lang('message.orderStatus.listSt4')
            @elseif($order->status->stt_id == 15)
                @lang('message.orderStatus.listSt5')
            @elseif(in_array($order->status->stt_id,[16,18]))
                @lang('message.orderStatus.listSt6')
            @elseif($order->status->stt_id == 17)
                @lang('message.orderStatus.listSt7')
            @elseif(in_array($order->status->stt_id,[21,22,23,24,25,26,35]))
                @lang('message.orderStatus.listSt8')
            @elseif(in_array($order->status->stt_id,[29,30,31,32]))
                @lang('message.orderStatus.listSt9')
            @elseif($order->status->stt_id == 33)
                @lang('message.orderStatus.listSt10')
            @elseif($order->status->stt_id == 34)
                @lang('message.orderStatus.listSt11')
            @endif
        </span>
    </div>
    <div class="finish-order order-item">
        @include('frontend.order.timeline_status')

        <input type="hidden" class="od_code" name="od_code" value="{!! $order->od_code !!}">
        <input type="hidden" class="od_name" name="od_name" value="{!! $order->product->prd_name !!}">
        <input type="hidden" class="od_status" name="od_status" value="{!! $order->status->stt_valueF !!}">
        {!! csrf_field() !!}
        @if(in_array($order->status->stt_parent,[1,2]))
        @include('frontend.order.order_info',[$order])
        @else
        @include('frontend.order.order_payment',[$order])
        @endif

        @include('frontend.order.order_require',[$order])

        @include('frontend.order.order_deliver',[$order])

        @if($order->od_status == 12)
            @include('frontend.order.list_suggest',[$order])
        @endif

        @if(in_array($order->status->stt_parent,[3,4,5,6,7]))
            @include('frontend.order.supplier_order',[$order])
        @endif

        @if($order->od_status == 13)
            <div class="order-info">
                <div class="reorder">
                        <a href="{!! route('frontend.order.getPayment',$order->od_code) !!}"
                           class="btn btnPayment">@lang('message.dtOrder.payment') 1</a>
                </div>
            </div>
        @elseif($order->od_status == 19 && $order->od_total-$order->od_paid > 0)
            <div class="order-info">
                <div class="reorder">
                    <a href="{!! route('frontend.order.getPayment',$order->od_code) !!}"
                       class="btn btnPayment">@lang('message.dtOrder.payment') 2</a>
                </div>
            </div>
        @elseif($order->od_status == 27 && $order->od_total-$order->od_paid > 0)
            <div class="order-info">
                <div class="reorder">
                    <a href="{!! route('frontend.order.getPayment',$order->od_code) !!}"
                       class="btn btnPayment">@lang('message.dtOrder.payment') 3</a>
                </div>
            </div>
        @elseif($order->od_status == 29)
            <div class="order-feedback order-info">
                <div class="reorder">
                    <a href="{!! route('frontend.order.getReceived',$order->od_code) !!}"
                       class="btn btnFinish">@lang('message.dtOrder.receive')</a>
                </div>
            </div>
        @elseif($order->status->stt_parent == 7)
            @include('frontend.order.feedback_form',[$order])
        @endif
    </div>
@endsection

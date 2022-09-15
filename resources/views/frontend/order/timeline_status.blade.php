<?php $dal_order = new \App\Http\DAL\DAL_Order(); ?>
<?php $lstStatus = $dal_order->getListOrderStatusShow(); ?>
<div class="list-status d-flex">
    @foreach($lstStatus as $status)
   
    <div class="status-item">
        @if($order->status->stt_parent >= $status->stt_id)
            <img src="/img/status-pass.png" alt="{!! $status->stt_valueF !!}">
        @else
            <img src="/img/status-not-pass.png" alt="{!! $status->stt_valueF !!}">
        @endif
        <p class="status-name">
            @if($status->stt_id == 1)
                @lang('message.orderStatus.listSt12')
            @elseif($status->stt_id == 2)
                @lang('message.orderStatus.listSt2')
            @elseif($status->stt_id == 3)
                @lang('message.orderStatus.listSt4')
            @elseif($status->stt_id == 4)
                @lang('message.orderStatus.listSt5')
            @elseif($status->stt_id == 5)
                @lang('message.orderStatus.listSt8')
            @elseif($status->stt_id == 6)
                @lang('message.orderStatus.listSt9')
            @elseif($status->stt_id == 7)
                @lang('message.orderStatus.listSt13')
            @endif
        </p>
        @if($order->od_status >= $status->stt_id)
            <?php $order = $data['order']; ?>
            <?php $orderStatus = $dal_order->getChangeSttOrder($order->od_id,$status->stt_id) ?>
            @if($orderStatus)
                <p class="status-time">{!! date('d/m/Y',strtotime($orderStatus->created_at)) !!}</p>
            @endif
        @else

        @endif

    </div>
    @endforeach
</div>
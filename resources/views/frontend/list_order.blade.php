@extends('frontend.layout_manage_order')

@section('content-order')
    <div class="btnStatus">
        @if($data['sidebar'] == 1)
        <a @if($data['tab'] == 0) class="active" @endif
           href="{!! route('frontend.order.getList') !!}">@lang('message.manageOd.all')</a>
        <a @if($data['tab'] == 1) class="active" @endif
            href="{!! route('frontend.order.getList',['filter'=>'1,2']) !!}">
            @lang('message.forgotPass.confirm')</a>
        <a @if($data['tab'] == 3) class="active" @endif
            href="{!! route('frontend.order.getList',['filter'=>'3']) !!}">
            @lang('message.manageOd.paying')</a>
        <a @if($data['tab'] == 4) class="active" @endif
            href="{!! route('frontend.order.getList',['filter'=>'4,5,6']) !!}">
            @lang('message.manageOd.producing')</a>
        @elseif($data['sidebar'] == 2)
            <a @if($data['tab'] == 0) class="active" @endif
            href="{!! route('frontend.order.getHistory') !!}">@lang('message.manageOd.all')</a>
            <a @if($data['tab'] == 7) class="active" @endif
            href="{!! route('frontend.order.getHistory',['filter'=>7]) !!}">@lang('message.manageOd.finish')</a>
            <a @if($data['tab'] == 8) class="active" @endif
            href="{!! route('frontend.order.getHistory',['filter'=>8]) !!}">@lang('message.manageOd.cancel')</a>
        @endif
    </div>
    <div class="order-list">
        @foreach($data['lstOrder'] as $order)
            <div class="order-item">
                <input type="hidden" class="od_code" value="{!! $order->od_code !!}">
                <input type="hidden" class="od_name" value="{!! $order->product->prd_name !!}">
                <input type="hidden" class="od_status" value="{!! $order->status->stt_valueF !!}">
                <div class="clearfix info1">
                    <span class="order-id">@lang('message.odInfo.ID'): {!! $order->od_code !!}</span>
                    <span> | </span>
                    <span class="order-date">
                        @lang('message.odInfo.create'): {!! date('d/m/Y',strtotime($order->created_at)) !!}
                    </span>
                    <span class="order-status">
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
                    @if($order->od_status == 3)
                        <?php $timeStart = strtotime($order->updated_at) ?>
                        <?php $timeCurrent = time(); ?>
                        <?php $timeLeft = 48 - floor(($timeCurrent-$timeStart)/(60*60)) ?>
                        <?php if ($timeLeft < 0) $timeLeft = 0 ?>
                        <span class="float-right"><i class="fa fa-clock-o"></i>
                            {!! $timeLeft !!} @lang('message.manageOd.hours')
                        </span>
                    @endif
                    @if(in_array($order->od_status,[6,9,11]))
                        <span class="float-right"><i class="fa fa-clock-o"></i>
                            @lang('message.manageOd.confirmPayment')
                        </span>
                    @endif
                </div>
                <div class="clearfix info2 row">
                    <div class="col-sm-3 order-image img img-fluid">
                        @if($order->image && count($order->image) > 0)
                            <img src="{!! \App\Helper\Common::GetThumb($order->image[0]->img_src, 'c1') !!}"
                                alt="@lang('message.odInfo.imgAlt')" class="img img-fluid">
                        @else
                            <img src="/img/order-template.png" alt="@lang('message.odInfo.imgAlt')" 
                                class="img img-fluid">
                        @endif
                    </div>
                    <div class="col-sm-6">
                        <h4>{!! $order->product->prd_name !!}</h4>
                        <div class="item-info">
                            <span>@lang('message.odInfo.quantity')</span>
                            <span class="float-right">
                                {!! $order->od_quantity !!} @lang('message.manageOd.unit')
                            </span>
                        </div>
                        <div class="item-info">
                            <span>@lang('message.manageOd.price')</span>
                            <span class="float-right text-danger">
                                {!! number_format($order->od_wantedPrice,0,',','.') !!} 
                                @lang('message.odPayment.unit')
                            </span>
                        </div>
                    </div>
                    <?php $dal_order = new \App\Http\DAL\DAL_Order();?>
                    <div class="col-sm-3 pl-5 pull-right">
                        <a href="{!! route('frontend.order.getDetail',$order->od_code) !!}" class="btn">
                            @lang('message.manageOd.seeDetail')
                        </a>
                        @if(in_array($order->status->stt_parent,[1,2,3,4,5,6]))
                            <a href="#" class="btn cancelOrder">
                                @lang('message.odInfo.cancel')
                            </a>
                        @endif
                        @if($order->od_status == 29)
                            <a href="{!! route('frontend.order.getReceived',$order->od_code) !!}"
                               class="btn">@lang('message.manageOd.receive')</a>
                        @endif
                        @if($order->status->stt_parent == 7 && !$dal_order->checkUserRateOrder($order->od_id))
                            <a href="{!! route('frontend.order.getDetail',$order->od_code) !!}"
                               class="btn">@lang('message.manageOd.rate')</a>
                        @endif
                        @if($order->od_status == 12)
                            <a href="{!! route('frontend.order.getDetail',$order->od_code) !!}"
                               class="btn btnAction">@lang('message.manageOd.selectSp')</a>
                        @endif
                        @if(in_array($order->od_status,[13,19,27]) && $order->od_total-$order->od_paid > 0 )
                            <a href="{!! route('frontend.order.getPayment',$order->od_code) !!}"
                               class="btn btnAction">@lang('message.footer.payment')</a>
                        @endif
                        @if(in_array($order->status->stt_parent,[7]))
                            <a href="{!! route('frontend.order.getReorder',$order->od_code) !!}"
                               class="btn btnAction btnReorder">@lang('message.feedback.reproduce')</a>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
        {!! $data['lstOrder']->appends(['filter' => $data['tab']])->links() !!}
    </div>
@endsection

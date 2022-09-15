<h2>Gán xưởng</h2>
<div class="row">
    @for($key=0; $key<3; $key++)
        @if($order->suggest_uMake && count($order->suggest_uMake) > $key)
            <?php $orderDetail = $order->suggest_uMake[$key] ?>
            <?php $detailValue = unserialize($orderDetail->od_detail) ?>
            <div class="col-md-4">
                <div class="box box-danger sp-option">
                    <div class="box-header">
                        <label class="box-title">
                            <input type="radio" name="supplier" value="{!! $key+1 !!}" data-id="{!! $key+1 !!}"
                                   class="pull-right flat-red supplier">
                            Xưởng {!! $key+1 !!}
                        </label>
                    </div>
                    <div class="box-body" id="supplier{!! $key+1 !!}">
                        <div class="form-group">
                            <label for="">Chọn Xưởng</label>
                            <select class="form-control supplier-select" name="sltSuplier{!! $key+1 !!}" readonly required>
                                <option value="{!! $orderDetail->od_assigneeTo !!}" selected>
                                    {!! $orderDetail->supplier->sp_code !!} - {!! $orderDetail->supplier->sp_name !!}
                                </option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Giá đề xuất</label>
                            <div class="input-group">
                                <span class="input-group-addon">VND</span>
                                <input type="text" class="form-control price price-unit" name="txtPriceUnit{!! $key+1 !!}"
                                       value="{!! $price[$key]['price_unit'] !!}"
                                       required>
                            </div><!-- /input-group -->
                        </div>
                        @if($order->orderType['template'])
                            <div class="form-group">
                                <label for="">Thời gian lên mẫu(ngày)</label>
                                <input type="number" class="form-control" name="txtTimeTemplate{!! $key+1 !!}"
                                       value="{!! $detailValue['time_template'] !!}" required>
                            </div>
                        @endif
                        <div class="form-group">
                            <label for="">Thời gian hoàn thành(ngày)</label>
                            <input type="number" class="form-control" name="txtTimeFinish{!! $key+1 !!}"
                                   @if((int)$detailValue['time_finish'] < 15) value="{!! $detailValue['time_finish'] !!}"
                                   @else value="{!! $detailValue['time_finish'] + 2 !!}" @endif required>
                        </div>
                        <div class="form-group">
                            <label for="">Chất liệu đề xuất</label>
                            <input type="text" class="form-control" name="txtMaterial{!! $key+1 !!}"
                                   value="{!! $detailValue['material'] !!}">
                        </div>
                        @if($order->orderType['template'])
                            <div class="form-group">
                                <label for="">Giá lên mẫu:</label>
                                <div class="input-group">
                                    <span class="input-group-addon">VND</span>
                                    <input type="text" class="form-control price priceTemplate"
                                           name="txtPriceTemplate{!! $key+1 !!}"
                                           value="{!! $detailValue['price_template'] !!}" >
                                </div>
                            </div>
                        @endif
                        <div class="form-group">
                            <label for="">Số tiền thanh toán lần 1:</label>
                            <div class="input-group">
                                <span class="input-group-addon">VND</span>
                                <input type="text" class="form-control price pricePayment pricePayment1" required
                                       name="payment{!! $key+1 !!}1" value="{!! $price[$key]['payment1'] !!}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="">Số tiền thanh toán lần 2:</label>
                            <div class="input-group">
                                <span class="input-group-addon">VND</span>
                                <input type="text" class="form-control price pricePayment priceTemplate pricePayment2"
                                       name="payment{!! $key+1 !!}2" value="{!! $price[$key]['payment2'] !!}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="">Số tiền thanh toán lần 3:</label>
                            <div class="input-group">
                                <span class="input-group-addon">VND</span>
                                <input type="text" class="form-control price pricePayment pricePayment3"
                                       name="payment{!! $key+1 !!}3" value="{!! $price[$key]['payment3'] !!}">
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>
        @endif
    @endfor
</div>
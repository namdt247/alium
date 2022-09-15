<h2>Thông tin xưởng đã được đề xuất</h2>
<div class="row">
    @foreach($order->suggest_uMake as $key=>$orderDetail)
        <?php $detailValue = unserialize($orderDetail->od_detail) ?>
        <div class="col-md-4">
            <div class="box box-danger sp-option">
                <div class="box-header">
                    <label class="box-title">
                        Xưởng {!! $key+1 !!}
                    </label>
                </div>
                <div class="box-body">
                    <div class="form-group">
                        <label for="">Tên xưởng</label>
                        <select class="form-control" disabled>
                            <option value="{!! $orderDetail->od_assigneeTo !!}" selected>
                                {!! $orderDetail->supplier->sp_code !!} - {!! $orderDetail->supplier->sp_name !!}
                            </option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Giá đề xuất</label>
                        <div class="input-group">
                            <span class="input-group-addon">VND</span>
                            <input type="text" class="form-control price" readonly
                                   value="{!! $orderDetail->od_priceUnit !!}">
                        </div><!-- /input-group -->
                    </div>
                    @if($order->orderType['template'])
                        <div class="form-group">
                            <label for="">Thời gian lên mẫu(ngày)</label>
                            <input type="number" class="form-control" name="txtTimeTemplate{!! $key+1 !!}"
                                   readonly
                                   value="{!! $detailValue['time_template'] !!}" required>
                        </div>
                    @endif
                    <div class="form-group">
                        <label for="">Thời gian hoàn thành(ngày)</label>
                        <input type="number" class="form-control" readonly
                               value="{!! $detailValue['time_finish'] !!}" >
                    </div>
                    <div class="form-group">
                        <label for="">Chất liệu đề xuất</label>
                        <input type="text" class="form-control" readonly
                               value="{!! $detailValue['material'] !!}">
                    </div>
                    @if($order->orderType['template'])
                        <div class="form-group">
                            <label for="">Giá lên mẫu:</label>
                            <div class="input-group">
                                <span class="input-group-addon">VND</span>
                                <input type="text" class="form-control price" readonly
                                       value="{!! $detailValue['price_template'] !!}" >
                            </div>
                        </div>
                    @endif
                    <div class="form-group">
                        <label for="">Số tiền thanh toán lần 1:</label>
                        <div class="input-group">
                            <span class="input-group-addon">VND</span>
                            <input type="text" class="form-control price" readonly
                                   value="{!! $detailValue['payment1'] !!}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="">Số tiền thanh toán lần 2:</label>
                        <div class="input-group">
                            <span class="input-group-addon">VND</span>
                            <input type="text" class="form-control price" readonly
                                   value="{!! $detailValue['payment2'] !!}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="">Số tiền thanh toán lần 3:</label>
                        <div class="input-group">
                            <span class="input-group-addon">VND</span>
                            <input type="text" class="form-control price" readonly
                                   value="{!! $detailValue['payment3'] !!}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="">Ghi chú</label>
                        <textarea cols="30" class="form-control" rows="5" readonly
                        >{!! $detailValue['note'] !!}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="">Ảnh đính kèm:</label>
                        <div class="clearfix">
                            @if(isset($detailValue['image']))
                                @foreach(\App\Helper\Common::buildTagArray($detailValue['image']) as $image)
                                    <div class="img-container">
                                        <img src="{!! \App\Helper\Common::GetThumb($image,'c1') !!}" alt=""
                                             class="img img-responsive">
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
                <!-- /.box-body -->
            </div>
        </div>
    @endforeach
</div>
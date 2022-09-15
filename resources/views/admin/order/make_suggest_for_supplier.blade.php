<h2>Gán xưởng</h2>
<div class="row">
    @for($key=0; $key<3; $key++)
        @if($order->suggest && count($order->suggest) > $key)
            <?php $orderDetail = $order->suggest[$key] ?>
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
                            <select class="form-control supplier-select" name="sltSuplier{!! $key+1 !!}" required>
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
                                       value="{!! $orderDetail->od_priceUnit !!}" required>
                            </div><!-- /input-group -->
                        </div>
                        <div class="form-group">
                            <label for="">Thời gian lên mẫu(ngày)</label>
                            <input type="number" class="form-control" name="txtTimeTemplate{!! $key+1 !!}"
                                   value="{!! $detailValue['time_template'] !!}" required>
                        </div>
                        <div class="form-group">
                            <label for="">Thời gian hoàn thành đơn hàng(ngày)</label>
                            <input type="number" class="form-control" name="txtTimeFinish{!! $key+1 !!}"
                                   value="{!! $detailValue['time_finish'] !!}" required>
                        </div>
                        <div class="form-group">
                            <label for="">Chất liệu đề xuất</label>
                            <input type="text" class="form-control" name="txtMaterial{!! $key+1 !!}"
                                   value="{!! $detailValue['material'] !!}">
                        </div>
                        <div class="form-group">
                            <label for="">Giá lên mẫu:</label>
                            <div class="input-group">
                                <span class="input-group-addon">VND</span>
                                <input type="text" class="form-control price priceTemplate"
                                       name="txtPriceTemplate{!! $key+1 !!}"
                                       value="{!! $detailValue['price_template'] !!}" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="">Số tiền thanh toán lần 1:</label>
                            <div class="input-group">
                                <span class="input-group-addon">VND</span>
                                <input type="text" class="form-control price pricePayment pricePayment1"
                                       name="payment{!! $key+1 !!}1" value="{!! $detailValue['payment1'] !!}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="">Số tiền thanh toán lần 2:</label>
                            <div class="input-group">
                                <span class="input-group-addon">VND</span>
                                <input type="text" class="form-control price pricePayment priceTemplate pricePayment2"
                                       @if(!$order->orderType['template']) readonly @endif
                                       name="payment{!! $key+1 !!}2" value="{!! $detailValue['payment2'] !!}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="">Số tiền thanh toán lần 3:</label>
                            <div class="input-group">
                                <span class="input-group-addon">VND</span>
                                <input type="text" class="form-control price pricePayment pricePayment3"
                                       name="payment{!! $key+1 !!}3" value="{!! $detailValue['payment3'] !!}">
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>
        @else
            <div class="col-md-4">
                <div class="box box-danger sp-option">
                    <div class="box-header">
                        <label class="box-title">
                            <input type="radio" name="supplier" value="1" data-id="1" class="pull-right flat-red supplier">
                            Xưởng {!! $key+1 !!}
                        </label>
                    </div>
                    <div class="box-body" id="supplier{!! $key+1 !!}">
                        <div class="form-group">
                            <label for="">Chọn Xưởng</label>
                            <select class="form-control supplier-select" name="sltSuplier{!! $key+1 !!}" required>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Giá đề xuất</label>
                            <div class="input-group">
                                <span class="input-group-addon">VND</span>
                                <input type="text" class="form-control price price-unit" name="txtPriceUnit{!! $key+1 !!}"
                                       value="{!! old('txtPriceUnit'.($key+1)) !!}" required>
                            </div><!-- /input-group -->
                        </div>
                        @if($order->orderType['template'])
                            <div class="form-group">
                                <label for="">Thời gian lên mẫu(ngày)</label>
                                <input type="number" class="form-control" name="txtTimeTemplate{!! $key+1 !!}"
                                       value="{!! old('txtTimeTemplate'.($key+1)) !!}" required>
                            </div>
                        @endif
                        <div class="form-group">
                            <label for="">Thời gian hoàn thành đơn hàng(ngày)</label>
                            <input type="number" class="form-control" name="txtTimeFinish{!! $key+1 !!}"
                                   value="{!! old('txtTimeFinish'.($key+1)) !!}" required>
                        </div>
                        <div class="form-group">
                            <label for="">Chất liệu đề xuất</label>
                            <input type="text" class="form-control" name="txtMaterial{!! $key+1 !!}"
                                   value="{!! old('txtMaterial'.($key+1)) !!}">
                        </div>
                        @if($order->orderType['template'])
                            <div class="form-group">
                                <label for="">Giá lên mẫu:</label>
                                <div class="input-group">
                                    <span class="input-group-addon">VND</span>
                                    <input type="text" class="form-control price priceTemplate"
                                           name="txtPriceTemplate{!! $key+1 !!}" value="1000000">
                                </div>
                            </div>
                        @endif
                        <div class="form-group">
                            <label for="">Số tiền thanh toán lần 1:</label>
                            <div class="input-group">
                                <span class="input-group-addon">VND</span>
                                <input type="text" class="form-control price pricePayment pricePayment1"
                                       name="payment{!! $key+1 !!}1" value="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="">Số tiền thanh toán lần 2:</label>
                            <div class="input-group">
                                <span class="input-group-addon">VND</span>
                                <input type="text" class="form-control price pricePayment priceTemplate pricePayment2"
                                       @if(!$order->orderType['template']) disabled @endif
                                       name="payment{!! $key+1 !!}2" value="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="">Số tiền thanh toán lần 3:</label>
                            <div class="input-group">
                                <span class="input-group-addon">VND</span>
                                <input type="text" class="form-control price pricePayment pricePayment3" disabled
                                       name="payment{!! $key+1 !!}3" value="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="">Ghi chú</label>
                            <textarea name="note{!! $key+1 !!}" cols="30" class="form-control" rows="5"
                            >-Thời gian sản xuất không bao gồm ngày lễ và chủ nhật&#10;</textarea>
                        </div>
                        <div class="form-group">
                            <label for="imgFeature">Ảnh đính kèm:</label>
                            <br>
                            <div class="gallery gallery{!! $key+1 !!} clearfix"></div>
                            <label class="btn btn-default" style="margin-top: 10px;">
                                Browse
                                <input type="file" class="file hidden" data-target="div.gallery{!! $key+1 !!}"
                                       name="imageOrder{!! $key+1 !!}[]" multiple>
                            </label>
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>
        @endif
    @endfor
</div>
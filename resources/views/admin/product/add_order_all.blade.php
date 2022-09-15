<?php
/**
 * Created by PhpStorm.
 * User: QuanVH
 * Date: 01/11/2016
 * Time: 23:07 CH
 */
        ?>
@extends('admin.layout_master')

@section('main-header')
    <h1>Đơn hàng <small>thêm mới</small></h1>
@endsection

@section('main-content')
    <form role="form" method="post" id="frmOrder" enctype="multipart/form-data">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="sltUser">Chọn Khách hàng (<span class="text-danger">*</span>)</label>
                    <select class="user-select form-control" id="customer-id" name="sltUser" required>
                        <option value="0"> --- Chọn khách hàng --- </option>
                    </select>
                    <p class="text-danger error-detail" style="display: none;"></p>
                </div>
                <div class="box box-danger">
                    <div class="box-header">
                        <h3 class="box-title"><strong>Xác minh thông tin nhận hàng</strong></h3>
                    </div>
                    <div class="box-body" id="customer-info">
                        <div class="form-group">
                            <label>Email (<span class="text-danger">*</span>)</label>
                            <input class="form-control customer-email" type="email" name="txtEmail" required
                                   placeholder="contact@alium.vn" value="{!! old('txtEmail') !!}"/>
                        </div>
                        <div class="form-group">
                            <label>Họ tên (<span class="text-danger">*</span>)</label>
                            <input class="form-control customer-name" type="text" name="txtName" required
                                   placeholder="họ và tên" value="{!! old('txtName') !!}"/>
                        </div>
                        <div class="form-group">
                            <label>Thời gian nhận hàng (<span class="text-danger">*</span>)</label>
                            <div class="input-group date">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" class="form-control pull-right customer-date" required
                                       value="{!! old('txtDate') !!}" name="txtDate">
                            </div>
                        </div>
                        <div class="form-group">
                            <label>SDT (<span class="text-danger">*</span>)</label>
                            <input class="form-control customer-phone" type="number" required name="txtPhone"
                                   minlength="9" placeholder="0987654321" value="{!! old('txtPhone') !!}"/>
                        </div>
                        <div class="form-group">
                            <label>Quốc gia (<span class="text-danger">*</span>)</label>
                            <select class="form-control customer-country" name="sltCountry" required>
                                <?php $dal_user = new \App\Http\DAL\DAL_User(); ?>
                                <?php $lstCountry = $dal_user->getListCountry(); ?>
                                <option value="0"> --- Chọn quốc gia --- </option>
                                @foreach($lstCountry as $country)
                                    <option value="{!! $country->cty_id !!}"
                                            @if($country->cty_id == old('sltCountry')) selected @endif>
                                        {!! $country->cty_name !!}</option>
                                @endforeach
                            </select>
                            <p class="text-danger error-detail" style="display: none;"></p>
                        </div>
                        <div class="form-group">
                            <label>Tỉnh/thành phố (<span class="text-danger">*</span>)</label>
                            <select class="form-control customer-city" name="sltCity">
                                <option value="0"> --- Chọn tỉnh/thành phố --- </option>
                            </select>
                            <p class="text-danger error-detail" style="display: none;"></p>
                        </div>
                        <div class="form-group">
                            <label>Quận/Huyện (<span class="text-danger">*</span>)</label>
                            <select class="form-control customer-district" name="sltDistrict" required>
                                <option value="0"> --- Chọn quận/huyện --- </option>
                            </select>
                            <p class="text-danger error-detail" style="display: none;"></p>
                        </div>
                        <div class="form-group">
                            <label>Địa chỉ nhận hàng (<span class="text-danger">*</span>)</label>
                            <input class="form-control customer-address" type="text" name="txtAddress" required
                                   placeholder="Địa chỉ" value="{!! old('txtAddress') !!}"/>
                        </div>
                        <div class="form-group">
                            <label>Postal code</label>
                            <input class="form-control customer-code" name="txtCode" type="number"
                                   placeholder="10000"/>
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>
            <div class="col-md-6">
                <div class="box box-danger">
                    <div class="box-header">
                        <h3 class="box-title"><strong>Thông tin đơn hàng</strong></h3>
                    </div>
                    <div class="box-body" id="order-detail">
                        <div class="form-group">
                            <label>Dòng sản phẩm (<span class="text-danger">*</span>)</label>
                            <select class="form-control order-product select2" name="sltProduct">
                                <option value="0">--- Chọn dòng sản phẩm ---</option>
                                <?php $dal_product = new \App\Http\DAL\DAL_Product(); ?>
                                <?php $lstProduct = $dal_product->getListProductByCate([1]); ?>
                                @foreach($lstProduct as $product)
                                    <option value="{!! $product->prd_id !!}"
                                            @if($product->prd_id == old('sltProduct')) selected @endif>
                                        {!! $product->prd_name !!}</option>
                                @endforeach
                            </select>
                            <p class="text-danger error-detail" style="display: none;"></p>
                        </div>
                        <div class="form-group">
                            <label for="imgFeature">Ảnh khách hàng tải lên:</label>
                            <br>
                            <div class="gallery clearfix"></div>
                            <label class="btn btn-default" style="margin-top: 10px;">
                                Browse
                                <input type="file" class="hidden" id="file" name="imageOrder[]" multiple>
                            </label>
                        </div>
                        <div class="form-group">
                            <label for="">Số lượng(<span class="text-danger">*</span>)</label>
                            <input type="number" class="form-control size sizeTotal" name="sizeTotal" placeholder="20" min="20">
                        </div>
                        <div class="form-group number-size hidden">
                            <label for="">Số lượng/size (<span class="text-danger">*</span>)</label>
                            <div class="input-group">
                                <span class="input-group-addon" >XS</span>
                                <input type="number" class="form-control size sizeXS" name="sizeXS" placeholder="10">
                            </div><br>
                            <div class="input-group">
                                <span class="input-group-addon" >S</span>
                                <input type="number" class="form-control size sizeS" name="sizeS" placeholder="10">
                            </div><br>
                            <div class="input-group">
                                <span class="input-group-addon" >M</span>
                                <input type="number" class="form-control size sizeM" name="sizeM" placeholder="10">
                            </div><br>
                            <div class="input-group">
                                <span class="input-group-addon" >L</span>
                                <input type="number" class="form-control size sizeL"  name="sizeL" placeholder="10">
                            </div><br>
                            <div class="input-group">
                                <span class="input-group-addon" >XL</span>
                                <input type="number" class="form-control size sizeXL"  name="sizeXL" placeholder="10">
                            </div>
                        </div>
                        <p class="text-danger error-detail" style="display: none;"></p>
                        <div class="form-group">
                            <label>Chất lượng (<span class="text-danger">*</span>)</label>
                            <select class="form-control select2 order-quanlity" name="sltQuality" required>
                                <?php $lstQuality = \App\Http\DAL\DAL_Config::getConfigByLocale(7); ?>
                                @foreach($lstQuality as $config)
                                    <?php $config = (object)$config; ?>
                                    <option value="{!! $config->id !!}">{!! $config->name !!}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Giá mong muốn</label>
                            <div class="input-group">
                                <span class="input-group-addon">VND</span>
                                <input type="text" class="form-control price" name="txtPrice" aria-label="...">
                            </div><!-- /input-group -->
                        </div>
                        <div class="form-group">
                            <label>Yêu cầu (<span class="text-danger">*</span>)</label>
                            <select class="form-control select2 order-require" name="sltRequire[]" required multiple>
                                <?php $lstRequire = \App\Http\DAL\DAL_Config::getConfigByLocale(8); ?>
                                @foreach($lstRequire as $config)
                                    <?php $config = (object)$config; ?>
                                    <option value="{!! $config->id !!}">{!! $config->name !!}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Yêu cầu khác cho xưởng</label>
                            <?php $config = \App\Http\DAL\DAL_Config::getConfigByLocale(9); ?>
                            <input type="checkbox" class="order-other" value="1" name="rdOther"
                                   data-toggle="toggle" data-on="{!! $config[1]['name'] !!}" data-off="{!! $config[2]['name'] !!}">
                        </div>
                        <div class="form-group">
                            <label>Hóa đơn đỏ</label>
                            <input type="checkbox" class="order-bill" value="1" name="rdBill"
                                   data-toggle="toggle" data-on="Có" data-off="Không">
                        </div>
                        <div class="form-group">
                            <label>Mẫu sống</label>
                            <input type="checkbox" class="" value="1" name="liveTemplate"
                                   data-toggle="toggle" data-on="Có" data-off="Không">
                        </div>
                        <div class="form-group">
                            <label>Lên mẫu</label>
                            <input type="checkbox" class="order-template" value="1" name="rdTemplate"
                                   data-toggle="toggle" data-on="Có" data-off="Không">
                        </div>
                        <div class="form-group">
                            <label>Lưu ý từ khách hàng: </label>
                            <textarea cols="3" class="form-control order-note" name="txtMessage"></textarea>
                        </div>

                    </div>
                    <!-- /.box-body -->
                </div>
            </div>
        </div>

        <h2>Gán xưởng</h2>
        <div class="row">
            <div class="col-md-4">
                <div class="box box-danger sp-option">
                    <div class="box-header">
                        <label class="box-title">
                            <input type="radio" name="supplier" value="1" data-id="1" class="pull-right flat-red supplier">
                            Xưởng 1
                        </label>
                    </div>
                    <div class="box-body" id="supplier1">
                        <div class="form-group">
                            <label for="">Chọn Xưởng</label>
                            <select class="form-control supplier-select" name="sltSuplier1" required>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Giá đề xuất</label>
                            <div class="input-group">
                                <span class="input-group-addon">VND</span>
                                <input type="text" class="form-control price price-unit" name="txtPriceUnit1"
                                       value="{!! old('txtPriceUnit1') !!}" required>
                            </div><!-- /input-group -->
                        </div>
                        <div class="form-group">
                            <label for="">Thời gian hoàn thành(ngày)</label>
                            <input type="number" class="form-control" name="txtTimeFinish1"
                                   value="{!! old('txtTimeFinish1') !!}" required>
                        </div>
                        <div class="form-group">
                            <label for="">Chất liệu đề xuất</label>
                            <input type="text" class="form-control" name="txtMaterial1"
                                   value="{!! old('txtMaterial1') !!}">
                        </div>
                        <div class="form-group">
                            <label for="">Giá lên mẫu:</label>
                            <div class="input-group">
                                <span class="input-group-addon">VND</span>
                                <input type="text" class="form-control price"
                                       name="txtPriceTemplate1" value="1000000">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="">Số tiền thanh toán lần 1:</label>
                            <div class="input-group">
                                <span class="input-group-addon">VND</span>
                                <input type="text" class="form-control price pricePayment pricePayment1"
                                       name="payment11" value="{!! old('payment11') !!}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="">Số tiền thanh toán lần 2:</label>
                            <div class="input-group">
                                <span class="input-group-addon">VND</span>
                                <input type="text" class="form-control price pricePayment pricePayment2"
                                       disabled name="payment12" value="{!! old('payment12') !!}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="">Số tiền thanh toán lần 3:</label>
                            <div class="input-group">
                                <span class="input-group-addon">VND</span>
                                <input type="text" class="form-control price pricePayment pricePayment3"
                                       name="payment13" value="{!! old('payment13') !!}">
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>
            <div class="col-md-4">
                <div class="box box-danger sp-option">
                    <div class="box-header">
                        <label class="box-title">
                            <input type="radio" name="supplier" value="2" data-id="2" class="pull-right flat-red supplier">
                            Xưởng 2
                        </label>
                    </div>
                    <div class="box-body" id="supplier2">
                        <div class="form-group">
                            <label for="">Chọn Xưởng</label>
                            <select class="form-control supplier-select" name="sltSuplier2" required>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Giá đề xuất</label>
                            <div class="input-group">
                                <span class="input-group-addon">VND</span>
                                <input type="text" class="form-control price price-unit" name="txtPriceUnit2"
                                       value="{!! old('txtPriceUnit2') !!}" required>
                            </div><!-- /input-group -->
                        </div>
                        <div class="form-group">
                            <label for="">Thời gian hoàn thành(ngày)</label>
                            <input type="number" class="form-control" name="txtTimeFinish2"
                                   value="{!! old('txtTimeFinish2') !!}" required>
                        </div>
                        <div class="form-group">
                            <label for="">Chất liệu đề xuất</label>
                            <input type="text" class="form-control" name="txtMaterial2"
                                   value="{!! old('txtMaterial2') !!}">
                        </div>
                        <div class="form-group">
                            <label for="">Giá lên mẫu:</label>
                            <div class="input-group">
                                <span class="input-group-addon">VND</span>
                                <input type="text" class="form-control price priceTemplate"
                                       name="txtPriceTemplate2" value="1000000" disabled>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="">Số tiền thanh toán lần 1:</label>
                            <div class="input-group">
                                <span class="input-group-addon">VND</span>
                                <input type="text" class="form-control price pricePayment pricePayment1"
                                       name="payment21" value="{!! old('payment11') !!}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="">Số tiền thanh toán lần 2:</label>
                            <div class="input-group">
                                <span class="input-group-addon">VND</span>
                                <input type="text" class="form-control price pricePayment priceTemplate pricePayment2"
                                       disabled name="payment22" value="{!! old('payment12') !!}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="">Số tiền thanh toán lần 3:</label>
                            <div class="input-group">
                                <span class="input-group-addon">VND</span>
                                <input type="text" class="form-control price pricePayment pricePayment3" disabled
                                       name="payment23" value="{!! old('payment23') !!}">
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>
            <div class="col-md-4">
                <div class="box box-danger sp-option">
                    <div class="box-header">
                        <label class="box-title">
                            <input type="radio" name="supplier" value="3" data-id="3" class="pull-right flat-red supplier">
                            Xưởng 3
                        </label>
                    </div>
                    <div class="box-body" id="supplier3">
                        <div class="form-group">
                            <label for="">Chọn Xưởng</label>
                            <select class="form-control supplier-select" name="sltSuplier3" required>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Giá đề xuất</label>
                            <div class="input-group">
                                <span class="input-group-addon">VND</span>
                                <input type="text" class="form-control price price-unit" name="txtPriceUnit3"
                                       value="{!! old('txtPriceUnit3') !!}" required>
                            </div><!-- /input-group -->
                        </div>
                        <div class="form-group">
                            <label for="">Thời gian hoàn thành(ngày)</label>
                            <input type="number" class="form-control" name="txtTimeFinish3"
                                   value="{!! old('txtTimeFinish3') !!}" required>
                        </div>
                        <div class="form-group">
                            <label for="">Chất liệu đề xuất</label>
                            <input type="text" class="form-control" name="txtMaterial3"
                                   value="{!! old('txtMaterial3') !!}">
                        </div>
                        <div class="form-group">
                            <label for="">Giá lên mẫu:</label>
                            <div class="input-group">
                                <span class="input-group-addon">VND</span>
                                <input type="text" class="form-control price priceTemplate"
                                       name="txtPriceTemplate3" value="1000000" disabled>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="">Số tiền thanh toán lần 1:</label>
                            <div class="input-group">
                                <span class="input-group-addon">VND</span>
                                <input type="text" class="form-control price pricePayment pricePayment1"
                                       name="payment31" value="{!! old('payment31') !!}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="">Số tiền thanh toán lần 2:</label>
                            <div class="input-group">
                                <span class="input-group-addon">VND</span>
                                <input type="text" class="form-control price pricePayment priceTemplate pricePayment2"
                                       disabled name="payment32" value="{!! old('payment32') !!}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="">Số tiền thanh toán lần 3:</label>
                            <div class="input-group">
                                <span class="input-group-addon">VND</span>
                                <input type="text" class="form-control price pricePayment pricePayment3" disabled
                                       name="payment33" value="{!! old('payment33') !!}">
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>
        </div>

        <div class="form-group">
            <label>Trạng thái đơn hàng</label>
            <select class="form-control select2" id="order-status" name="sltStatus">
                <?php $lstStatus = \App\Models\Order_status::where('stt_parent',0)->with('sub_status')->get(); ?>
                @foreach($lstStatus as $status)
                    <option value="{!! $status->stt_id !!}" disabled>{!! $status->stt_valueA !!}</option>
                        @foreach($status->sub_status as $stt)
                            <option value="{!! $stt->stt_id !!}">--- {!! $stt->stt_valueA !!}</option>
                        @endforeach
                @endforeach
            </select>
            <p class="text-danger error-detail" style="display: none;"></p>
        </div>

        <div class="row" id="order-payment">
            <div class="col-md-6">
                <div class="box box-danger">
                    <div class="box-header">
                        <h3 class="box-title text-red">Giá trị đơn hàng</h3>
                        <p>Chọn xưởng để cập nhật giá trị đơn hàng</p>
                    </div>
                    <div class="box-body" id="order-price">
                        <div class="form-group">
                            <label for="">
                                Số lượng sản phẩm:
                                <span class="numTotal">0</span> chiếc
                            </label>
                        </div>
                        <div class="form-group">
                            <label for="">Giá/sản phẩm:
                            <span class="price-unit">0</span> VND/chiếc</label>
                        </div>
                        <div class="form-group hidden">
                            <label for="">Lên mẫu:</label>
                            <div class="input-group">
                                <span class="input-group-addon">VND</span>
                                <input type="text" class="form-control price priceTemplate"
                                       name="txtPriceTemplate" value="{!! old('txtPriceTemplate') !!}" disabled>
                            </div>
                        </div>
                        <div class="form-group">
                            <h4 class="text-red" for="">
                                Tổng tiền cần thanh toán:
                                <span class="priceTotal">0</span> VND
                            </h4>
                        </div>
                        <div class="form-group">
                            <label for="">Đã thanh toán:</label>
                            <div class="input-group">
                                <span class="input-group-addon">VND</span>
                                <input type="text" class="form-control price" name="txtPaid" value="{!! old('txtPaid') !!}">
                            </div>
                        </div>

                    </div>
                    <!-- /.box-body -->
                </div>
            </div>
            <div class="col-md-6">
                <div class="box box-danger">
                    <div class="box-header">
                        <h3 class="box-title">Thanh toán</h3>
                    </div>
                    <div class="box-body">
                        <div class="form-group">
                            <label for="">Phương thức thanh toán</label>
                            <select class="form-control select2" name="sltPaymentMethod">
                                <?php $lstPaymentMethod = \App\Http\DAL\DAL_Config::getConfigByLocale(10); ?>
                                @foreach($lstPaymentMethod as $config)
                                    <?php $config = (object)$config; ?>
                                    <option value="{!! $config->id !!}">{!! $config->name !!}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Ghi chú:</label>
                            <textarea cols="3" class="form-control" name="txtNote">{!! old('txtNote') !!}</textarea>
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>
        </div>
        <hr>

        <div class="row">
            <div class="col-md-6">
                <button class="btn btn-block btn-primary" type="submit">Tạo mới</button>
            </div>
            <div class="col-md-6">
                <button class="btn btn-block btn-primary" type="button" onclick="goBack()">Hủy</button>
            </div>
        </div>

    </form>
@endsection

@section('main-script')
    <script type="text/javascript" src="/js/admin/admin_order.js"></script>
@endsection
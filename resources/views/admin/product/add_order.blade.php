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
                                <?php $lstProduct = $dal_product->getListProductPublic(); ?>
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
                                <input type="file" class="hidden file" name="imageOrder[]" multiple>
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
                                    <option value="{!! $config->id !!}" selected>{!! $config->name !!}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Yêu cầu khác cho xưởng</label>
                            <select class="form-control select2 order-require" name="rdOther[]" multiple
                                    style="width: 100% !important;">
                                <option value="4" >In</option>
                                <option value="2">Thêu</option>
                            </select>
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
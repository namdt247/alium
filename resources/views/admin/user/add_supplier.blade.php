<?php
$dal_product = new \App\Http\DAL\DAL_Product();
$lstProduct = $dal_product->getListProductPublic();
?>

@extends('admin.layout_master')

@section('main-header')
    <h1>Danh mục sản phẩm <small>thêm mới</small></h1>
@endsection


@section('main-content')
    <style itemscope>
        .license label {
            padding: 5px 0;
        }
        .license .iradio_square {
            margin-bottom: 8px;
        }
        .license input[type='text'] {
            margin-top: -8px;
        }
        #txtOtherLicense {
            width: auto; min-width: 300px;
        }
    </style>
    <form action="" method="POST" enctype="multipart/form-data" id="supplierForm">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Tên xưởng (<span class="text-danger">*</span>)</label>
                    <input class="form-control" type="text" name="txtName" required
                           placeholder="tên nhà xưởng" value="{!! old('txtName') !!}"/>
                </div>
                <div class="form-group">
                    <label>SDT xưởng(<span class="text-danger">*</span>)</label>
                    <input class="form-control" type="tel" name="txtPhone" required
                           placeholder="0987654321" value="{!! old('txtPhone') !!}"/>
                    <label for="supplier" class="text-danger"></label>
                    <br>
                    <button type="button" class="supplierCheck btn btn-primary">Kiểm tra</button>
                </div>
                <div class="form-group">
                    <label>Email xưởng</label>
                    <input class="form-control" type="email" name="txtEmail"
                           placeholder="contact@alium.vn" value="{!! old('txtEmail') !!}"/>
                </div>
                <div class="form-group">
                    <label>SDT người phụ trách</label>
                    <input class="form-control" type="tel" name="phonePersonal" 
                           placeholder="0987654321" value=""/>
                </div>
                <div class="form-group">
                    <label>Email người phụ trách</label>
                    <input class="form-control" type="email" name="emailPersonal"
                           placeholder="contact@alium.vn" value=""/>
                </div>
                <div class="form-group">
                    <label>Số CMND</label>
                    <input class="form-control" type="tel" name="numIDCard"
                           placeholder="123456789" value=""/>
                </div>
                <div class="form-group">
                    <label for="idCardImg">Ảnh CMND</label>
                    <br>
                    <img class="img-responsive" alt="" src="" id="_imgFeature2" style="display: none;" width="320">
                    <label class="btn btn-default" style="margin-top: 10px;">
                        Browse
                        <input type="file" class="hidden" id="imgFeature2" name="idCardImg">
                    </label>
                </div>
                <div class="form-group">
                    <label>Địa chỉ (<span class="text-danger">*</span>)</label>
                    <input class="form-control" type="text" name="txtAddress" required
                           placeholder="Địa chỉ" value="{!! old('txtAddress') !!}"/>
                </div>
                <div class="form-group">
                    <label>Tỉnh/thành phố</label>
                    <select class="city-select form-control" name="sltCity">
                        <?php $dal_user = new \App\Http\DAL\DAL_User(); ?>
                        <?php $lstCity = $dal_user->getListCity(245); ?>
                        <option value="0"> --- Tỉnh/thành phố --- </option>
                        @foreach($lstCity as $city)
                            <option value="{!! $city->city_id !!}" @if($city->city_id == old('sltCity')) selected @endif>
                                {!! $city->city_name !!}</option>
                        @endforeach
                    </select>

                </div>
                <div class="form-group">
                    <label>Số lượng nhân công</label>
                    <input type="number" class="form-control" name="txtNumEmployee"
                           required placeholder="100" step="1">
                </div>
                <div class="form-group">
                    <label>Số lượng nhận sản xuất tối thiểu (<span class="text-danger">*</span>)</label>
                    <input class="form-control" type="number" name="txtMinQuantity" required
                           placeholder="100" value="{!! old('txtMinQuantity') !!}"/>
                </div>
                <div class="form-group">
                    <label>Số lượng nhận sản xuất tối đa (<span class="text-danger">*</span>)</label>
                    <input class="form-control" type="number" name="txtMaxQuantity" required
                           placeholder="1000" value="{!! old('txtMaxQuantity') !!}"/>
                </div>

                <div class="box box-danger">
                    <div class="box-header">
                        <h3 class="box-title">Sản phẩm chuyên làm (<span class="text-danger">*</span>)</h3>
                    </div>
                    <div class="box-body">
                        <div class="form-group">
                            <select class="supplier-select form-control" name="sltProduct[]" multiple="multiple"
                                    style="width: 100%;" >
                                @foreach($lstProduct as $product)
                                    <option value="{!! $product->prd_id !!}">{!! $product->prd_name !!}</option>
                                @endforeach
                            </select>
                            <label>Sản phẩm khác:</label>
                            <input type="text" class="form-control" name="txtOtherProduct" placeholder="...">
                        </div>
                        <!-- /.form group -->

                    </div>
                    <!-- /.box-body -->
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="imgFeature">Ảnh đại diện</label>
                    <br>
                    <img class="img-responsive" alt="" src="" id="_imgFeature" style="display: none;" width="320">
                    <label class="btn btn-default" style="margin-top: 10px;">
                        Browse
                        <input type="file" class="hidden" id="imgFeature" name="imgFeature">
                    </label>
                </div>
                <div class="form-group">
                    <label>Phân loại xưởng</label>
                    <select class="form-control select2" name="sltQuanlity">
                        <?php $lstType = \App\Http\DAL\DAL_Config::getConfigByLocale(4); ?>
                        @foreach($lstType as $config)
                            <?php $config = (object)$config; ?>
                            <option value="{!! $config->id !!}">{!! $config->name !!}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Nhận đơn hàng</label>
                    <select class="form-control select2" name="sltOrderQuanlity[]" multiple="multiple" required>
                        <?php $lstQuanlity = \App\Http\DAL\DAL_Config::getConfigByLocale(3); ?>
                        @foreach($lstQuanlity as $key=>$config)
                            <?php $config = (object)$config; ?>
                            <option value="{!! $config->id !!}">{!! $config->name !!}</option>
                        @endforeach
                    </select>
                </div>
                <div class="box box-danger">
                    <div class="box-header">
                        <h3 class="box-title">Giấy phép kinh doanh (<span class="text-danger">*</span>)</h3>
                    </div>
                    <div class="box-body">
                        <?php $lstLicense = \App\Http\DAL\DAL_Config::getConfigByLocale(5); ?>
                        <div class="form-group license">
                            <?php end($lstLicense); ?>
                            <?php $lastElementKey = key($lstLicense);?>
                            <?php reset($lstLicense);?>
                            <?php $firstElementKey = key($lstLicense);?>
                            @foreach($lstLicense as $key=>$config)
                                <?php $config = (object)$config; ?>
                                @if($key == $lastElementKey)
                                    <label style="float:left;">
                                        <input type="radio" name="license" class="minimal" value="{!! $config->id !!}"
                                               id="lastLicense"> {!! $config->name !!} &nbsp;
                                    </label>
                                    <input type="text" class="form-control hidden" name="txtOtherLicense"
                                           disabled id="txtOtherLicense" placeholder="...">
                                @else
                                    <label>
                                        <input type="radio" name="license" class="minimal" value="{!! $config->id !!}"
                                            @if($key == $firstElementKey) checked @endif>
                                        {!! $config->name !!}
                                    </label>
                                @endif
                                <br>
                            @endforeach

                        </div>
                        <br>
                        <label for="businessLiImg">Ảnh giấy phép kinh doanh</label>
                        <br>
                        <img class="img-responsive" alt="" src="" id="_imgFeature3" style="display: none;" width="320">
                        <label class="btn btn-default" style="margin-top: 10px;">
                            Browse
                        <input type="file" class="hidden" id="imgFeature3" name="businessLiImg">
                        </label>
                        <!-- /.form group -->
                    </div>
                    <!-- /.box-body -->
                </div>
                <div class="form-group">
                    <label for="imgFeature">Ảnh sản phẩm:</label>
                    <br>
                    <div class="gallery clearfix"></div>
                    <label class="btn btn-default" style="margin-top: 10px;">
                        Browse
                        <input type="file" class="hidden file" name="imageProduct[]" multiple>
                    </label>
                </div>
{{--                <div class="form-group">--}}
{{--                    <label for="">Tài khoản ngân hàng</label>--}}
{{--                    <textarea name="bankAccount" class="form-control" id="" cols="30" rows="5"></textarea>--}}
{{--                </div>--}}
                <div class="form-group">
                    <label for="">Báo giá cho đơn hàng</label>
                    <select class="order-select form-control" name="sltOrder">
                        <?php $dal_order = new \App\Http\DAL\DAL_Order(); ?>
                        <?php $lstOrder = $dal_order->getListOrderSupplier() ?>
                        <option value="0"> --- Mã đơn hàng --- </option>
                        @foreach($lstOrder as $orderSupplier)
                            <option value="{!! $orderSupplier->od_id !!}"
                            >{!! $orderSupplier->od_code !!}</option>
                        @endforeach
                    </select>
                    <label for="">Giá báo</label>
                    <div class="input-group">
                        <span class="input-group-addon">VND</span>
                        <input type="text" class="form-control price" name="txtPriceUnit"
                               value="{!! old('txtPriceUnit') !!}">
                    </div><!-- /input-group -->
                </div>
                {{-- AddOrder --}}
                {{-- <div id="fieldGroup" class="fieldGroup"></div>
                <div class="form-group">
                    <label for="addMore"></label>
                    <button type="button" id="addMore" class="btn btn-primary">Thêm đơn hàng</button>
                </div> --}}
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Thêm mới</button>
    </form>
@endsection

@section('main-script')
    <script>
        $(document).ready(function () {
            $("#supplierForm").validate({
            });

            $('.supplier-select').select2({
                closeOnSelect: false,
                allowClear: true
            });
            $('.order-select').select2();
            $('.city-select').select2();
            $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
                checkboxClass: 'icheckbox_square',
                radioClass   : 'iradio_square',
                increaseArea: '20%'
            });
            $('#lastLicense').on('ifChecked', function(event){
                $("#txtOtherLicense").removeClass('hidden').removeAttr("disabled").focus();
            }).on('ifUnchecked', function(event){
                $("#txtOtherLicense").addClass('hidden').attr("disabled", "disabled");
            });
            $("button.supplierCheck").click(function (evt) {
                evt.preventDefault();
                let phone = $("input[name='txtPhone']").val();
                $.ajax({
                    url: "/admin/user/check-supplier/" + phone,
                    method: 'get'
                }).done(function (data) {
                    if(parseInt(data) === 200) $("label[for='supplier']").html('SDT đã dùng đăng ký xưởng');
                    else $("label[for='supplier']").html('SDT chưa từng đăng ký xưởng')
                });
            });

            initFilePreview();

            // ** AddOrder **
            // var i=1;
            // $('#addMore').click(function(){
            //     $('#fieldGroup').append('<div id ="order'+i+'" class="box box-danger box-body" name="orderProduct['+i+']"><label for="">Dòng sản phẩm</label><select class="form-control" style="width: 100%;" name="nameProduct['+i+']" >@foreach($lstProduct as $product)<option value="{!! $product->prd_id !!}">{!! $product->prd_name !!}</option>@endforeach</select><br><label for="">Ảnh</label><br><div class="gallery clearfix"></div><label class="btn btn-default" style="margin-top: 10px;">Browse<input type="file" class="hidden file" name="imgProduct'+i+'[]" multiple></label><br><br><label>Số lượng</label><input class="form-control" type="number" name="quantityProduct['+i+']" required placeholder="100"/><br><label>Chất lượng</label><select class="form-control" name="qualityProduct['+i+']"><?php $lstQuanlity = \App\Http\DAL\DAL_Config::getConfigByLocale(3); ?>@foreach($lstQuanlity as $key=>$config)<?php $config = (object)$config; ?><option value="{!! $config->id !!}">{!! $config->name !!}</option>@endforeach</select><br><label for="">Giá sản xuất</label><div class="input-group"><span class="input-group-addon">VND</span><input type="number" class="form-control price" name="priceProduct['+i+']"></div><br><button type="button" id="'+i+'" class="btn btn-primary btn_remove">Xóa</button></div><input class="hidden" name="quantityOrder" value="'+i+'">');
            //     i++;
            // });
            // $(document).on('click', '.btn_remove', function(){
            //     var button_id = $(this).attr("id");
            //     $('#order'+button_id+'').remove();
            // });
        });
    </script>
@endsection
@extends('admin.layout_master')

@section('main-header')
    <h1>Danh mục sản phẩm <small>chỉnh sửa</small></h1>
@endsection

@section('main-content')
    <?php
    $dal_product = new \App\Http\DAL\DAL_Product();
    $lstProduct = $dal_product->getListProductPublic();
    ?>

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
    <form action="" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="lbId" value="{!! $supply->sp_id !!}">

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Tên xưởng (<span class="text-danger">*</span>)</label>
                    <input class="form-control" type="text" name="txtName" required
                           placeholder="tên nhà xưởng" value="{!! $supply->sp_name !!}"/>
                </div>
                <div class="form-group">
                    <label>SDT xưởng(<span class="text-danger">*</span>)</label>
                    <input class="form-control" type="tel" name="txtPhone" required disabled
                           placeholder="0987654321" value="{!! $supply->sp_phone !!}"/>
                </div>
                <div class="form-group">
                    <label>Email xưởng</label>
                    <input class="form-control" type="email" name="txtEmail" disabled
                           placeholder="contact@alium.vn" value="{!! $supply->sp_email !!}"/>
                </div>
                @foreach($supply->sp_detail as $detail)
                    <?php $detailValue = $detail->sp_detail ?>
                    @if($detail->sp_name=='phonePersonal')
                        <div class="form-group">
                            <label>{!! $detailValue['title'] !!}</label>
                            <input class="form-control" type="tel" name="phonePersonal" 
                                placeholder="0987654321" 
                                value="{!! $detailValue['value'] !!}"/>
                        </div>
                    @endif 
                @endforeach
                @foreach($supply->sp_detail as $detail)
                    <?php $detailValue = $detail->sp_detail ?>
                    @if($detail->sp_name=='emailPersonal')    
                        <div class="form-group">
                            <label>{!! $detailValue['title'] !!}</label>
                            <input class="form-control" type="email" name="emailPersonal"
                                placeholder="contact@alium.vn" value="{!! $detailValue['value'] !!}"/>
                        </div>
                    @endif 
                @endforeach    
                @foreach($supply->sp_detail as $detail)
                    <?php $detailValue = $detail->sp_detail ?>
                    @if($detail->sp_name=='numIDCard')
                        <div class="form-group">
                            <label>{!! $detailValue['title'] !!}</label>
                            <input class="form-control" type="tel" name="numIDCard"
                                placeholder="123456789" value="{!! $detailValue['value'] !!}"/>
                        </div>
                    @endif 
                @endforeach
                @foreach($supply->sp_detail as $detail)
                    <?php $detailValue = $detail->sp_detail ?>
                    @if($detail->sp_name=='idCardImg')
                        <div class="form-group">
                            <label for="idCardImg">{!! $detailValue['title'] !!}</label>
                            <br>
                            <img class="img-responsive" alt="" 
                                src="{!! \App\Helper\Common::GetThumb($detailValue['value']) !!}" width="320">
                            <label class="btn btn-default" style="margin-top: 10px;">
                                Browse
                                <input type="file" class="hidden" id="idCardImg" name="idCardImg">
                            </label>
                        </div>
                    @endif 
                @endforeach
                <div class="form-group">
                    <label>Địa chỉ (<span class="text-danger">*</span>)</label>
                    <input class="form-control" type="text" name="txtAddress" required
                           placeholder="Địa chỉ" value="{!! $supply->sp_location !!}"/>
                </div>
                <div class="form-group">
                    <label>Tỉnh/thành phố</label>
                    <select class="city-select form-control" name="sltCity">
                        <?php $dal_user = new \App\Http\DAL\DAL_User(); ?>
                        <?php $lstCity = $dal_user->getListCity(245); ?>
                        <option value="0"> --- Tỉnh/thành phố --- </option>
                        @foreach($lstCity as $city)
                            <option value="{!! $city->city_id !!}" @if($city->city_id == $supply->sp_city) selected @endif>
                                {!! $city->city_name !!}</option>
                        @endforeach
                    </select>

                </div>
                <div class="form-group">
                    <label>Số lượng nhân công</label>
                    <input type="number" class="form-control" name="txtNumEmployee"
                           required value="{!! $supply->sp_numEmployee !!}" placeholder="100" step="1">
                </div>
                <div class="form-group">
                    <label>Số lượng nhận sản xuất tối thiểu (<span class="text-danger">*</span>)</label>
                    <input class="form-control" type="number" name="txtMinQuantity" required
                           placeholder="100" value="{!! $supply->sp_minQuantity !!}"/>
                </div>
                <div class="form-group">
                    <label>Số lượng nhận sản xuất tối đa (<span class="text-danger">*</span>)</label>
                    <input class="form-control" type="number" name="txtMaxQuantity" required
                           placeholder="1000" value="{!! $supply->sp_maxQuantity !!}"/>
                </div>

                <div class="box box-danger">
                    <div class="box-header">
                        <h3 class="box-title">Sản phẩm chuyên làm (<span class="text-danger">*</span>)</h3>
                    </div>
                    <div class="box-body">
                        <div class="form-group">
                            <select class="supplier-select form-control select2" name="sltProduct[]"
                                    multiple="multiple" style="width: 100%;" >
                                @foreach($lstProduct as $product)
                                    <option value="{!! $product->prd_id !!}"
                                            @foreach($supply->product as $prd)
                                            @if($product->prd_id == $prd->prd_id) selected @endif
                                            @endforeach >{!! $product->prd_name !!}</option>
                                @endforeach
                            </select>
                            <label>Sản phẩm khác:</label>
                            <input type="text" class="form-control" name="txtOtherProduct" placeholder="..."
                                   value="{!! $supply->sp_otherProduct !!}" />
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
                    <img class="img-responsive" alt="" src="{!! \App\Helper\Common::GetThumb($supply->sp_avatar) !!}"
                         id="_imgFeature" width="320">
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
                            <option value="{!! $config->id !!}"
                                    @if($config->id == $supply->sp_type) selected @endif>{!! $config->name !!}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Nhận đơn hàng</label>
                    <select class="form-control select2" name="sltOrderQuanlity[]" multiple="multiple">
                        <?php $lstQuanlity = \App\Http\DAL\DAL_Config::getConfigByLocale(3); ?>
                        @foreach($lstQuanlity as $config)
                            <?php $config = (object)$config; ?>
                            <option value="{!! $config->id !!}"
                                    @if($config->id == $supply->sp_qualityOrder) selected @endif>{!! $config->name !!}</option>
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
                                           @if($config->id == $supply->sp_licenseId) checked @endif id="lastLicense">
                                            {!! $config->name !!} &nbsp;
                                    </label>
                                    @if($config->id == $supply->sp_licenseId)
                                        <input type="text" class="form-control" style="width: auto;" name="txtOtherLicense"
                                               id="txtOtherLicense" value="{!! $supply->sp_businessLicense !!}">
                                    @else
                                        <input type="text" class="form-control hidden" style="width: auto;"
                                               name="txtOtherLicense" disabled id="txtOtherLicense" placeholder="...">
                                    @endif
                                @else
                                    <label>
                                        <input type="radio" name="license" class="minimal" value="{!! $key !!}"
                                               @if($config->id == $supply->sp_licenseId) checked @endif>
                                        {!! $config->name !!}
                                    </label>
                                @endif
                                <br>
                            @endforeach

                        </div>
                        <br>
                        @foreach($supply->sp_detail as $detail)
                            <?php $detailValue = $detail->sp_detail ?>
                            @if($detail->sp_name=='businessLiImg')
                                <label for="businessLiImg">{!! $detailValue['title'] !!}</label>
                                <br>
                                <img class="img-responsive" alt="" 
                                    src="{!! \App\Helper\Common::GetThumb($detailValue['value']) !!}" width="320">
                                <label class="btn btn-default" style="margin-top: 10px;">
                                    Browse
                                <input type="file" class="hidden" id="businessLiImg" name="businessLiImg">
                                </label>
                            @endif
                        @endforeach
                        <!-- /.form group -->
                    </div>
                    <!-- /.box-body -->
                </div>
                <div class="form-group">
                    <label for="imgFeature">Ảnh sản phẩm:</label>
                    <br>
                    <div class="clearfix">
                        @foreach($supply->image as $key=>$imgSrc)
                            <div class="img-container">
                                <img src="{!! \App\Helper\Common::GetThumb($imgSrc) !!}" alt=""
                                     class="image img" width="240">
                                <div class="middle">
                                    <a class="btn text btn-delete"
                                       href="{!! route('admin.supplier.getDeleteImage',[$supply->sp_id,$key]) !!}">
                                        <i class="fa fa-trash fa-3x"></i>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="gallery clearfix"></div>
                    <label class="btn btn-default" style="margin-top: 10px;">
                        Browse
                        <input type="file" class="hidden file" name="imageProduct[]" multiple>
                    </label>
                </div>
                @foreach($supply->sp_detail as $detail)
                    <?php $detailValue = $detail->sp_detail ?>
                    @if($detail->sp_name=='bankAccount')
                    <div class="form-group">
                        <label for="">{!! $detailValue['title'] !!}</label>
                        <textarea name="{!! $detail->sp_name !!}" id="" cols="30" rows="5" class="form-control"
                            >{!! $detailValue['value'] !!}</textarea>
                    </div>
                    @endif
                @endforeach
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
                {{-- Show Order --}}
                <div id="fieldGroup" class="fieldGroup hidden">
                @foreach($supply->sp_detail as $detail)
                    <?php $detailValue = $detail->sp_detail ?>
                    @if($detail->sp_name=='orderProduct1' || $detail->sp_name=='orderProduct2' ||
                        $detail->sp_name=='orderProduct3' || $detail->sp_name=='orderProduct4' ||
                        $detail->sp_name=='orderProduct5')
                    <div class="box box-danger box-body">
                        <label for="">{!! $detailValue['title1'] !!}</label>
                        <select class="form-control" style="width: 100%;" disabled>
                            @foreach($lstProduct as $product)
                            <option value="{!! $product->prd_id !!}"
                                @if($product->prd_id == $detailValue['value1']) selected @endif>
                                    {!! $product->prd_name !!}</option>
                            @endforeach
                        </select>
                        <br>
                        <div class="clearfix">
                            <label for="">{!! $detailValue['title2'] !!}</label>
                            <br>
                            <?php $imgOrder = explode(",",$detailValue['value2']) ?>
                            @foreach($imgOrder as $key=>$imgSrc)
                                <img class="img-responsive" alt="" 
                                src="{!! \App\Helper\Common::GetThumb($imgSrc) !!}" width="240">
                            @endforeach
                            <label class="btn btn-default" style="margin-top: 10px;" disabled>
                                Browse
                                <input type="file" class="hidden file" disabled/>
                            </label>
                        </div>
                        <br>
                        <label>{!! $detailValue['title3'] !!}</label>
                        <input class="form-control" type="number" name="quantityProduct['+i+']" 
                            placeholder="100" value="{!! $detailValue['value3'] !!}" readonly/>
                        <br>
                        <label>{!! $detailValue['title4'] !!}</label>
                        <select class="form-control" disabled>
                            <?php $lstQuanlity = \App\Http\DAL\DAL_Config::getConfigByLocale(3); ?>
                            @foreach($lstQuanlity as $key=>$config)
                            <?php $config = (object)$config; ?>
                            <option value="{!! $config->id !!}"
                                    @if($config->id == $detailValue['value4']) selected @endif>
                                    {!! $config->name !!}</option>
                            @endforeach
                        </select>
                        <br>
                        <label for="">{!! $detailValue['title5'] !!}</label>
                        <div class="input-group">
                            <span class="input-group-addon">VND</span>
                            <input type="number" class="form-control price" name="priceProduct['+i+']"
                                value="{!! $detailValue['value5'] !!}" readonly/>
                        </div>
                    </div>
                    @endif
                @endforeach
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-warning">Cập nhật</button>
        <button type="reset" class="btn btn-default" onclick="goBack()">Hủy</button>
    </form>

@endsection
@section('main-script')
    <script>
        $(document).ready(function () {
            $("#supplierForm").validate({
            });
            $('.supplier-select').select2({
                closeOnSelect: false,
                allowClear: true,
                tags: true,
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

            initFilePreview();

        });
    </script>
@endsection
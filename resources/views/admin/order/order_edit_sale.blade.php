<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="sltUser">Khách hàng (<span class="text-danger">*</span>)</label>
            <select class="user-select form-control" id="customer-id" name="sltUser" disabled>
                <option value="{!! $order->demander->user_id !!}">
                    {!! $order->demander->user_id. ' - ' .$order->demander->user_showName !!}</option>
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
                           placeholder="contact@alium.vn" value="{!! $order->od_email !!}"/>
                </div>
                <div class="form-group">
                    <label>Họ tên (<span class="text-danger">*</span>)</label>
                    <input class="form-control customer-name" type="text" name="txtName" required
                           placeholder="họ và tên" value="{!! $order->od_name !!}"/>
                </div>
                <div class="form-group">
                    <label>Thời gian nhận hàng (<span class="text-danger">*</span>)</label>
                    <div class="input-group date">
                        <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </div>
                        <input type="text" class="form-control pull-right customer-date" required
                               value="{!! date_format(date_create($order->od_requiredDate),'m/d/Y') !!}" name="txtDate">
                    </div>
                </div>
                <div class="form-group">
                    <label>SDT (<span class="text-danger">*</span>)</label>
                    <input class="form-control customer-phone" type="number" required name="txtPhone"
                           minlength="9" placeholder="0987654321" value="{!! $order->od_phone !!}"/>
                </div>
                <div class="form-group">
                    <label>Quốc gia (<span class="text-danger">*</span>)</label>
                    <select class="form-control customer-country" name="sltCountry" required>
                        <?php $dal_user = new \App\Http\DAL\DAL_User(); ?>
                        <?php $lstCountry = $dal_user->getListCountry(); ?>
                        <option value="0"> --- Chọn quốc gia --- </option>
                        @foreach($lstCountry as $country)
                            <option value="{!! $country->cty_id !!}"
                                    @if($country->cty_id == $order->od_country) selected @endif>
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
                           placeholder="Địa chỉ" value="{!! $order->od_address !!}"/>
                </div>
                <div class="form-group">
                    <label>Postal code</label>
                    <input class="form-control customer-code" name="txtCode" type="number"
                           value="{!! $order->od_postalCode !!}" placeholder="10000"/>
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
                    <label for="">Mã đơn hàng: {!! $order->od_code !!}</label>
                </div>
                <div class="form-group">
                    <label>Dòng sản phẩm (<span class="text-danger">*</span>)</label>
                    <select class="form-control order-product select2" name="sltProduct">
                        <option value="0">--- Chọn dòng sản phẩm ---</option>
                        <?php $dal_product = new \App\Http\DAL\DAL_Product(); ?>
                        <?php $lstProduct = $dal_product->getListProductPublic(); ?>
                        @foreach($lstProduct as $product)
                            <option value="{!! $product->prd_id !!}"
                                    @if($product->prd_id == $order->od_product) selected @endif>
                                {!! $product->prd_name !!}</option>
                        @endforeach
                    </select>
                    <p class="text-danger error-detail" style="display: none;"></p>
                </div>
                <div class="form-group">
                    <label for="imgFeature">Ảnh khách hàng tải lên:</label>
                    <br>
                    <div class="clearfix">
                        @foreach($order->image as $image)
                            <div class="img-container">
                                <img src="{!! \App\Helper\Common::GetThumb($image->img_src,'c1') !!}" alt=""
                                     class="image img img-responsive">
                                <div style="position: absolute; top: 0; right: 0">
                                    <a class="btn btn-delete" style="font-weight: bold; font-size: 18px"
                                       href="{!! route('admin.order.getDeleteImage', $image->img_id) !!}">
                                        &times
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="gallery clearfix"></div>
                    <label class="btn btn-default" style="margin-top: 10px;">
                        Browse
                        <input type="file" class="hidden" id="file" name="imageOrder[]" multiple>
                    </label>
                </div>
                <div class="form-group">
                    <label for="">Số lượng(<span class="text-danger">*</span>)</label>
                    <input type="number" class="form-control size sizeTotal" name="sizeTotal" placeholder="20"
                           value="{!! $order->od_quantity !!}" min="20">
                </div>
                <div class="form-group number-size hidden">
                    <label for="">Số lượng/size (<span class="text-danger">*</span>)</label>
                    <input class="form-control hidden" name="txtTotalNum" type="number"
                           value="{!! $order->od_quantity !!}" placeholder="100"/>
                    @foreach($order->size as $size)
                        <div class="input-group">
                            <span class="input-group-addon" >{!! $size->od_name !!}</span>
                            <input type="number" class="form-control size size{!! $size->od_name !!}"
                                   name="size{!! $size->od_name !!}" placeholder="10"
                                   value="{!! $size->od_quantity !!}">
                        </div><br>
                    @endforeach
                </div>
                <p class="text-danger error-detail" style="display: none;"></p>
                <div class="form-group">
                    <label>Chất lượng (<span class="text-danger">*</span>)</label>
                    <select class="form-control select2 order-quanlity" name="sltQuality" required>
                        <?php $lstQuality = \App\Http\DAL\DAL_Config::getConfigByLocale(7); ?>
                        @foreach($lstQuality as $config)
                            <?php $config = (object)$config; ?>
                            <option value="{!! $config->id !!}"
                                    @if($config->id == $order->od_quality) selected @endif>
                                {!! $config->name !!}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Giá mong muốn</label>
                    <div class="input-group">
                        <span class="input-group-addon">VND</span>
                        <input type="text" class="form-control price" name="txtPrice" aria-label="..."
                               value="{!! $order->od_wantedPrice !!}">
                    </div><!-- /input-group -->
                </div>
                <div class="form-group">
                    <label>Yêu cầu (<span class="text-danger">*</span>)</label>
                    <select class="form-control select2 order-require" name="sltRequire[]" required multiple>
                        <?php $lstRequire = \App\Http\DAL\DAL_Config::getConfigByLocale(8); ?>
                        @foreach($lstRequire as $config)
                            <?php $config = (object)$config; ?>
                            <option value="{!! $config->id !!}"
                                    @foreach($order->requiredType as $requiredType)
                                    @if($requiredType == $config->id) selected @endif @endforeach>
                                {!! $config->name !!}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Yêu cầu khác cho xưởng</label>
                    <select class="form-control select2 order-require" name="rdOther[]" multiple
                            style="width: 100% !important;">
                        <option value="4"
                                @if($order->orderType['otherRequire'] >= 4) selected @endif
                        >In</option>
                        <option value="2"
                                @if($order->orderType['otherRequire'] >= 6) selected @endif
                        >Thêu</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Hóa đơn đỏ</label>
                    <input type="checkbox" class="order-bill" value="1" name="rdBill"
                           @if($order->orderType['bill']) checked @endif
                           data-toggle="toggle" data-on="Có" data-off="Không">
                </div>
                <div class="form-group">
                    <label>Mẫu sống</label>
                    <input type="checkbox" class="" value="1" name="liveTemplate"
                           @if($order->orderType['liveTemplate']) checked @endif
                           data-toggle="toggle" data-on="Có" data-off="Không">
                </div>

                <div class="form-group">
                    <label>Lên mẫu</label>
                    <input type="checkbox" class="order-template" value="1" name="rdTemplate"
                           @if($order->orderType['template']) checked @endif
                           data-toggle="toggle" data-on="Có" data-off="Không">
                </div>
                <div class="form-group">
                    <label>Lưu ý từ khách hàng: </label>
                    <textarea cols="3" rows="7" class="form-control order-note" name="txtMessage"
                    >{!! $order->od_message !!}</textarea>
                </div>

            </div>
            <!-- /.box-body -->
        </div>
    </div>
</div>
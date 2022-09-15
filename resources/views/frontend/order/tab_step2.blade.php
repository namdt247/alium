<div>
    <h3 class="text-dark title-step pb-5 title-step-mobile">@lang('message.order.step2')</h3>
    <div class="row">
        <div class="col-md-5">
            <label class="text-dark item-title"><img src="/img/icon-image.png" alt=""> 
                @lang('message.order.step2.img')
            </label>
            <p class="text-black-50">@lang('message.order.step2.imgFeature')</p>
            <div id="dropzone" class="drop dropzone">
                <input type="file" name="file" class="d-none" multiple />
            </div>
            <p class="error error-image d-none"></p>
        </div>
        <div class="col-md-6 offset-1 step2-content">
            <div class="form-group">
                <p class="text-dark item-title" for="">
                    <img src="/img/icon-quantity.png" alt=""> @lang('message.order.step2.quantity') *
                </p>
                <input class="form-control form-control-lg" type="number"  required min="50"
                       name="totalQuantity"
                       placeholder="@lang('message.order.step2.quantityPlace')">
                <p class="error error-quantity d-none"></p>
            </div>
            <div class="form-group pt-4" id="wanted-price">
                <p class="text-dark item-title" for="">
                    <a class="trigger1">
                    <img src="/img/icon-question.png" alt=""></a> @lang('message.order.step2.price') *
                    <div id="popup1" class="popup">
                        <span>@lang('message.order.step2.pricePopup')</span>
                    </div>
                </p>
                <div class="input-group mb-3">
                    <input type="text" class="form-control price" maxlength="17"
                           name="wantedPrice" placeholder="@lang('message.order.step2.pricePlace')">
                    <div class="input-group-append">
                        <span class="input-group-text">@lang('message.odPayment.unit')</span>
                    </div>
                </div>
                <p class="error error-price d-none" style="margin-top: -1rem;"></p>
            </div>
            <div class="form-group pt-4">
                <p class="text-dark item-title">
                    <a class="trigger2">
                        <img src="/img/icon-question.png" alt=""></a>
                        @lang('message.order.step2.otherRequire')
                    <div id="popup2" class="popup">
                        <span>@lang('message.order.step2.otherReqPopup')</span>
                    </div>
                </p>
                <div class="form-group">
                    <label class="pr-3">
                        <input type="checkbox" class="minimal" name="otherRequire[]" value="4">
                        @lang('message.order.step2.otherRequire1')
                    </label>
                    <label class="pr-3">
                        <input type="checkbox" class="minimal" name="otherRequire[]" value="2">
                        @lang('message.order.step2.otherRequire2')
                    </label>
                </div>
            </div>
            <div class="form-group pt-4" id="require-div">
                <p class="text-dark item-title" for="">
                    <a class="trigger3">
                        <img src="/img/icon-question.png" alt=""></a> @lang('message.order.step2.require') *
                    <div id="popup3" class="popup">
                        <span>@lang('message.order.step2.requirePopup')</span>
                    </div>
                </p>
                <div class="" style="display: flex; justify-content: space-between;">
                    <div class="item-checkbox">
                        <label class="">
                            <input type="checkbox" class="minimal" name="require[]" value="1" checked>
                                @lang('message.order.step2.require1')
                        </label>
                        <label class="">
                            <input type="checkbox" class="minimal" name="require[]" value="2" checked>
                                @lang('message.order.step2.require2')
                        </label>
                    </div>
                    <div class="item-checkbox">
                        <label class="">
                            <input type="checkbox" class="minimal" name="require[]" value="3" checked>
                                @lang('message.order.step2.require3')
                        </label>
                        <label class="">
                            <input type="checkbox" class="minimal" name="require[]" value="4" checked>
                                @lang('message.order.step2.require4')
                        </label>
                    </div>
                    <div class="item-checkbox">
                        <label class="">
                            <input type="checkbox" class="minimal" name="require[]" value="5" checked>
                                @lang('message.order.step2.require5')
                        </label>
                        <label class="">
                            <input type="checkbox" class="minimal" name="require[]" value="6" checked>
                                @lang('message.order.step2.require6')
                        </label>
                    </div>
                </div>
                <p class="error error-require d-none"></p>  
            </div>
            <div class="form-group pt-4">
                <p class="text-dark item-title" for="">
                    <a class="trigger4">
                        <img src="/img/icon-question.png" alt=""></a> @lang('message.order.step2.quality') *
                    <div id="popup4" class="popup">
                        <span>@lang('message.order.step2.qualityPopup')</span>
                    </div>
                </p>
                <div class="form-group" style="display: flex; justify-content: space-between;">
                    <label>
                        <input type="radio" name="quality" value="1" class="minimal"
                            >@lang('message.order.step2.quality1')
                    </label>
                    <label>
                        <input type="radio" name="quality" value="2" class="minimal"
                            checked >@lang('message.order.step2.quality2')
                    </label>
                    <label>
                        <input type="radio" name="quality" value="3" class="minimal"
                            >@lang('message.order.step2.quality3')
                    </label>
                    <label>
                        <input type="radio" name="quality" value="4" class="minimal"
                            >@lang('message.order.step2.quality4')
                    </label>
                </div>
            </div>
            <div class="form-group pt-4">
                <p class="text-dark item-title" for="">
                    <img src="/img/icon-note.png" alt=""> @lang('message.order.step2.note')
                </p>
                <textarea name="note" id="note" cols="30" rows="3" class="form-control"
                          placeholder="@lang('message.order.step2.notePlace')"></textarea>
            </div>
            <div class="form-group pt-4 other-require">
                <label class="">
                    <input type="checkbox" class="minimal" name="liveTemplate" value="1">
                    @lang('message.order.step2.requireCheckBox1')
                </label>
                <label class="">
                    <?php $contentSecurity = \App\Http\DAL\DAL_Config::getConfig(102);?>
                    <input type="checkbox" class="minimal" name="sample" value="1">
                    @lang('message.order.step2.requireCheckBox2a')
                        <a href="{!! route('frontend.policy.getPage',$contentSecurity->cfg_alias) !!}"
                            target="_blank">@lang('message.order.step2.requireCheckBox2b')</a>
                    @lang('message.order.step2.requireCheckBox2c')
                </label>
                <label class="">
                    <input type="checkbox" class="minimal" name="bill" value="1">
                    @lang('message.order.step2.requireCheckBox3')
                </label>
            </div>
            <button type="button" class="btn btn-block btnStep2" disabled
                style="padding: .75rem; color: white; background-color: #3e9364; text-transform: uppercase;">
                @lang('message.order.step2.continue')
            </button>
        </div>
    </div>
</div>

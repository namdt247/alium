<div>
    <h3 class="title-step-mobile pb-4">@lang('message.order.step3.confirm')</h3>
    <?php $user = Auth::user(); ?>
    <?php $dal_user = new \App\Http\DAL\DAL_User(); ?>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="">@lang('message.order.step3.email')</label>
                <input class="form-control form-control-lg" type="email" 
                    placeholder="@lang('message.order.step3.emailPlace')" name="email"
                    value="{!! $user->user_email !!}">
                <p class="error error-email d-none"></p>
            </div>
            <div class="form-group">
                <label for="">@lang('message.question.fullName') *</label>
                <input class="form-control form-control-lg"  type="text" 
                    placeholder="@lang('message.order.step3.fullNamelPlace')" name="name"
                    value="{!! $user->user_showName !!}">
                <p class="error error-name d-none"></p>
            </div>
            <div class="form-group" id="phone-element">
                <label for="">@lang('message.question.phoneNum') *</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <button class="btn btn-outline-secondary dropdown-toggle" type="button"
                                data-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false">+84</button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="#">+84</a>
                        </div>
                    </div>
                    <input type="tel" class="form-control form-control-lg" aria-label="số điện thoại"
                           name="phone"
                           value="{!! $user->user_phone !!}">
                </div>
                <p class="error error-phone d-none"></p>
            </div>
            <div class="form-group">
                <label for="">@lang('message.order.step3.time')</label>
                <input class="form-control form-control-lg date" type="text" name="deliverDate" 
                    placeholder="@lang('message.order.step3.timePlace')">
                <p class="error error-deliverDate d-none"></p>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="">@lang('message.order.step3.address') *</label>
                <input class="form-control form-control-lg" type="text" placeholder="@lang('message.order.step3.addressPlace')"
                       name="address" value="{!! $user->user_address !!}">
                <p class="error error-address d-none"></p>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">@lang('message.myAccount.city') *</label>
                        <select  class="form-control form-control-lg city" name="city" id="">
                            <option value="0"> --- @lang('message.order.step3.selectCity') --- </option>
                            @if($user->user_country && $user->user_country > 0)
                                <?php $lstCity = $dal_user->getListCity($user->user_country); ?>
                                @foreach($lstCity as $city)
                                    <option value="{!! $city->city_id !!}"
                                            @if($city->city_id == $user->user_city) selected @endif>
                                        {!! $city->city_name !!}</option>
                                @endforeach
                            @endif
                        </select>
                        <p class="error error-city d-none"></p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">@lang('message.order.step3.district') *</label>
                        <select class="form-control form-control-lg district" name="district" id="">
                            <option value="0"> --- @lang('message.order.step3.selectDistrict') --- </option>
                            @if($user->user_city && $user->user_city > 0)
                                <?php $lstDistrict = $dal_user->getListDistrict($user->user_city); ?>
                                @foreach($lstDistrict as $district)
                                    <option value="{!! $district->dt_id !!}"
                                            @if($district->dt_id == $user->user_district) selected @endif>
                                        {!! $district->dt_name !!}</option>
                                @endforeach
                            @endif
                        </select>
                        <p class="error error-district d-none"></p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">@lang('message.order.step3.postalCode')</label>
                        <input class="form-control form-control-lg" type="text"
                               name="postal" value="{!! $user->user_postalCode !!}"
                               placeholder="@lang('message.order.step3.postalCodePlace')">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">@lang('message.order.step3.money')</label>
                        <input class="form-control form-control-lg" type="text" placeholder="" 
                            value="@lang('message.odPayment.unit')" readonly>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="">@lang('message.order.step3.country')</label>
                <select class="form-control form-control-lg country" name="country" id="">
                    <?php $lstCountry = $dal_user->getListCountry(); ?>
                    <option value="0"> --- Chọn quốc gia --- </option>
                    @foreach($lstCountry as $country)
                        <option value="{!! $country->cty_id !!}"
                                @if($country->cty_id == $user->user_country) selected @endif>
                            {!! $country->cty_name !!}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-block btnStep3" disabled
                    style="padding: .75rem; color: white; background-color: #3e9364; text-transform: uppercase;"
            >@lang('message.order.step3.search')</button>
        </div>
    </div>
</div>

<div class="modal fade" id="registerBothModal" tabindex="" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content register-mobile">
        <div class="modal-body">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <form id="registerSocialForm" method="post" class="content-modal text-left pb-5">
            {!! csrf_field() !!}
            <h2 class="pt-4 header-modal text-center">Thông tin đăng nhập</h2>
            <p class="error d-none error-general">@lang('message.register.errorGeneral')</p>

            {{-- Hidden --}}
            <input type="text" name="id" id="" class="hidden" value="{!! $data->id !!}" style="display:none;">
            <input type="text" name="avatar" id="" class="hidden" value="{!! $data->avatar !!}" style="display:none;">
            <input type="text" name="social" id="" class="hidden" value="{!! $data->social !!}" style="display:none;">

            <input type="email" class="form-control mt-4 mb-2" name="email" id="regEmail" required
                   placeholder="@lang('message.question.email')*" value="{!! $data->email !!}" 
                   @if($data->email) readonly @endif>
            <p class="error d-none error-email">* @lang('message.register.errorEmail')</p>

            <input type="tel" class="form-control mt-4 mb-2" name="phone" id="regPhone" required
                   placeholder="@lang('message.question.phoneNum')*" >
            <p class="error d-none error-phone">* @lang('message.register.errorPhone')</p>

            <input type="text" class="form-control mt-4 mb-2" name="name" id="regName" required
                   placeholder="@lang('message.question.fullName')*" value="{!! $data->name !!}" 
                   @if($data->name) readonly @endif>
        
            <input type="password" class="form-control mt-4 mb-2" name="password" id="regPass" required
                   minlength="8"
                   placeholder="@lang('message.login.password')*">
            <input type="password" class="form-control mt-4 mb-2" name="password_confirmation"
                   id="regConfirmPass" required minlength="8" data-rule-equalTo="#regPass"
                   placeholder="@lang('message.register.retypePass')*">
            <?php $contentPolicy = \App\Http\DAL\DAL_Config::getConfig(103);?>
            <?php $contentSecurity = \App\Http\DAL\DAL_Config::getConfig(102);?>
            <div class="text-center">
                <p>@lang('message.register.notice')<br>
                    <a href="{!! route('frontend.policy.getPage',$contentPolicy->cfg_alias) !!}"
                        target="blank">@lang('message.footer.security')</a> &
                    <a href="{!! route('frontend.policy.getPage',$contentSecurity->cfg_alias) !!}"
                        target="blank">@lang('message.register.rules')</a></p>
            </div>
            <button type="submit" class="btn btn-block btnRegisterSocial btn-signin mb-3 py-2">
                @lang('message.header.login')
            </button>
        </form>
        </div>
        </div>
    </div>
</div>
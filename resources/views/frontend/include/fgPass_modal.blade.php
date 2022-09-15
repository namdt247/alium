<div class="modal show fade" id="fgPassModal" tabindex="-1" role="dialog" aria-hidden="true" >
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content forgetpass-mobile">
            <div class="modal-body">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        <form id="forgetPassForm" class="content-modal text-center pb-5">
            {!! csrf_field() !!}
            <h2 class="pt-4 header-modal">@lang('message.login.forgotPassword')</h2>
            <div class="success-notice d-none">
                <div class="text-notice d-flex px-3 py-4">
                    <div class="pr-2 pt-1">
                        <img src="/img/round-error-symbol.png" alt="" class="img">
                    </div>
                    <div>
                        <p class="text-left">
                            @lang('message.forgotPass.notice2')
                        </p>
                    </div>
                </div>
            </div>
            <p class="py-4">
                @lang('message.forgotPass.notice1')
            </p>
           
            <div class="input-group">
                <input type="email" class="form-control fgP-email" placeholder="@lang('message.forgotPass.email')"
                    name="email">
                <div class="input-group-append">
                    <button class="btn btn-outline-secondary btnSendCode" type="button">
                        @lang('message.forgotPass.verificationCode')
                    </button>
                </div>
            </div>
            <p class="error d-none error-email">@lang('message.forgotPass.emailNotice')</p>
            <p class="error d-none error-email-lock">Tài khoản của bạn đã bị khóa</p>

            <div class="text-left">
                <input type="text" class="form-control mt-4 mb-2" name="code"
    {{--                   value="156540310515d4e27e104a3d"--}}
                    required placeholder="@lang('message.forgotPass.code')*">
                <input type="password" class="form-control mt-4 mb-2" name="password" required minlength="8"
                    placeholder="@lang('message.forgotPass.newPass')*">
                <input type="password" class="form-control mt-4 mb-2"  name="password_confirmation" required minlength="8"
                    placeholder="@lang('message.forgotPass.confirmPass')*">
            </div>
            <button type="submit" class="btn btn-block btn-signin mt-4 mb-3 py-2 btnForgetPass">
                @lang('message.forgotPass.confirm')
            </button>
            <a href="#" data-toggle="modal" data-target="#loginModal" data-dismiss="modal">
                @lang('message.header.login')
            </a>
            <br>
            <a href="#" data-toggle="modal" data-dismiss="modal" data-target="#registerModal">
                @lang('message.login.register')
            </a>
        </form>
    </div>
        </div></div>
</div>

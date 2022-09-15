<!-- Login Modal -->
<div class="modal show fade" id="loginModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        <form id="loginForm" method="post" class="content-modal text-left" >
            {!! csrf_field() !!}
            <h2 class="pt-5 header-modal text-center">@lang('message.header.login')</h2>
            
            <input type="text" class="form-control mt-4 mb-2" name="username" id="username"
                placeholder="@lang('message.login.phoneOrmail')*" required>
            <p class="error d-none error-username">* @lang('message.login.phoneOrmailNotice')</p>
            <p class="error d-none error-username2">* Số điện thoại chưa được đăng ký tài khoản</p>

            <input type="password" class="form-control mt-4 mb-2" placeholder="@lang('message.login.password')*"
                name="password" id="password" required minlength="8">
            <p class="error error-password d-none">* @lang('message.login.passwordNotice')</p>
            <p class="error user-lock d-none">Tài khoản của bạn đã bị khóa</p>

            <div class="text-center">
                <button type="submit" class="btn btn-block btn-signin mt-4 mb-3 py-2 btnSignin">
                    @lang('message.header.login')</button>
            
                <a href="#" data-toggle="modal" data-target="#fgPassModal" data-dismiss="modal" class="pb-4">
                    @lang('message.login.forgotPassword')?
                </a>

                <div>
                <label for="" class="pt-4 pb-2">@lang('message.login.loginOther')</label>
                </div>

                <a href="{!! route('frontend.social.redirect','facebook') !!}"  class="btn-block btn-fb mb-3 py-2">
                    <img src="/img/facebook-letter-logo.png" alt="" class="img img-fluid pr-2">
                    @lang('message.login.loginFacebook')
                </a>

                <a href="{!! route('frontend.social.redirect','google') !!}" class="btn-block btn-gp mb-3 py-2">
                    <img src="/img/google-plus-logo.png" alt="" class="img img-fluid pr-2">
                    @lang('message.login.loginGoogle')
                </a>

                <p>@lang('message.login.noAccount') <a href="#" data-toggle="modal" data-dismiss="modal"
                                            data-target="#registerModal">@lang('message.login.register')</a></p>
            </div>
            
        </form>
            </div>
        </div>
    </div>
</div>
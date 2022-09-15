<!-- Redirect Social Login Modal -->
<div class="modal show fade" id="loginSocialModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document" >
        <div class="modal-content">
            <div class="modal-body">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        <form id="loginForm" method="post" class="content-modal text-left pb-4" >
            {!! csrf_field() !!}
            <h2 class="pt-5 header-modal text-center">@lang('message.header.login')</h2>

            <p class="error">
                Email (Số điện thoại) này đã được đăng ký tài khoản trên Alium. Vui lòng nhập mật khẩu tài khoản trên Alium để tiếp tục đăng nhập.
            </p>
            
            <input type="text" class="form-control mt-4 mb-2" name="username" id="username"
                placeholder="@lang('message.login.phoneOrmail')*"
                value="{!! $user_exist->user_email !!}" readonly>
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
            </div>
            
        </form>
            </div>
        </div>
    </div>
</div>
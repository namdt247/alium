<!-- User lock -->
<div class="modal show fade" id="userLockModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        <form id="userLockForm" method="post" class="content-modal text-left pb-4">
            {!! csrf_field() !!}
            <h2 class="pt-5 header-modal text-center">@lang('message.header.login')</h2>

            <p class="error pt-2">
                Tài khoản này đã bị khóa. Vui lòng sử dụng email khác để đăng ký hoặc liên hệ hotline +84.967.934.206 để được hỗ trợ.
            </p>
            <br>
            <div class="text-center">
                <a href="#" data-toggle="modal" data-dismiss="modal"
                    data-target="#registerModal">@lang('message.login.register')</a>
            </div>
        </form>
            </div>
        </div>
    </div>
</div>
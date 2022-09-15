@extends('frontend.layout_customer_service')

@section('main-service')
    <h2 class="info-header">@lang('message.footer.customerCare')</h2>
    <form class="user-info-content pt-3 pb-5" method="post" id="questionForm">
        {!! csrf_field() !!}
        <div class="form-group">
            <label for="">@lang('message.question.fullName') *</label>
            <input type="text" class="form-control form-control-lg" 
                placeholder="@lang('message.question.fullName')" required name="name"
                   @if(Auth::check()) value="{!! Auth::user()->user_showName !!}" @endif>
        </div>
        <div class="form-group">
            <label for="">@lang('message.question.phoneNum') *</label>
            <input type="tel" class="form-control form-control-lg" aria-label="số điện thoại"
                required name="phone" placeholder="0987654321"
               @if(Auth::check()) value="{!! Auth::user()->user_phone !!}" @endif>
        </div>

        <div class="form-group">
            <label for="">@lang('message.question.email')</label>
            <input type="email" class="form-control form-control-lg" required
                   name="email" placeholder="@lang('message.question.email')"
                   @if(Auth::check()) value="{!! Auth::user()->user_email !!}" @endif>
        </div>

        <div class="form-group">
            <label for="">@lang('message.question.orderID')</label>
            <input type="text" class="form-control form-control-lg"
                   name="order" placeholder="@lang('message.question.orderID')">
        </div>
        <div class="form-group">
            <label for="">@lang('message.question.issue')</label>
            <select  class="form-control form-control-lg" name="cate">
                <option value="1">@lang('message.question.issue1')</option>
                <option value="2">@lang('message.question.issue2')</option>
                <option value="3">@lang('message.question.issue3')</option>
            </select>
        </div>
        <div class="form-group">
            <label class="" for="">@lang('message.question.questionOfYou') *</label>
            <textarea name="content" rows="5" class="form-control" maxlength="500"
                      required placeholder="@lang('message.question.questionOfYouPlace')"></textarea>
        </div>
        <button type="submit" class="btn btn-block btnAsk"
                style="padding: .75rem; color: white; background-color: #3e9364;"
        >@lang('message.question.send')</button>

    </form>
@endsection

@section('main-script')
    <script>
        $(".btnAsk").click(function (evt) {
            var questionForm = $("#questionForm");
            evt.preventDefault();
            if(questionForm.valid()) {
                $.ajax({
                    type: "POST",
                    url: '/cham-soc-khach-hang/hoi-alium',
                    data: questionForm.serialize(),
                    success: function (data) {
                        switch (data.status) {
                            case 200:
                                Swal.fire({
                                    type: 'success',
                                    html: 'Yêu cầu của bạn đã được gửi đến Alium.<br>' +
                                        'Alium sẽ phản hồi thắc mắc của bạn trong thời gian sớm nhất.<br>' +
                                        'Để được hỗ trợ nhanh hơn, vui lòng liên hệ hotline: 089 664 8544.',
                                    showConfirmButton: false,
                                    timer: 2500
                                });
                                break;
                            default:
                                Swal.fire({
                                    type: 'error',
                                    text: 'Có lỗi xảy ra. Vui lòng thử lại sau',
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                                break;

                        }
                    },
                    error: function (data) {
                        Swal.fire({
                            type: 'error',
                            text: 'Có lỗi xảy ra. Vui lòng thử lại sau',
                            showConfirmButton: false,
                            timer: 1500
                        });
                    }
                });
            }
        });
    </script>
@endsection
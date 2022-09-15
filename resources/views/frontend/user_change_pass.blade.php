@extends('frontend.layout_user_info')

@section('user_content')
    <h2 class="info-header">@lang('message.myAccount.changePw')</h2>
    <form class="user-info-content" method="post">
        @if (count($errors) > 0)
            @foreach ($errors->all() as $error)
                <li><label for="" class="text-danger">
                        {{ $error }}</label></li>
            @endforeach
        @endif
        <!-- Flash message -->
        @if( \Illuminate\Support\Facades\Session::has('success_message'))
            <label for="" class="text-success">
                {{ \Illuminate\Support\Facades\Session::get('success_message') }}
            </label>
        @endif

        @if( \Illuminate\Support\Facades\Session::has('error_message'))
            <label for="" class="text-danger">
                {{ \Illuminate\Support\Facades\Session::get('error_message') }}
            </label>
        @endif
        {{--<!-- end flash message -->--}}
        {!! csrf_field() !!}
        <div class="row pt-3">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="">@lang('message.myAccount.changePw.currentPw')</label>
                    <input type="password" class="form-control form-control-lg" required minlength="8"
                        placeholder="@lang('message.myAccount.changePw.oldPw')" name="oldPass" value="">
                </div>
                <div class="form-group">
                    <label for="">@lang('message.myAccount.changePw.newPw')</label>
                    <input type="password" class="form-control form-control-lg" required minlength="8"
                        placeholder="@lang('message.myAccount.changePw.newPw')" name="txtPassword" value="">
                </div>
                <div class="form-group">
                    <label for="">@lang('message.myAccount.changePw.retypeNewPw')</label>
                    <input type="password" class="form-control form-control-lg" 
                        placeholder="@lang('message.myAccount.changePw.newPw')" required
                        minlength="8" name="txtPassword_confirmation" value="">
                </div>
                <button type="submit" class="btn btn-block text-center btnSave mt-3">
                    @lang('message.myAccount.changePw')
                </button>
            </div>

        </div>
    </form>
@endsection

@section('main-script')
    <script>
    </script>
@endsection
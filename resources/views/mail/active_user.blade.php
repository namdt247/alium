<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
</head>
<body>
<h2>@lang('message.userActivate.mailContent1')</h2>

<div>
    @lang('message.userActivate.mailContent2') {{ $name }} <br/>
    @lang('message.userActivate.mailContent3') : <a href="{{ URL::to('register/verify/' . $code) }}">
        {{ URL::to('register/verify/' . $code) }}
    </a>
    <br/>
    <br/>
    @lang('message.userActivate.mailContent4')
    <br/>
    <strong>@lang('message.userActivate.mailContent5')</strong>

</div>

</body>
</html>
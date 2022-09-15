<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
</head>
<body>
<h2>{!! $msTitle !!}</h2>

<div>
    {!! $msMessage !!} <br/>
    @if($msSale != '')
        @lang('message.orderChangeAd.employee'): {!! $msSale !!} <br/>
    @endif
        @lang('message.orderChangeAd.link') : <a href="{!! $msUrl !!}">
        @lang('message.manageOd.seeDetail')
    </a>
    <br/>
    <strong>@lang('message.userActivate.mailContent5')</strong>
</div>

</body>
</html>
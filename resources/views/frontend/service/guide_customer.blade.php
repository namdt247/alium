@extends('frontend.layout_customer_service')

@section('main-service')
    <?php $config = $data['config'] ?>
    <h2 class="info-header">{!! $config['title'] !!}</h2>
    <div class="p-3 bg-light">
        {!! $config['name'] !!}
    </div>
@endsection

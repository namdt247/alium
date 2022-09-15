<?php
/**
 * Created by PhpStorm.
 * User: quanvu
 * Date: 2019-07-07
 * Time: 10:18
 */
?>

@extends('frontend.layout_master')

@section('main-content')
    @include('frontend.home.call-to-action')
    @include('frontend.home.current-status')
    @include('frontend.home.home-feature')
    @include('frontend.home.review')
    @include('frontend.home.order')
@endsection


@section('main-script')
    <script>
        $(document).ready(function () {
            $('#reviewSlider').slick({
                infinite: true,
                slidesToShow: 2,
                slidesToScroll: 1,
                autoplay: true,
                autoplaySpeed: 3000,
                prevArrow: '<img class="slideButton btnPre" src="img/1_0001_pre-button.png" style="width: 45px">',
                nextArrow: '<img class="slideButton btnNext" src="img/1_0000_next-button.png" style="width: 45px">',
                responsive: [{
                    breakpoint: 800,
                    settings: {
                        slidesToShow: 1,
                    }
                }]
            });
        });
    </script>
@endsection
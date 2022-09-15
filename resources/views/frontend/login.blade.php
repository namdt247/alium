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
    
    <input type="hidden" value="0" id="userLogin">
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
                prevArrow: '<img class="slideButton btnPre" src="img/pre-slide.png">',
                nextArrow: '<img class="slideButton btnNext" src="img/next-slide.png">',
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
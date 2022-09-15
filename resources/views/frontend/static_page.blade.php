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
    <?php $config = $data['config']; ?>
    <div class="content" style="min-height: 500px;">
        <div class="container">
            <h3 class="py-4 text-center static-font-mobile" style="color: #3e9364;">
                {!! $config['title'] !!}
            </h3>
        </div>
        <div class="page-content" style="border-top: 1px solid #e5e5e5;">
            <div class="container p-8 page-mobile">
                {!! $config['name'] !!}
            </div>
        </div>
    </div>
@endsection

@section('main-script')

@endsection
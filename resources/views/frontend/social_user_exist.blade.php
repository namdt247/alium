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
    <input type="hidden" value="0" id="userloginSocial">
    @include('frontend.include.login_social')
@endsection

@section('main-script')
@endsection
<?php
/**
 * Created by PhpStorm.
 * User: QuanVH
 * Date: 13/12/2016
 * Time: 11:24 SA
 */
        ?>
@extends('admin.layout_master')
@section('main-header')
    <h1>
        Trang quản trị Alium.vn
    </h1>
@endsection

@section('main-content')
    @hasanyrole('admin|super-admin')
    <?php $dal_statistic = new \App\Http\DAL\DAL_Statistic(); ?>
    <div class="row">
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-yellow">
                <div class="inner">
                    <h3>{!! $dal_statistic->countUser() !!}</h3>

                    <p>Khách hàng</p>
                </div>
                <div class="icon">
                    <i class="fa fa-users"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-aqua">
                <div class="inner">
                    <h3>{!! $dal_statistic->countOrder() !!}</h3>

                    <p>Đơn hàng mới</p>
                </div>
                <div class="icon">
                    <i class="fa fa-cart-plus"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-green">
                <div class="inner">
                    <h3>{!! $dal_statistic->countOrderCancel() !!}</h3>

                    <p>Đơn hàng bị hủy</p>
                </div>
                <div class="icon">
                    <i class="fa fa-cart-plus"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-red">
                <div class="inner">
                    <h3>{!! $dal_statistic->countTotalRevenue() !!}</h3>

                    <p>Tổng doanh thu</p>
                </div>
                <div class="icon">
                    <i class="fa fa-cart-plus"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
    </div>
    @endhasanyrole()
@endsection

@section('main-script')
@endsection
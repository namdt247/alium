<?php
/**
 * Created by PhpStorm.
 * User: QuanVH
 * Date: 01/11/2016
 * Time: 23:07 CH
 */
        ?>
@extends('admin.layout_master')

@section('main-header')
    <h1>Trang tĩnh <small>Chỉnh sửa</small></h1>
@endsection

@section('main-content')
    <div class="box box-warning">
        <div class="box-header">
            <h3 class="box-title text-danger">{!! $config->cfg_name !!}</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <form role="form" method="post" enctype="multipart/form-data">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="lbId" value="{!! $config->cfg_id !!}">
                <?php $locale = App::getLocale(); ?>
                <?php $lstConfig = unserialize($config->cfg_value)[$locale]; ?>

                @foreach($lstConfig as $cfgItem)
                    <?php $cfgItem = (object)$cfgItem; ?>
                    <div class="form-group">
                        <label for="">{!! $cfgItem->title !!}</label>
                        <div class="input-group input-group-lg">
                            <span class="input-group-addon">
                                <i class="fa fa-{!! $cfgItem->icon !!}"></i>
                            </span>
                            <input type="text" class="form-control" placeholder="..." name="txtContent{!! $cfgItem->id !!}"
                                value="{!! $cfgItem->name !!}">
                        </div>
                    </div>
                @endforeach

                <div class="row">
                    <div class="col-md-6">
                        <button class="btn btn-block btn-primary" type="submit">Cập nhật</button>
                    </div>
                    <div class="col-md-6">
                        <button class="btn btn-block btn-primary" type="button" onclick="goBack()">Hủy</button>
                    </div>
                </div>

            </form>
        </div>
        <!-- /.box-body -->
    </div>
@endsection

@section('main-script')
@endsection
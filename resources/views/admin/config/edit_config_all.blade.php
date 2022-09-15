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
    <h1>Cấu hình <small class="text-danger">{!! $config->cfg_name !!}</small></h1>
@endsection

@section('main-content')
    <form role="form" method="post" enctype="multipart/form-data">
        <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="lbId" id="lbId" value="{!! $config->cfg_id !!}">
        <?php $locale = App::getLocale(); ?>
        <?php $lstConfig = unserialize($config->cfg_value); ?>
        <div class="row">
            @foreach($lstConfig as $key => $lstConfigLocale)
                <div class="col-md-6">
                    <div class="box box-warning box-locale" data-id="{!! $key !!}">
                        <div class="box-header">
                            <h3 class="box-title text-danger">{!! $key !!}</h3>
                        </div>
                        <input type="hidden" name="lbOrder{!! $key !!}" class="lbOrder">
                        <!-- /.box-header -->
                        <div class="box-body">
                        @foreach($lstConfigLocale as $cfgItem)
                            <?php $cfgItem = (object)$cfgItem; ?>
                            <div style="background-color: #f4f1fa; padding: 2px 5px; margin-bottom: 5px;" id="{!! $cfgItem->id !!}">
                            <div class="form-group">
                                <h3><a href="#" class="text-red delete-item" data-id="{!! $cfgItem->id !!}">
                                        <i class="fa fa-trash"></i> ID: {!! $cfgItem->id !!}</a></h3>

                            </div>

                            <div class="form-group">
                                <div class="input-group input-group-lg">
                                    <span class="input-group-addon">icon</span>
                                    <input type="text" class="form-control" placeholder="..."
                                           name="txtIcon{!! $key.$cfgItem->id !!}"
                                           value="{!! $cfgItem->icon !!}">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group input-group-lg">
                                    <span class="input-group-addon">title</span>
                                    <input type="text" class="form-control" placeholder="..."
                                           name="txtTitle{!! $key.$cfgItem->id !!}"
                                           value="{!! $cfgItem->title !!}">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group input-group-lg">
                                    <span class="input-group-addon">name</span>
                                    <input type="text" class="form-control" placeholder="..."
                                           name="txtName{!! $key.$cfgItem->id !!}"
                                           value="{!! $cfgItem->name !!}">
                                </div>
                            </div>
                            </div>
                        @endforeach
                        </div>
                        <!-- /.box-body -->
                        <div class="form-group add-item" style="padding: 10px;">
                        <button type="button" class="btn btn-primary add" style="margin-bottom: 10px;">Thêm</button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="row">
            <div class="col-md-6">
                <button class="btn btn-block btn-primary" type="submit">Cập nhật</button>
            </div>
            <div class="col-md-6">
                <button class="btn btn-block btn-primary" type="button" onclick="goBack()">Hủy</button>
            </div>
        </div>
    </form>
@endsection

@section('main-script')
    <script>
        var submit = 0;
        $("div.box-body").sortable({
            stop: function (event, ui) {
                var sortedIDs = $(this).sortable( "toArray" );
                $(this).siblings("input.lbOrder").val(sortedIDs);
            }
        });
        $("button.add").click(function (evt) {
            submit++;
            $("button.add").attr("disabled", true);
            let parentNode = $(evt.target).parents("div.box-locale");
            let locale = parentNode.attr('data-id');
            let boxBody = parentNode.find('div.add-item');

            if (submit > 1){
                submit = 0
                //submit request create new option
                $.ajax({
                    url: "/admin/config/add-config-item",
                    method: 'post',
                    data: {
                        '_token': $("#_token").val(),
                        'id':$("#lbId").val(),
                        'locale': locale,
                        'icon': $("#txtIcon").val(),
                        'name': $("#txtName").val(),
                        'title': $("#txtTitle").val(),
                    }
                }).success(function (code) {
                    if (parseInt(code) === 200) location.reload();
                });
            }
            else {
                let iconElement = '<div class="form-group">' +
                    '<div class="input-group input-group-lg">' +
                    '<span class="input-group-addon">icon</span>' +
                    '<input type="text" class="form-control" placeholder="..."' +
                    ' id="txtIcon"' +
                    ' value="">' +
                    '</div>' +
                    '</div>';
                let nameElement = '<div class="form-group">' +
                    '<div class="input-group input-group-lg">' +
                    '<span class="input-group-addon">name</span>' +
                    '<input type="text" class="form-control" placeholder="..."' +
                    ' id="txtName"' +
                    ' value="">' +
                    '</div>' +
                    '</div>';
                let titleElement = '<div class="form-group">' +
                    '<div class="input-group input-group-lg">' +
                    '<span class="input-group-addon">title</span>' +
                    '<input type="text" class="form-control" placeholder="..."' +
                    ' id="txtTitle"' +
                    ' value="">' +
                    '</div>' +
                    '</div>';
                boxBody.append(iconElement, titleElement, nameElement);
                $(evt.target).attr("disabled", false);
            }
        });
        $("a.delete-item").click(function (evt) {
            evt.preventDefault();
            if ( confirm("Bạn có chắc chắn muốn xóa?") ) {
                let itemId = evt.target.getAttribute('data-id');
                let parentNode = $(evt.target).parents("div.box-locale");
                let locale = parentNode.attr('data-id');
                $.ajax({
                    url: "/admin/config/delete-config-item",
                    method: 'post',
                    data: {
                        '_token': $("#_token").val(),
                        'id': $("#lbId").val(),
                        'locale': locale,
                        'itemId': itemId
                    }
                }).success(function (code) {
                    if (parseInt(code) === 200) location.reload();
                });
            }
        })
    </script>
@endsection
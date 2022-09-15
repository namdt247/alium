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
    <h1>Phản hồi <small>cập nhật</small></h1>
@endsection

@section('main-content')
    <div class="box box-warning">
        <!-- /.box-header -->
        <div class="box-body">
            <form role="form" method="post" enctype="multipart/form-data">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="lbId" value="{!! $feedback->fb_id !!}">

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Họ tên</label>
                            <input type="text" class="form-control input-lg"
                                   name="txtTitle" placeholder="..." disabled
                                   value="{!! $feedback->fb_name !!}">
                        </div>
                        <div class="form-group">
                            <label>SDT</label>
                            <input type="text" class="form-control input-lg"
                                   name="txtTitle" placeholder="..." disabled
                                   value="{!! $feedback->fb_phone !!}">
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="text" class="form-control input-lg"
                                   name="txtTitle" placeholder="..." disabled
                                   value="{!! $feedback->fb_email !!}">
                        </div>
                        <div class="form-group">
                            <label>Đơn hàng</label>
                            <input type="text" class="form-control input-lg"
                                   name="txtOrder" placeholder="..." disabled
                                   value="{!! $feedback->order? $feedback->order->od_code: 'Không xác định' !!}">
                        </div>
                        <div class="form-group">
                            <label>Phản hồi về:</label>
                            <input type="text" class="form-control input-lg"
                                   name="txtCate" placeholder="..." disabled
                                   value="{!! $feedback->cate !!}">
                        </div>
                        <div class="form-group">
                            <label for="txtContent">Nội dung</label>
                            <textarea class="form-control" name="txtContent" id="" cols="30" disabled
                                      rows="5">{!! $feedback->fb_content !!}</textarea>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Đổi trạng thái</label>
                            <select class="form-control select2" name="sltStatus">
                                <?php $lstStatus = \App\Http\DAL\DAL_Config::getConfigByLocale(31); ?>
                                @foreach($lstStatus as $config)
                                    <?php $config = (object)$config; ?>
                                    <option value="{!! $config->id !!}"
                                            @if($config->id == $feedback->fb_status) selected @endif>{!! $config->name !!}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Thêm ghi chú</label>
                            <textarea class="form-control" name="txtNote" id="" cols="30"
                                      rows="5">{!! $feedback->fb_note !!}</textarea>
                        </div>
                    </div>
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
        </div>
        <!-- /.box-body -->
    </div>
@endsection

@section('main-script')
    <script>
        $(".select2").select2({minimumResultsForSearch: -1});
    </script>
@endsection
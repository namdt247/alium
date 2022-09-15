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
    <h1>Đánh giá <small>duyệt</small></h1>
@endsection

@section('main-content')
    <div class="box box-warning">
        <!-- /.box-header -->
        <div class="box-body">
            <form role="form" method="post" enctype="multipart/form-data">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="lbId" value="{!! $rate->rate_id !!}">
                <div class="form-group">
                    <label for="sltTag">Chọn khách hàng</label>
                    <input type="text" class="form-control" disabled value="{!! $rate->user->user_showName !!}">
                </div>
                <div class="form-group">
                    <label for="">Đơn hàng</label>
                    <input type="text" class="form-control" disabled value="{!! $rate->order->od_code !!}">
                </div>
                <div class="form-group">
                    <h4>Chỉnh sửa thông tin khách hàng</h4>
                </div>
                <div class="form-group">
                    <label for="">Tên khách hàng</label>
                    <input type="text" class="form-control" name="txtName" placeholder="Tên khách hàng">
                </div>
                <div class="form-group">
                    <label for="imgFeature">Ảnh đại diện</label>
                    <br>
                    <img class="img-responsive" alt="" src="" id="_imgFeature" style="display: none;" width="320">
                    <label class="btn btn-default" style="margin-top: 10px;">
                        Browse
                        <input type="file" class="hidden" id="imgFeature" name="sltAvatar">
                    </label>
                </div>
                <div class="form-group clearfix">
                    <label for="" class="pull-left">Đánh giá</label>
                    <br>
                    @for($i = 0; $i < 5; $i++)
                        @if($i >= $rate->rate_star)
                            <span class="fa fa-star fa-3x"></span>
                        @else
                            <span class="fa fa-star fa-3x checked"></span>
                        @endif
                    @endfor
                </div>
                <div class="form-group">
                    <label for="">Nội dung</label>
                    <textarea class="form-control" name="txtContent" id="" cols="30" rows="3"
                    >{!! $rate->rate_content !!}</textarea>
                </div>
                <div class="form-group">
                    <label for="">Trạng thái</label>
                    <select class="form-control select2" name="sltStatus">
                        <?php $lstType = \App\Http\DAL\DAL_Config::getConfigByLocale(11); ?>
                        @foreach($lstType as $config)
                            <?php $config = (object)$config; ?>
                            <option value="{!! $config->id !!}"
                                @if ($config->id == $rate->rate_status) selected @endif>{!! $config->name !!}</option>
                        @endforeach
                    </select>
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
@endsection
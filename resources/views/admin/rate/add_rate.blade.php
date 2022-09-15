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
    <h1>Đánh giá <small>thêm mới</small></h1>
@endsection

@section('main-content')
    <div class="box box-warning">
        <!-- /.box-header -->
        <div class="box-body">
            <form role="form" method="post" enctype="multipart/form-data">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <?php $dal_rate = new \App\Http\DAL\DAL_Rate(); ?>
                <?php $firstOrder = $dal_rate->getFirstOrder(); ?>
                <div class="form-group">
                    <label for="sltTag">Chọn khách hàng</label>
                    <select class="form-control sltUser" name="sltUser">
                        <option value="{!! $firstOrder->demander->user_id !!}">
                            {!! $firstOrder->demander->user_showName !!}
                        </option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Đơn hàng</label>
                    <select class="form-control sltOrder" name="sltOrder" readonly="true">
                        <option value="{!! $firstOrder->od_id !!}">{!! $firstOrder->od_code !!} - {!! $firstOrder->od_name !!}</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Tên khách hàng (<span class="text-danger">*</span>)</label><br />
                    <input type="text" name="sltUserName" style="width: 100%;" required>
                </div>
                <div class="form-group">
                    <label for="imgFeature">Ảnh đại diện (<span class="text-danger">*</span>)</label>
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
                    <fieldset class="rating">
                        <input class="tick" type="radio" id="star5" name="rating" value="5" checked/>
                        <label class = "full" for="star5" title="Awesome - 5 stars"></label>
                        <input class="tick" type="radio" id="star4" name="rating" value="4" />
                        <label class = "full" for="star4" title="Pretty good - 4 stars"></label>
                        <input class="tick" type="radio" id="star3" name="rating" value="3" />
                        <label class = "full" for="star3" title="Meh - 3 stars"></label>
                        <input class="tick" type="radio" id="star2" name="rating" value="2" />
                        <label class = "full" for="star2" title="Kinda bad - 2 stars"></label>
                        <input class="tick" type="radio" id="star1" name="rating" value="1" />
                        <label class = "full" for="star1" title="Sucks big time - 1 star"></label>
                    </fieldset>
                </div>
                <div class="form-group">
                    <label for="">Nội dung</label>
                    <textarea class="form-control" name="txtContent" id="" cols="30" rows="3"></textarea>
                </div>
                <div class="form-group">
                    <label for="">Trạng thái</label>
                    <select class="form-control select2" name="sltStatus">
                        <?php $lstType = \App\Http\DAL\DAL_Config::getConfigByLocale(11); ?>
                        @foreach($lstType as $config)
                            <?php $config = (object)$config; ?>
                            <option value="{!! $config->id !!}"
                                @if($config->id==2) selected @endif>{!! $config->name !!}</option>
                        @endforeach
                    </select>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <button class="btn btn-block btn-primary" type="submit">Tạo mới</button>
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
        $(document).ready(function() {
            $(".sltUser").select2({
                ajax: {
                    url: "/admin/user/search-user",
                    processResults: function (data) {
                        return {
                            results: data
                        };
                    },
                    cache: true,
                },
                minimumInputLength: 2,
                allowClear: true
            });
            $(".sltOrder").select2({
                ajax: {
                    url: "/admin/product/search-order",
                    processResults: function (data) {
                        return {
                            results: data
                        };
                    },
                    cache: true,
                },
                minimumInputLength: 2,
                allowClear: true
            });
        });
    </script>
@endsection
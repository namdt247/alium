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
    <h1>Bài viết tuyển dụng <small>thêm mới</small></h1>
@endsection

@section('main-content')
    <div class="box box-warning">
        <!-- /.box-header -->
        <div class="box-body">
            <form role="form" method="post" enctype="multipart/form-data">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="form-group">
                    <label>Tiêu đề</label>
                    <input type="text" class="form-control input-lg" required
                           name="txtTitle" placeholder="Enter title for article..."
                            value="">
                </div>
                {{-- <div class="form-group">
                    <label>Mã nhúng/link video(youtube)</label>
                    <input type="text" class="form-control input-lg"
                           name="txtLink" placeholder="https://www.youtube.com/watch?v=Bey4XXJAqS8&"
                           value="">
                </div> --}}

                <div class="form-group hidden">
                    <label>Alias</label>
                    <input type="text" class="form-control input-lg"
                           name="txtAlias" placeholder="Enter alias for article ..."
                            value="">
                </div>
                <div class="form-group">
                    <label>Tóm tắt</label>
                    <textarea name="txtSapo" placeholder="Enter sapo for article..."
                              rows="3" class="form-control"></textarea>
                </div>
                <div class="form-group">
                    <label for="txtContent">Nội dung</label>
                    <textarea id="txtContent" name="txtContent" rows="10" cols="80">
                    </textarea>
                    <script type="text/javascript">ckeditor('txtContent')</script>
                </div>
                <div class="form-group">
                    <label>Bài viết tiêu biểu</label>
                    <input type="checkbox" name="promote" class="form-group form-group-lg">
                </div>

                <div class="form-group">
                    <label for="imgFeature">Ảnh đại diện</label>
                    <br>
                    <img class="img-responsive" alt="" src="" id="_imgFeature" style="display: none;" width="320">
                    <label class="btn btn-default" style="margin-top: 10px;">
                        Browse
                        <input type="file" class="hidden" id="imgFeature" name="imgFeature">
                    </label>
                </div>
                <div class="form-group">
                    <label for="sltTag">Từ khóa</label>
                    <select class="tag-select form-control" name="sltTag[]" style="width: 100%;" multiple="multiple">
                    </select>
                </div>
                <div class="form-group hidden">
                    <label>Nhà xưởng được đánh giá</label>
                    <select class="supplier-select form-control" name="sltSupplier" style="width: 100%;" >
                        <?php $dal_user = new \App\Http\DAL\DAL_User(); ?>
                        <?php //$lstSupplier = $dal_user->getListSupplier([\App\Http\DAL\DAL_Config::USER_STATUS_PUBLIC]); ?>
                        {{--@foreach($lstSupplier as $user)--}}
                            {{--<option value="{!! $user->user_id !!}">{!! $user->user_showName !!}</option>--}}
                        {{--@endforeach--}}
                    </select>
                </div>
                <div class="form-group hidden">
                    <label>Đặt lịch xuất bản</label>
                    <div class="input-group">
                        <span class="input-group-addon">
                          <input type="checkbox" id="chbSchedule" name="chbSchedule">
                        </span>
                        <input type="text" class="form-control pull-right" disabled id="dateSchedule" name="dateSchedule">
                    </div>
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
        $('#chbSchedule').change(function() {
            if($(this).is(":checked")) {
                $("#dateSchedule").prop('disabled', false);
            }
            else {
                $("#dateSchedule").prop('disabled', true);
            }
        });

        // config date picker for schedule public article
        let date = new Date();
        date.setDate(date.getDate() + 1);
        $('#dateSchedule').datepicker({
            autoclose: true,
            todayHighlight: true,
            startDate: date
        })
    </script>
@endsection
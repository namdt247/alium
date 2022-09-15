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
    <h1>Câu hỏi <small>thêm mới</small></h1>
@endsection

@section('main-content')
    <div class="box box-warning">
        <!-- /.box-header -->
        <div class="box-body">
            <form role="form" method="post" enctype="multipart/form-data">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="cate" value="{!! $cateId !!}">
                <div class="form-group">
                    <label>Câu hỏi</label>
                    <textarea name="txtSapo" placeholder="Nội dung câu hỏi..."
                              rows="3" class="form-control">{!! old("txtSapo") !!}</textarea>
                </div>
                <div class="form-group">
                    <label for="txtContent">Câu trả lời</label>
                    <textarea id="txtContent" name="txtContent" rows="10" cols="80">{!! old('txtContent') !!}</textarea>
                    <script type="text/javascript">ckeditor('txtContent',1)</script>
                </div>
                <div class="form-group hidden">
                    <label for="sltTag">Tag</label>
                    <select class="tag-select form-control" name="sltTag[]" multiple="multiple">
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
@endsection
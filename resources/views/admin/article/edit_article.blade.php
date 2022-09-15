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
    <h1>Bài viết <small>chỉnh sửa</small></h1>
@endsection

@section('main-content')
    <?php $article = $data ?>
    <div class="box box-warning">
        <div class="box-body">
            <form role="form" method="post" enctype="multipart/form-data">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="lbId" value="{!! $article->atc_id !!}">
                <div class="form-group hidden">
                    <?php $dal_article = new \App\Http\DAL\DAL_Article(); ?>
                    <?php $lstCate = $dal_article->getListCatePublic(); ?>
                    <label>Danh mục</label>
                    <select class="form-control" name="sltCate">
                        @foreach($lstCate as $cate)
                            @if($cate->cate_id == $article->atc_cate)
                                <option value="{!! $cate->cate_id !!}" selected>{!! $cate->cate_name !!}</option>
                            @else
                                <option value="{!! $cate->cate_id !!}">{!! $cate->cate_name !!}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Tiêu đề</label>
                            <input type="text" class="form-control input-lg"
                                   name="txtTitle" placeholder="Enter title for article..."
                                   value="{!! $article->atc_title !!}">
                        </div>
                        <div class="form-group">
                            <label>Mã nhúng/link video(youtube)</label>
                            <input type="text" class="form-control input-lg"
                                   name="txtLink" placeholder="https://www.youtube.com/watch?v=Bey4XXJAqS8&"
                                   value="{!! $article->atc_tag !!}">
                        </div>
                        <div class="form-group hidden">
                            <label>Alias</label>
                            <input type="text" class="form-control input-lg"
                                   name="txtAlias" placeholder="Enter alias for article (do-muc-may-in-canon) ..."
                                   value="{!! $article->atc_alias !!}">
                        </div>
                        <div class="form-group">
                            <label>Tóm tắt</label>
                            <textarea name="txtSapo" placeholder="Enter sapo for article..."
                                      rows="3" class="form-control">{!! $article->atc_sapo !!}</textarea>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="imgFeature">Ảnh đại diện</label>
                            <br>
                            @if($article->atc_featureImg)
                                <img class="" alt="" src="{!! \App\Helper\Common::GetThumb($article->atc_featureImg,'c1') !!}"
                                     id="_imgFeature" width="320">
                            @else
                                <img class="" alt="" src="{!! asset('img/no-image-640x360.jpg') !!}" id="_imgFeature" width="320">
                            @endif
                            <br>
                            <label class="btn btn-default" style="margin-top: 10px;">
                                Browse
                                <input type="file" class="hidden" id="imgFeature" name="imgFeature">
                            </label>

                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="txtContent">Nội dung</label>
                    <textarea id="txtContent" name="txtContent" rows="10" cols="80">
                        {!! $article->atc_content !!}
                    </textarea>
                    <script type="text/javascript">ckeditor('txtContent')</script>
                </div>

                <div class="form-group">
                    <label for="sltTag">Từ khóa</label>
                    <select class="tag-select form-control" id="sltTag" name="sltTag[]" style="width: 100%;" multiple="multiple">
                        @foreach($article->tags as $tag)
                            <option value="{!! $tag->tag_name !!}" selected="selected">{!! $tag->tag_name !!}</option>
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
    <script>

        var tagSelect = $(".tag-select").select2({
            tags: "true",
            ajax: {
                url: "{!! route('admin.tag.getAll') !!}",
                processResults: function (data) {
                    return {
                        results: data
                    };
                },
                cache: true,
            },
            closeOnSelect: true,
            minimumInputLength: 2,
        });
    </script>
@endsection
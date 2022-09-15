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
    <h1>Dòng sản phẩm <small>Chỉnh sửa</small></h1>
@endsection

@section('main-content')
    <?php $product = $data ?>
    <div class="box box-warning">
        <!-- /.box-header -->
        <div class="box-body">
            <form role="form" method="post" enctype="multipart/form-data">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" value="" name="imgId" id="imgId">
                <input type="hidden" name="lbId" value="{!! $product->prd_id !!}">
                <div class="form-group">
                    <?php $dal_product = new \App\Http\DAL\DAL_Product(); ?>
                    <?php $lstCate = $dal_product->getListCatePublic(); ?>
                    <label>Danh mục</label>
                    <select class="form-control select2" name="sltCate">
                        @foreach($lstCate as $cate)
                            @if($cate->cate_id == $product->prd_cate)
                                <option value="{!! $cate->cate_id !!}" selected>{!! $cate->cate_name !!}</option>
                            @else
                                <option value="{!! $cate->cate_id !!}">{!! $cate->cate_name !!}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Tên dòng sản phẩm</label>
                            <input type="text" class="form-control input-lg"
                                   name="txtTitle" placeholder="Enter name for product..."
                                   value="{!! $product->prd_name !!}">
                        </div>
                    </div>
                    <div class="col-md-6 hidden">
                        <div class="form-group">
                            <label>Giá sp($ US)</label>
                            <input type="number" class="form-control input-lg"
                                   name="txtPrice" placeholder="000.000.000"
                                   value="{!! $product->prd_price !!}">
                        </div>
                    </div>
                </div>
                <div class="form-group hidden">
                    <label>Mô tả ngắn</label>
                    <textarea name="txtSapo" placeholder="Enter sapo for product..."
                              rows="3" class="form-control">{!! $product->prd_sapo !!}</textarea>
                </div>
                <div class="form-group">
                    <label>Ảnh sản phẩm</label>
                    <div class="drop dropzone" id="dropzone">
                        @foreach ($product->image as $image)
                            <div class="dz-preview dz-processing dz-complete dz-image-preview">
                                <div class="dz-image">
                                    <img data-dz-thumbnail="" alt="photo2.png"
                                         src="{!! \App\Helper\Common::GetThumb($image->img_src) !!}">
                                </div>
                                <a class="dz-remove img_product"
                                   href="/admin/product/delete-image/{{ $image->img_id }}">Xóa ảnh</a>
                            </div>
                        @endforeach
                        <div class="fallback">
                            <input name="file" type="file" multiple />
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="">Sản phẩm tiêu biểu</label>
                    <select class="" name="featureProduct" id="">
                        <option value="0">Không tiêu biểu</option>
                        <option value="1" @if($product->prd_promote == 1) selected @endif
                            >Sản phẩm tiêu biểu số 1</option>
                        <option value="2" @if($product->prd_promote == 2) selected @endif
                            >Sản phẩm tiêu biểu số 2</option>
                        <option value="3" @if($product->prd_promote == 3) selected @endif
                            >Sản phẩm tiêu biểu số 3</option>
                    </select>

                </div>
                <div class="form-group avatar">
                    <label for="imgFeature">Ảnh đại diện (sản phẩm tiêu biểu)</label>
                    <br>
                    <img class="img-responsive" alt="" src="{!! \App\Helper\Common::GetThumb($product->prd_featureImg) !!}"
                         id="_imgFeature" width="320">
                    <label class="btn btn-default" style="margin-top: 10px;">
                        Browse
                        <input type="file" class="hidden" id="imgFeature" name="imgFeature">
                    </label>
                </div>
                <div class="form-group hidden">
                    <label>Mô tả chi tiết</label>
                    <textarea id="txtContent" name="txtContent" rows="10" cols="80">
                        {!! $product->prd_des !!}
                    </textarea>
                    <script type="text/javascript">ckeditor('txtContent')</script>
                </div>

                <div class="form-group hidden">
                    <label>Từ khóa</label>
                    <select class="tag-select form-control" name="sltTag[]" style="width: 100%;" multiple="multiple">
                        @foreach($product->tags as $tag)
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
    <script src="/js/admin/admin_product.js"></script>
@endsection
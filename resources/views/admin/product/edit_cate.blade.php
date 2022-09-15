@extends('admin.layout_master')

@section('main-header')
    <h1>Danh mục sản phẩm <small>chỉnh sửa</small></h1>
@endsection

@section('main-content')
    <section class="content">
        <?php $cate = $data['cate']; ?>
        <div class="row">
            <div class="col-xs-12">
                <form action="" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="lbId" value="{!! $cate->cate_id !!}">
                    <div class="form-group">
                        <label>Tên danh mục (<span class="text-danger">*</span>)</label>
                        <input class="form-control" type="text" name="txtName" placeholder="tên danh mục" value="{!! $cate->cate_name !!}"/>
                    </div>
                    <div class="form-group hidden">
                        <label>Danh mục cha</label>
                        <select class="form-control" name="sltCate">
                            <?php $dal_product = new \App\Http\DAL\DAL_Product(); ?>
                            <?php $lstCate = $dal_product->getListCatePublic(); ?>
                                <option value="0">-- Danh mục cha --</option>
                            @foreach($lstCate as $cateItem) {
                            @if($cateItem->cate_id == $cate->cate_parent)
                                <option value= "{!! $cateItem->cate_id !!}" selected>{!! $cateItem->cate_name !!}</option>
                            @else
                                <option value= "{!! $cateItem->cate_id  !!}">{!! $cateItem->cate_name  !!}</option>
                            @endif
                            @endforeach
                        </select>
                    </div>

                    <button type="submit" class="btn btn-default">Cập nhật</button>
                    <button type="reset" class="btn btn-default" onclick="goBack()">Hủy</button>
                </form>
            </div>
            <!-- /.col -->
        </div>
    </section>
@endsection
@extends('admin.layout_master')

@section('main-header')
    <h1>Danh mục sản phẩm <small>thêm mới</small></h1>
@endsection


@section('main-content')
     <form action="" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="form-group">
            <label>Tên danh mục (<span class="text-danger">*</span>)</label>
            <input class="form-control" type="text" name="txtName" placeholder="tên danh mục" value="{!! old('txtName') !!}"/>
        </div>
        <div class="form-group hidden">
            <label>Danh mục cha</label>
            <select class="form-control" name="sltCate">
                <option value="0">-- Danh mục cha --</option>

                <?php $dal_product = new \App\Http\DAL\DAL_Product(); ?>
                <?php $lstCate = $dal_product->getListCatePublic(); ?>
                @foreach($lstCate as $cate) {
                @if($cate->cate_id == old('sltCate'))
                    <option value= "{!! $cate->cate_id !!}" selected>{!! $cate->cate_name !!}</option>
                @else
                    <option value= "{!! $cate->cate_id  !!}">{!! $cate->cate_name  !!}</option>
                @endif
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-default">Thêm mới</button>
        <button type="reset" class="btn btn-default">Hủy</button>
    </form>
@endsection
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
    <h1>Bài viết<small>danh sách</small></h1>
@endsection

@section('main-content')
    <?php
     $textSearch = isset($_GET['query']) ? $_GET['query'] : '';
    $dateRange = isset($_GET['date']) ? $_GET['date'] : '';
    $status = isset($_GET['status']) ? $_GET['status'] : 0;
    $startDate = ''; $endDate = '';
    if($dateRange != '') {
        $lstDate = explode('-', $dateRange);
        $startDate = trim($lstDate[0]);
        $endDate = trim($lstDate[1]);
    }
    ?>
    <form class=" form-inline" style="margin-bottom: 20px;" method="get">
         <div class="form-group">
            <input type="text" class="form-control" name="q"
                   value="{!! $textSearch !!}" placeholder="Tìm kiếm...">
        </div>
        <div class="form-group">
            <label>Ngày xuất bản:</label>
            <div class="input-group">
                <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                </div>
                <input type="text" class="form-control pull-right" value="{!! $dateRange !!}"
                       id="reservation" name="date">
            </div>
            <!-- /.input group -->
        </div>
        <select class="form-control select2" name="status">
            <option value="0"> -- Trạng thái -- </option>
            <option value="{!! \App\Http\DAL\DAL_Config::ARTICLE_STATUS_PUBLIC !!}"
                @if($status == \App\Http\DAL\DAL_Config::ARTICLE_STATUS_PUBLIC) selected @endif>
                Đã xuất bản </option>
            <option value="{!! \App\Http\DAL\DAL_Config::ARTICLE_STATUS_PENDING !!}"
                    @if($status == \App\Http\DAL\DAL_Config::ARTICLE_STATUS_PENDING) selected @endif>
                Chưa xuất bản </option>
        </select>
        <button type="submit" class="btn btn-default">Tìm kiếm</button>
    </form>
    <div class="box">
        <div class="box-body">
            @if(method_exists($lstArticle, 'links')) {!! $lstArticle->links() !!} @endif
            <table id="example2" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Ảnh đại diện</th>
                    <th>Tiêu đề</th>
                    <th>Người tạo</th>
                    <th>Ngày xuất bản</th>
                    <th>Trạng thái</th>
                    <th>Thao tác</th>
                </tr>
                </thead>
                <tbody>
                @foreach($lstArticle as $article)
                <tr>
                    <td>{!! $article->atc_id !!}</td>
                    <td>
                        <img src="{!! \App\Helper\Common::GetThumb($article->atc_featureImg) !!}"
                             class="img img-responsive" alt="" width="160">
                    </td>
                    <td>{!! $article->atc_title !!}</td>
                    <td>
                        {!! $article->author->user_showName !!}
                    </td>
                    <td>{!! date('d/m/Y',strtotime($article->atc_publicDate)) !!}</td>
                    <td>{!! $article->atc_status == 1 ? 'Đã xuất bản' : 'Chưa xuất bản' !!}</td>
                    <td>
                        <i class="fa fa-pencil fa-fw"></i>
                        <a href="{!! route('admin.article.getEdit',$article->atc_id) !!}" target="_blank">Sửa</a>
                        <span> | </span>
                        <i class="fa fa-trash fa-fw"></i>
                        <a href="{!! route('admin.article.getDelete',$article->atc_id) !!}">Xóa</a>
                    </td>
                </tr>
                    @endforeach
                </tbody>

                <tfoot>
                <tr>
                    <th>#</th>
                    <th>Ảnh đại diện</th>
                    <th>Tiêu đề</th>
                    <th>Người tạo</th>
                    <th>Ngày xuất bản</th>
                    <th>Trạng thái</th>
                    <th>Thao tác</th>
                </tr>
                </tfoot>
            </table>
            @if(method_exists($lstArticle, 'links')) {!! $lstArticle->links() !!} @endif
        </div>
        <!-- /.box-body -->
    </div>
    <!-- /.box -->
@endsection


@section('main-script')
    <script>
        $(function () {
            let startDate = "{!! $startDate !!}";
            if(!startDate) startDate = moment().subtract(30, 'days');
            let endDate = "{!! $endDate !!}";
            if (!endDate) endDate = moment();
            $('#reservation').daterangepicker({
                startDate: startDate,
                endDate: endDate,
                minDate: moment().subtract(6, 'months'),
                maxDate: moment(),
                autoApply: true,
            });
            $(".select2").select2({
                minimumResultsForSearch: Infinity
            });
        })
    </script>
@endsection
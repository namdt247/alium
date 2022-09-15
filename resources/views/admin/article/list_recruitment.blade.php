
@extends('admin.layout_master')

@section('main-header')
    <h1>Bài viết tuyển dụng<small>danh sách</small></h1>
@endsection

@section('main-content')
    
    <div class="box">
        <div class="box-body">
            <table id="example2" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Ảnh đại diện</th>
                    <th>Tiêu đề</th>
                    <th>Người tạo</th>
                    <th>Ngày xuất bản</th>
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
                    <td>
                        <i class="fa fa-pencil fa-fw"></i>
                        <a href="{!! route('admin.article.getEditRecruitment',$article->atc_id) !!}" 
                            target="_blank">Sửa</a>
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

@endsection
@extends('admin.layout_master')

@section('main-header')
    <h1 class="page-header">Quản trị viên <small>Thêm mới</small></h1>
@endsection

@section('main-content')
    <form action="" id="addUserManage" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Email (<span class="text-danger">*</span>) </label>
                    <input class="form-control" name="txtEmail" value="{!! old('txtEmail') !!}" required/>
                </div>
            </div>
        </div>
        <div class="row hidden">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Mật khẩu (<span class="text-danger">*</span>) </label>
                    <input class="form-control" type="password" name="txtPassword" value="" required minlength="6"/>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Nhập lại mật khẩu (<span class="text-danger">*</span>) </label>
                    <input class="form-control" type="password" name="txtPassword_confirmation"
                           value="" required minlength="6"/>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Họ tên</label>
                    <input class="form-control" name="txtShowName" placeholder="Họ tên" value="{!! old('txtShowName') !!}"/>
                </div>
            </div>
        </div>
        @hasanyrole('super-admin|admin')
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label>Quản lí chuyên mục</label>
                    <?php $lstPermission = \Spatie\Permission\Models\Permission::all() ?>
                    <select class="form-control" name="sltPermission[]" id="sltPermission" multiple>
                        @foreach($lstPermission as $permission)
                            <option value="{!! $permission->name !!}">
                                {!! $permission->name !!}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        @endhasanyrole

        <button type="submit" class="btn btn-primary">Thêm mới</button>
    </form>
@endsection

@section('main-script')
    <script>
        $(document).ready(function() {
            $("#sltPermission").select2({
                closeOnSelect: false,
                allowClear: true
            });
            $("#addUserManage").validate({
                rules: {
                    txtEmail: {
                        required: true,
                        email: true
                    },
                }
            });
        });
    </script>
    @endsection
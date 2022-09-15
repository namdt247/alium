<?php
/**
 * Created by PhpStorm.
 * User: QuanVH
 * Date: 01/11/2016
 * Time: 22:39 CH
 */
        ?>
<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <li class="header">Danh mục</li>
            <li class="">
                <a href="{!! route('admin.dashboard') !!}">
                    <i class="fa fa-dashboard text-red"></i> <span>Bảng điều khiển</span>
                </a>
            </li>

            @role('admin|super-admin')
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-users text-red"></i>
                    <span>Quản lý người dùng</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li>
                        <a href="{!! route('admin.user.getListRegister') !!}">
                            <i class="fa fa-user"></i>Người dùng đăng ký
                        </a>
                    </li>
                    @role('admin|super-admin')
                    <li>
                        <a href="{!! route('admin.user.getListManage') !!}">
                            <i class="fa fa-user-secret"></i>Quản trị viên
                        </a>
                    </li>
                    @endrole
                </ul>
            </li>
            @endrole

            @can('editor')
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-rss text-red"></i>
                    <span>Quản lý tin tức</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li>
                        <a href="{!! route('admin.article.getAdd') !!}">
                            <i class="fa fa-plus"></i>Thêm tin
                        </a>
                    </li>
                    <li>
                        <a href="{!! route('admin.article.getList',1) !!}">
                            <i class="fa fa-list"></i>Câu chuyện alium
                        </a>
                    </li>
                    <li>
                        <a href="{!! route('admin.article.getList',2) !!}">
                            <i class="fa fa-youtube"></i>Video
                        </a>
                    </li>
                    <li>
                        <a href="{!! route('admin.tag.getList') !!}">
                            <i class="fa fa-tags"></i>Quản lí tag
                        </a>
                    </li>
                </ul>
            </li>
            @endcan

            @can('editor')
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-rss text-red"></i>
                    <span>Quản lý tuyển dụng</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li>
                        <a href="{!! route('admin.recruitment.getAdd') !!}">
                            <i class="fa fa-plus"></i>Thêm tin tuyển dụng
                        </a>
                    </li>
                    <li>
                        <a href="{!! route('admin.recruitment.getList') !!}">
                            <i class="fa fa-list"></i>Tin tuyển dụng
                        </a>
                    </li>
                </ul>
            </li>
            @endcan

            @can('supplier')
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-industry text-red"></i>
                    <span>Quản lí xưởng</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li>
                        <a href="{!! route('admin.supplier.getAdd') !!}">
                            <i class="fa fa-plus"></i>Thêm xưởng
                        </a>
                    </li>
                    <li>
                        <a href="{!! route('admin.supplier.getList') !!}">
                            <i class="fa fa-industry"></i>Danh sách xưởng SX
                        </a>
                    </li>
                </ul>
            </li>
            @endcan

            @if(auth()->user()->can('sale manager') || auth()->user()->can('editor'))
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-shopping-cart text-red"></i>
                    <span>Quản lý đặt sản xuất</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li>
                        <a href="{!! route('admin.user.getListUserSaleManager') !!}">
                            <i class="fa fa-user"></i>Người dùng đăng ký
                        </a>
                    </li>
                    <li>
                        <a href="{!! route('admin.product.list') !!}">
                            <i class="fa fa-product-hunt"></i>Dòng sản phẩm
                        </a>
                    </li>
                    @can('sale manager')
                    <li>
                        <a href="{!! route('admin.order.getList') !!}">
                            <i class="fa fa-cart-arrow-down"></i>Đặt sản xuất
                        </a>
                    </li>
                    @endcan
                </ul>
            </li>
            @endif

            @can('sale')
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-shopping-cart text-red"></i>
                    <span>Nhân viên kinh doanh</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li>
                        <a href="{!! route('admin.user.getListUserRegisterSale') !!}">
                            <i class="fa fa-user"></i>Danh sách người dùng
                        </a>
                    </li>
                    <li>
                        <a href="{!! route('admin.order.getAdd') !!}">
                            <i class="fa fa-cart-arrow-down"></i>Thêm đơn hàng
                        </a>
                    </li>
                    <li>
                        <a href="{!! route('admin.sale.getListOrder') !!}">
                            <i class="fa fa-cart-arrow-down"></i>Danh sách đơn hàng
                        </a>
                    </li>
                </ul>
            </li>
            @endcan

            @can('supplier')
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-shopping-cart text-red"></i>
                    <span>Nhân viên xưởng</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li>
                        <a href="{!! route('admin.supplier.getListOrder') !!}">
                            <i class="fa fa-cart-arrow-down"></i>Danh sách đơn hàng
                        </a>
                    </li>
                </ul>
            </li>
            @endcan

            @can('editor')
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-file-word-o text-red"></i>
                    <span>Quản lý trang tĩnh</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li>
                        <a href="{!! route('admin.config.getEditPage',106) !!}">
                            <i class="fa fa-file-word-o"></i>Hướng dẫn đặt sản xuất
                        </a>
                    </li>
                    <li>
                        <a href="{!! route('admin.config.getEditPage',107) !!}">
                            <i class="fa fa-file-word-o"></i>Hướng dẫn đăng ký xưởng
                        </a>
                    </li>
                    <li>
                        <a href="{!! route('admin.config.getEditPage',100) !!}">
                            <i class="fa fa-file-word-o"></i>Thanh toán
                        </a>
                    </li>
                    <li>
                        <a href="{!! route('admin.config.getEditPage',101) !!}">
                            <i class="fa fa-file-word-o"></i>Giới thiệu về Alium
                        </a>
                    </li>
                    <li>
                        <a href="{!! route('admin.config.getEditPage',102) !!}">
                            <i class="fa fa-file-word-o"></i>Điều khoản Alium
                        </a>
                    </li>
                    <li>
                        <a href="{!! route('admin.config.getEditPage',103) !!}">
                            <i class="fa fa-file-word-o"></i>Chính sách bảo mật
                        </a>
                    </li>
                    <li>
                        <a href="{!! route('admin.config.getEditPage',104) !!}">
                            <i class="fa fa-file-word-o"></i>Cài đặt tài khoản
                        </a>
                    </li>
                    {{-- <li>
                        <a href="{!! route('admin.config.getEditPage',105) !!}">
                            <i class="fa fa-file-word-o"></i>Tuyển dụng
                        </a>
                    </li> --}}
                    <li>
                        <a href="{!! route('admin.config.getEditLocale',99) !!}">
                            <i class="fa fa-file-word-o"></i>Thông tin footer
                        </a>
                    </li>
                </ul>
            </li>
            @endcan

            @can('customer care')
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-comments text-red"></i>
                    <span>Phản hồi khách hàng</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li>
                        <a href="{!! route('admin.feedback.getList') !!}">
                            <i class="fa fa-comments"></i> Danh sách phản hồi
                        </a>
                    </li>
                    <li>
                        <a href="{!! route('admin.rate.getList') !!}">
                            <i class="fa fa-star"></i>Quản lí đánh giá xưởng
                        </a>
                    </li>
                </ul>
            </li>
            @endcan

            @role('super-admin')
            <li class="treeview hidden">
                <a href="#">
                    <i class="fa fa-files-o text-red"></i>
                    <span>Thống kê/báo cáo</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li>
                        <a href="#">
                            <i class="fa fa-circle-o"></i> Khách hàng
                        </a>
                    </li>
                </ul>
            </li>

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-lock text-red"></i>
                    <span>Super admin</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li>
                        <a href="{!! route('admin.product.cate.getList') !!}">
                            <i class="fa fa-lock"></i> Danh mục sản phẩm
                        </a>
                    </li>
                    <li>
                        <a href="{!! route('admin.product.cate.getAdd') !!}">
                            <i class="fa fa-lock"></i> Thêm danh mục SP
                        </a>
                    </li>
                    <li>
                        <a href="{!! route('admin.product.getAdd') !!}">
                            <i class="fa fa-lock"></i> Thêm sản phẩm
                        </a>
                    </li>
                    <li>
                        <a href="{!! route('admin.article.cate.getList') !!}">
                            <i class="fa fa-lock"></i> Danh mục tin tức
                        </a>
                    </li>
                    <li>
                        <a href="{!! route('admin.article.cate.getAdd') !!}">
                            <i class="fa fa-lock"></i> Thêm danh mục tin
                        </a>
                    </li>
                    <li>
                        <a href="{!! route('admin.user.getList') !!}">
                            <i class="fa fa-lock"></i> Danh sách user
                        </a>
                    </li>
                    <li>
                        <a href="{!! route('admin.config.getList') !!}">
                            <i class="fa fa-lock"></i> Chỉnh sửa cấu hình
                        </a>
                    </li>
                    <li>
                        <a href="/docs/index.html" target="_blank">
                            <i class="fa fa-anchor"></i> APIs Docs
                        </a>
                    </li>
                </ul>
            </li>
            @endrole
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>


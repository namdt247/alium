<?php

use Illuminate\Database\Seeder;

class ConfigTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('config')->insert([
            array(
                'cfg_id' => 1,
                'cfg_name' => 'version',
                'cfg_alias' => null,
                'cfg_order' => 0,
                'cfg_value' => serialize([
                    'en' => [
                        1 => ['id' => 1, 'name' => '0.1.1-alpha','title' => 'Version','icon' => ''],
                    ],
                    'vi' => [
                        1 => ['id' => 1, 'name' => '0.1.1-alpha','title' => 'Phiên bản','icon' => ''],
                    ]
                ]),
            ),
            array(
                'cfg_id' => 2,
                'cfg_name' => 'time feedback supplier',
                'cfg_alias' => null,
                'cfg_order' => 0,
                'cfg_value' => serialize([
                    'en' => [
                        1 => ['id' => 1, 'name' => 4*3600,'title' => 'Time supplier feedback','icon' => ''],
                    ],
                    'vi' => [
                        1 => ['id' => 1, 'name' => 4*3600,'title' => 'Thời gian phản hồi từ xưởng','icon' => ''],
                    ]
                ]),
            ),
            array(
                'cfg_id' => 3,
                'cfg_name' => 'Supplier quality',
                'cfg_alias' => null,
                'cfg_order' => 0,
                'cfg_value' => serialize([
                    'en' => [
                        1 => ['id' => 1, 'name' => 'Hàng trung bình','title' => '','icon' => ''],
                        2 => ['id' => 2, 'name' => 'Hàng chất lượng khá, bán shop thông thường, không QA-AC'
                            ,'title' => '','icon' => ''],
                        3 => ['id' => 3, 'name' => 'Hàng chất lượng tốt, bán shop cao cấp','title' => '','icon' => ''],
                        4 => ['id' => 4, 'name' => 'Hàng xuất khẩu','title' => '','icon' => ''],
                        5 => ['id' => 5, 'name' => 'Tuỳ theo đơn hàng','title' => '','icon' => ''],
                    ],
                    'vi' => [
                        1 => ['id' => 1, 'name' => 'Hàng trung bình','title' => '','icon' => ''],
                        2 => ['id' => 2, 'name' => 'Hàng chất lượng khá, bán shop thông thường, không QA-AC',
                            'title' => '','icon' => ''],
                        3 => ['id' => 3, 'name' => 'Hàng chất lượng tốt, bán shop cao cấp','title' => '','icon' => ''],
                        4 => ['id' => 4, 'name' => 'Hàng xuất khẩu','title' => '','icon' => ''],
                        5 => ['id' => 5, 'name' => 'Tuỳ theo đơn hàng','title' => '','icon' => ''],
                    ]
                ])
            ),
            array(
                'cfg_id' => 4,
                'cfg_name' => 'supplier type',
                'cfg_alias' => null,
                'cfg_order' => 0,
                'cfg_value' => serialize([
                    'en' => [
                        1 => ['id' => 1, 'name' => 'Nhận gia công cắt - may - hoàn thiện','title' => '','icon' => ''],
                        2 => ['id' => 2, 'name' => 'Nhận gia công (lên mẫu - cắt may - hoàn thiện - đóng gói)',
                            'title' => '','icon' => ''],
                        3 => ['id' => 3, 'name' => 'Nhận sản xuất trọn gói (tự cung cấp vải + lên mẫu + cắt may hoàn thiện sản phẩm)',
                            'title' => '','icon' => ''],
                        4 => ['id' => 4, 'name' => 'Làm được tất cả theo yêu cầu thoả thuận','title' => '','icon' => ''],
                    ],
                    'vi' => [
                        1 => ['id' => 1, 'name' => 'Nhận gia công cắt - may - hoàn thiện','title' => '','icon' => ''],
                        2 => ['id' => 2, 'name' => 'Nhận gia công (lên mẫu - cắt may - hoàn thiện - đóng gói)',
                            'title' => '','icon' => ''],
                        3 => ['id' => 3, 'name' => 'Nhận sản xuất trọn gói (tự cung cấp vải + lên mẫu + cắt may hoàn thiện sản phẩm)',
                            'title' => '','icon' => ''],
                        4 => ['id' => 4, 'name' => 'Làm được tất cả theo yêu cầu thoả thuận','title' => '','icon' => ''],
                    ]
                ])
            ),
            array(
                'cfg_id' => 5,
                'cfg_name' => 'business lisence',
                'cfg_alias' => null,
                'cfg_order' => 0,
                'cfg_value' => serialize([
                    'en' => [
                        1 => ['id' => 1, 'name' => 'Có giấy phép kinh doanh, có xuất hoá đơn đỏ','title' => '','icon' => ''],
                        2 => ['id' => 2, 'name' => 'Có đăng ký kinh doanh, không xuất hoá đơn đỏ','title' => '','icon' => ''],
                        3 => ['id' => 3, 'name' => 'Không có giấy phép kinh doanh','title' => '','icon' => ''],
                        4 => ['id' => 4, 'name' => 'Khác','title' => '','icon' => ''],
                    ],
                    'vi' => [
                        1 => ['id' => 1, 'name' => 'Có giấy phép kinh doanh, có xuất hoá đơn đỏ','title' => '','icon' => ''],
                        2 => ['id' => 2, 'name' => 'Có đăng ký kinh doanh, không xuất hoá đơn đỏ','title' => '','icon' => ''],
                        3 => ['id' => 3, 'name' => 'Không có giấy phép kinh doanh','title' => '','icon' => ''],
                        4 => ['id' => 4, 'name' => 'Khác','title' => '','icon' => ''],
                    ]
                ])
            ),
//            array(
//                'cfg_id' => 6,
//                'cfg_name' => 'Order status',
//                'cfg_alias' => null,
//                'cfg_value' => serialize([
//                    'en' => [
//                        1 => ['id' => 1, 'name' => 'Đang tìm xưởng','title' => '','icon' => ''],
//                        2 => ['id' => 2, 'name' => 'Đã tìm thấy xưởng','title' => '','icon' => ''],
//                        3 => ['id' => 3, 'name' => 'Lên mẫu','title' => '','icon' => ''],
//                        4 => ['id' => 4, 'name' => 'Đang sản xuất','title' => '','icon' => ''],
//                        5 => ['id' => 5, 'name' => 'Đang vận chuyển','title' => '','icon' => ''],
//                        6 => ['id' => 6, 'name' => 'Nhận hàng','title' => '','icon' => ''],
//                        7 => ['id' => 7, 'name' => 'Hoàn thành','title' => '','icon' => ''],
//                        8 => ['id' => 8, 'name' => 'Hủy','title' => '','icon' => ''],
//                    ],
//                    'vi' => [
//                        1 => ['id' => 1, 'name' => 'Đang tìm xưởng','title' => '','icon' => ''],
//                        2 => ['id' => 2, 'name' => 'Đã tìm thấy xưởng','title' => '','icon' => ''],
//                        3 => ['id' => 3, 'name' => 'Lên mẫu','title' => '','icon' => ''],
//                        4 => ['id' => 4, 'name' => 'Đang sản xuất','title' => '','icon' => ''],
//                        5 => ['id' => 5, 'name' => 'Đang vận chuyển','title' => '','icon' => ''],
//                        6 => ['id' => 6, 'name' => 'Nhận hàng','title' => '','icon' => ''],
//                        7 => ['id' => 7, 'name' => 'Hoàn thành','title' => '','icon' => ''],
//                        8 => ['id' => 8, 'name' => 'Hủy','title' => '','icon' => ''],
//                    ]
//                ])
//            ),
            array(
                'cfg_id' => 7,
                'cfg_name' => 'Order quality',
                'cfg_alias' => null,
                'cfg_order' => 0,
                'cfg_value' => serialize([
                    'en' => [
                        1 => ['id' => 1, 'name' => 'Trung bình','title' => '','icon' => ''],
                        2 => ['id' => 2, 'name' => 'Khá','title' => '','icon' => ''],
                        3 => ['id' => 3, 'name' => 'Cao','title' => '','icon' => ''],
                        4 => ['id' => 4, 'name' => 'Xuất khẩu','title' => '','icon' => ''],
                    ],
                    'vi' => [
                        1 => ['id' => 1, 'name' => 'Trung bình','title' => '','icon' => ''],
                        2 => ['id' => 2, 'name' => 'Khá','title' => '','icon' => ''],
                        3 => ['id' => 3, 'name' => 'Cao','title' => '','icon' => ''],
                        4 => ['id' => 4, 'name' => 'Xuất khẩu','title' => '','icon' => ''],
                    ]
                ])
            ),
            array(
                'cfg_id' => 8,
                'cfg_name' => 'Order type require',
                'cfg_alias' => null,
                'cfg_order' => 0,
                'cfg_value' => serialize([
                    'en' => [
                        1 => ['id' => 1, 'name' => 'Thiết kế rập và đi sơ đồ','title' => '','icon' => ''],
                        2 => ['id' => 2, 'name' => 'Cắt','title' => '','icon' => ''],
                        3 => ['id' => 3, 'name' => 'May','title' => '','icon' => ''],
                        4 => ['id' => 4, 'name' => 'Gập, là, đóng gói','title' => '','icon' => ''],
                        5 => ['id' => 5, 'name' => 'Nguyên liệu','title' => '','icon' => ''],
                        6 => ['id' => 6, 'name' => 'Phụ liệu','title' => '','icon' => ''],
                    ],
                    'vi' => [
                        1 => ['id' => 1, 'name' => 'Thiết kế rập và đi sơ đồ','title' => '','icon' => ''],
                        2 => ['id' => 2, 'name' => 'Cắt','title' => '','icon' => ''],
                        3 => ['id' => 3, 'name' => 'May','title' => '','icon' => ''],
                        4 => ['id' => 4, 'name' => 'Gập, là, đóng gói','title' => '','icon' => ''],
                        5 => ['id' => 5, 'name' => 'Nguyên liệu','title' => '','icon' => ''],
                        6 => ['id' => 6, 'name' => 'Phụ liệu','title' => '','icon' => ''],
                    ]
                ])
            ),
            array(
                'cfg_id' => 9,
                'cfg_name' => 'Order other require',
                'cfg_alias' => null,
                'cfg_order' => 0,
                'cfg_value' => serialize([
                    'en' => [
                        1 => ['id' => 1, 'name' => 'In','title' => '','icon' => ''],
                        2 => ['id' => 2, 'name' => 'Thêu','title' => '','icon' => ''],
                    ],
                    'vi' => [
                        1 => ['id' => 1, 'name' => 'In','title' => '','icon' => ''],
                        2 => ['id' => 2, 'name' => 'Thêu','title' => '','icon' => ''],
                    ]
                ])
            ),
            array(
                'cfg_id' => 10,
                'cfg_name' => 'Order payment method',
                'cfg_alias' => null,
                'cfg_order' => 0,
                'cfg_value' => serialize([
                    'en' => [
                        1 => ['id' => 1, 'name' => 'Chuyển khoản','title' => '','icon' => ''],
                        2 => ['id' => 2, 'name' => 'Thanh toán trực tiếp','title' => '','icon' => ''],
                    ],
                    'vi' => [
                        1 => ['id' => 1, 'name' => 'Chuyển khoản','title' => '','icon' => ''],
                        2 => ['id' => 2, 'name' => 'Thanh toán trực tiếp','title' => '','icon' => ''],
                    ]
                ])
            ),
            array(
                'cfg_id' => 11,
                'cfg_name' => 'Rate order status',
                'cfg_alias' => null,
                'cfg_order' => 0,
                'cfg_value' => serialize([
                    'en' => [
                        1 => ['id' => 1, 'name' => 'Mới','title' => '','icon' => ''],
                        2 => ['id' => 2, 'name' => 'Đã duyệt','title' => '','icon' => ''],
                        3 => ['id' => 3, 'name' => 'Không duyệt','title' => '','icon' => ''],
                    ],
                    'vi' => [
                        1 => ['id' => 1, 'name' => 'Mới','title' => '','icon' => ''],
                        2 => ['id' => 2, 'name' => 'Đã duyệt','title' => '','icon' => ''],
                        3 => ['id' => 3, 'name' => 'Không duyệt','title' => '','icon' => ''],
                    ]
                ])
            ),


            array(
                'cfg_id' => 30,
                'cfg_name' => 'Cate feedback',
                'cfg_alias' => null,
                'cfg_order' => 0,
                'cfg_value' => serialize([
                    'en' => [
                        1 => ['id' => 1, 'name' => 'Câu hỏi chung','title' => '','icon' => ''],
                        2 => ['id' => 2, 'name' => 'Báo lỗi website','title' => '','icon' => ''],
                        3 => ['id' => 3, 'name' => 'Báo cáo vấn đề đơn hàng','title' => '','icon' => ''],
                    ],
                    'vi' => [
                        1 => ['id' => 1, 'name' => 'Câu hỏi chung','title' => '','icon' => ''],
                        2 => ['id' => 2, 'name' => 'Báo lỗi website','title' => '','icon' => ''],
                        3 => ['id' => 3, 'name' => 'Báo cáo vấn đề đơn hàng','title' => '','icon' => ''],
                    ]
                ])
            ),
            array(
                'cfg_id' => 31,
                'cfg_name' => 'Status feedback',
                'cfg_alias' => null,
                'cfg_order' => 0,
                'cfg_value' => serialize([
                    'en' => [
                        1 => ['id' => 1, 'name' => 'Mới','title' => '','icon' => ''],
                        2 => ['id' => 2, 'name' => 'Đang xử lí','title' => '','icon' => ''],
                        3 => ['id' => 3, 'name' => 'Đã xử lí','title' => '','icon' => ''],
                    ],
                    'vi' => [
                        1 => ['id' => 1, 'name' => 'Mới','title' => '','icon' => ''],
                        2 => ['id' => 2, 'name' => 'Đang xử lí','title' => '','icon' => ''],
                        3 => ['id' => 3, 'name' => 'Đã xử lí','title' => '','icon' => ''],
                    ]
                ])
            ),


            array(
                'cfg_id' => 99,
                'cfg_name' => 'Thông tin footer',
                'cfg_alias' => null,
                'cfg_order' => 0,
                'cfg_value' => serialize([
                    'en' => [
                        1 => ['id' => 1, 'title' => 'Address', 'name' => 'Số 21/Ngõ 1/48 Phạm Tuấn Tài, Cầu Giấy, Hà Nội',
                            'icon' => 'map-marker'],
                        2 => ['id' => 2, 'title' => 'Phone', 'name' => '0967934206', 'icon' => 'phone'],
                        3 => ['id' => 3, 'title' => 'Email', 'name' => 'info@alium.vn', 'icon' => 'envelope'],
                        4 => ['id' => 4, 'title' => 'Facebook', 'name' => '', 'icon' => 'facebook-f'],
                        5 => ['id' => 5, 'title' => 'Youtube', 'name' => '', 'icon' => 'youtube'],
                        6 => ['id' => 6, 'title' => 'Google+', 'name' => '', 'icon' => 'google-plus'],
                        7 => ['id' => 7, 'title' => 'Linkin', 'name' => '', 'icon' => 'linkedin'],
                        8 => ['id' => 8, 'title' => 'Instagram', 'name' => '', 'icon' => 'instagram'],
                    ],
                    'vi' => [
                        1 => ['id' => 1, 'title' => 'Địa chỉ', 'name' => 'Số 21/Ngõ 1/48 Phạm Tuấn Tài, Cầu Giấy, Hà Nội',
                            'icon' => 'map-marker'],
                        2 => ['id' => 2, 'title' => 'Điện thoại', 'name' => '0967934206', 'icon' => 'phone'],
                        3 => ['id' => 3, 'title' => 'Email', 'name' => 'info@alium.vn', 'icon' => 'envelope'],
                        4 => ['id' => 4, 'title' => 'Facebook', 'name' => '', 'icon' => 'facebook-f'],
                        5 => ['id' => 5, 'title' => 'Youtube', 'name' => '', 'icon' => 'youtube'],
                        6 => ['id' => 6, 'title' => 'Google+', 'name' => '', 'icon' => 'google-plus'],
                        7 => ['id' => 7, 'title' => 'Linkin', 'name' => '', 'icon' => 'linkedin'],
                        8 => ['id' => 8, 'title' => 'Instagram', 'name' => '', 'icon' => 'instagram'],
                    ]
                ])
            ),
            //start from 100, for static page content
            array(
                'cfg_id' => 100,
                'cfg_name' => 'Thanh toán',
                'cfg_alias' => 'thanh-toan',
                'cfg_order' => 0,
                'cfg_value' => serialize([
                    'en' => [
                        1 => ['id' => 1, 'name' => '<p>ALIUM là ứng dụng được tạo ra nhằm dành riêng cho việc cung cấp trải 
                        nghiệm tìm kiếm xưởng may đơn giản và không gây căng thẳng cho những khách hàng đang có nhu cầu 
                        đặt sản xuất về may mặc.</p>','title' => 'Payment guide','icon' => ''],
                    ],
                    'vi' => [
                        1 => ['id' => 1, 'name' => '<p>ALIUM là ứng dụng được tạo ra nhằm dành riêng cho việc cung cấp trải 
                        nghiệm tìm kiếm xưởng may đơn giản và không gây căng thẳng cho những khách hàng đang có nhu cầu 
                        đặt sản xuất về may mặc.</p>','title' => 'Hướng dẫn thanh toán','icon' => ''],
                    ]
                ]),
            ),
            array(
                'cfg_id' => 101,
                'cfg_name' => 'Giới thiệu về Alium',
                'cfg_alias' => 've-alium',
                'cfg_order' => 1,
                'cfg_value' => serialize([
                    'en' => [
                        1 => ['id' => 1, 'name' => '','title' => 'Introduce','icon' => ''],
                    ],
                    'vi' => [
                        1 => ['id' => 1, 'name' => '','title' => 'Giới thiệu','icon' => ''],
                    ]
                ]),
            ),
            array(
                'cfg_id' => 102,
                'cfg_name' => 'Điều khoản Alium',
                'cfg_alias' => 'dieu-khoan',
                'cfg_order' => 3,
                'cfg_value' => serialize([
                    'en' => [
                        1 => ['id' => 1, 'name' => '','title' => 'Contract','icon' => ''],
                    ],
                    'vi' => [
                        1 => ['id' => 1, 'name' => '','title' => 'Điều khoản Alium','icon' => ''],
                    ]
                ]),
            ),
            array(
                'cfg_id' => 103,
                'cfg_name' => 'Chính sách bảo mật',
                'cfg_alias' => 'chinh-sach-bao-mat',
                'cfg_order' => 4,
                'cfg_value' => serialize([
                    'en' => [
                        1 => ['id' => 1, 'name' => '','title' => 'Security','icon' => ''],
                    ],
                    'vi' => [
                        1 => ['id' => 1, 'name' => '','title' => 'Chính sách bảo mật','icon' => ''],
                    ]
                ]),
            ),
            array(
                'cfg_id' => 104,
                'cfg_name' => 'Cài đặt tài khoản',
                'cfg_alias' => 'cai-dat-tai-khoan',
                'cfg_order' => 0,
                'cfg_value' => serialize([
                    'en' => [
                        1 => ['id' => 1, 'name' => '','title' => 'Account setting','icon' => ''],
                    ],
                    'vi' => [
                        1 => ['id' => 1, 'name' => '','title' => 'Cài đặt tài khoản','icon' => ''],
                    ]
                ]),
            ),
            array(
                'cfg_id' => 105,
                'cfg_name' => 'Tuyển dụng',
                'cfg_alias' => 'tuyen-dung',
                'cfg_order' => 2,
                'cfg_value' => serialize([
                    'en' => [
                        1 => ['id' => 1, 'name' => '','title' => 'Recruitment','icon' => ''],
                    ],
                    'vi' => [
                        1 => ['id' => 1, 'name' => '','title' => 'Tuyển dụng','icon' => ''],
                    ]
                ]),
            ),
            array(
                'cfg_id' => 106,
                'cfg_name' => 'Hướng dẫn đặt sản xuất',
                'cfg_alias' => 'dat-san-xuat',
                'cfg_order' => 0,
                'cfg_value' => serialize([
                    'en' => [
                        1 => ['id' => 1, 'name' => '','title' => 'Create order guide','icon' => ''],
                    ],
                    'vi' => [
                        1 => ['id' => 1, 'name' => '','title' => 'Hướng dẫn đặt sản xuất','icon' => ''],
                    ]
                ]),
            ),
            array(
                'cfg_id' => 107,
                'cfg_name' => 'Hướng dẫn đăng ký xưởng',
                'cfg_alias' => 'dang-ky-xuong',
                'cfg_order' => 0,
                'cfg_value' => serialize([
                    'en' => [
                        1 => ['id' => 1, 'name' => '','title' => 'Register supplier guide','icon' => ''],
                    ],
                    'vi' => [
                        1 => ['id' => 1, 'name' => '','title' => 'Hướng dẫn đăng ký xưởng','icon' => ''],
                    ]
                ]),
            ),
        ]);
    }
}

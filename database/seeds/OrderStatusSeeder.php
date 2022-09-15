<?php

use Illuminate\Database\Seeder;

class OrderStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('order_status')->truncate();
        DB::table('order_status')->insert([
            array(
                'stt_id' => 1,
                'stt_name' => 'Xác nhận',
                'stt_valueA' => 'Xác nhận',
                'stt_valueF' => 'Xác nhận',
                'stt_timeSchedule' => '',
                'stt_parent' => 0,
                'stt_order' => 1,
                'stt_action' => '',
                'stt_notify' => '',
                'stt_nameAction' => 'Xác nhận',
            ),

            array(
                'stt_id' => 2,
                'stt_name' => 'Tìm xưởng',
                'stt_valueA' => 'Tìm xưởng',
                'stt_valueF' => 'Tìm xưởng',
                'stt_timeSchedule' => 48,
                'stt_parent' => 0,
                'stt_order' => 2,
                'stt_action' => '',
                'stt_notify' => '',
                'stt_nameAction' => 'Tìm xưởng',
            ),

            array(
                'stt_id' => 3,
                'stt_name' => 'Chờ thanh toán',
                'stt_valueA' => 'Chờ thanh toán',
                'stt_valueF' => 'Chờ thanh toán',
                'stt_timeSchedule' => '',
                'stt_parent' => 0,
                'stt_order' => 3,
                'stt_action' => '',
                'stt_notify' => '',
                'stt_nameAction' => 'Chờ thanh toán',
            ),

            array(
                'stt_id' => 4,
                'stt_name' => 'Lên mẫu',
                'stt_valueA' => 'Lên mẫu',
                'stt_valueF' => 'Lên mẫu',
                'stt_timeSchedule' => '',
                'stt_parent' => 0,
                'stt_order' => 4,
                'stt_action' => '',
                'stt_notify' => '',
                'stt_nameAction' => 'Lên mẫu',
            ),

            array(
                'stt_id' => 5,
                'stt_name' => 'Sản xuất',
                'stt_valueA' => 'Sản xuất',
                'stt_valueF' => 'Sản xuất',
                'stt_timeSchedule' => '',
                'stt_parent' => 0,
                'stt_order' => 5,
                'stt_action' => '',
                'stt_notify' => '',
                'stt_nameAction' => 'Sản xuất',
            ),

            array(
                'stt_id' => 6,
                'stt_name' => 'Vận chuyển',
                'stt_valueA' => 'Vận chuyển',
                'stt_valueF' => 'Vận chuyển',
                'stt_timeSchedule' => '',
                'stt_parent' => 0,
                'stt_order' => 6,
                'stt_action' => '',
                'stt_notify' => '',
                'stt_nameAction' => 'Vận chuyển',
            ),

            array(
                'stt_id' => 7,
                'stt_name' => 'Hoàn thành',
                'stt_valueA' => 'Hoàn thành',
                'stt_valueF' => 'Hoàn thành',
                'stt_timeSchedule' => '',
                'stt_parent' => 0,
                'stt_order' => 7,
                'stt_action' => '',
                'stt_notify' => '',
                'stt_nameAction' => 'Hoàn thành',
            ),

            array(
                'stt_id' => 8,
                'stt_name' => 'Hủy',
                'stt_valueA' => 'Hủy',
                'stt_valueF' => 'Hủy',
                'stt_timeSchedule' => '',
                'stt_parent' => 0,
                'stt_order' => 8,
                'stt_action' => '',
                'stt_notify' => '',
                'stt_nameAction' => 'Hủy',
            ),

            array(
                'stt_id' => 9,
                'stt_name' => 'Chờ xác nhận',
                'stt_valueA' => 'Chờ xác nhận',
                'stt_valueF' => 'Chờ xác nhận',
                'stt_timeSchedule' => '',
                'stt_parent' => 1,
                'stt_order' => 1,
                'stt_action' => serialize([
                    'sale manager' => [],
                    'frontend' => [34],
                    'sale' => [36,34],
                    'supplier' => [],
                    'factory' => [],
                ]),
                'stt_notify' => serialize([
                    'sale manager' => [
                        'msTitle' => '%s - %s - Đơn sản xuất mới',
                        'msMessage' =>'KH đặt mới đơn sản xuất %s - %s',
                        'msUrl' => '',
                        'msSale' => '%s'
                    ],
                    'frontend' => [],
                    'sale' => [
                        'msTitle' => '%s - %s - Đơn sản xuất mới',
                        'msMessage' =>'KH đặt mới đơn sản xuất %s - %s',
                        'msUrl' => '',
                        'msSale' => '%s'
                    ],
                    'supplier' => [],
                    'factory' => [],
                ]),
                'stt_nameAction' => 'Xác nhận đơn hàng',
            ),
            array(
                'stt_id' => 36,
                'stt_name' => 'Đã xác nhận',
                'stt_valueA' => 'Xác nhận',
                'stt_valueF' => 'Xác nhận',
                'stt_timeSchedule' => '',
                'stt_parent' => 1,
                'stt_order' => 2,
                'stt_action' => serialize([
                    'sale manager' => [],
                    'frontend' => [],
                    'sale' => [10],
                    'supplier' => [],
                    'factory' => [],
                ]),
                'stt_notify' => serialize([
                    'sale manager' => [
                        'msTitle' => '%s - %s - Đơn hàng đã được xác nhận',
                        'msMessage' =>'%s - %s - Đơn hàng đã được xác nhận',
                        'msUrl' => '',
                        'msSale' => '%s'
                    ],
                    'frontend' => [],
                    'sale' => [
                    ],
                    'supplier' => [],
                    'factory' => [],
                ]),
                'stt_nameAction' => 'Xác nhận đơn hàng',
            ),

            array(
                'stt_id' => 10,
                'stt_name' => 'Tìm xưởng',
                'stt_valueA' => 'Tìm xưởng',
                'stt_valueF' => 'Tìm xưởng',
                'stt_timeSchedule' => 48,
                'stt_parent' => 2,
                'stt_order' => 1,
                'stt_action' => serialize([
                    'sale manager' => [],
                    'frontend' => [34],
                    'sale' => [],
                    'supplier' => [11,34],
                    'factory' => [],
                ]),
                'stt_notify' => serialize([
                    'sale manager' => [
                        'msTitle' => '%s - %s - Tìm đơn vị sản xuất',
                        'msMessage' =>'Tìm đơn vị sản xuất cho đơn hàng %s - %s',
                        'msUrl' => '',
                        'msSale' => '%s'
                    ],
                    'frontend' => [],
                    'sale' => '',
                    'supplier' => [
                        'msTitle' => '%s - %s - Tìm đơn vị sản xuất',
                        'msMessage' =>'Tìm đơn vị sản xuất cho đơn hàng %s - %s',
                        'msUrl' => '',
                        'msSale' => '%s'
                    ],
                    'factory' => [],
                ]),
                'stt_nameAction' => 'Tìm xưởng',
            ),

            array(
                'stt_id' => 11,
                'stt_name' => 'Đã tìm thấy xưởng',
                'stt_valueA' => 'Đã tìm thấy xưởng',
                'stt_valueF' => 'Tìm xưởng',
                'stt_timeSchedule' => '',
                'stt_parent' => 2,
                'stt_order' => 2,
                'stt_action' => serialize([
                    'sale manager' => [12],
                    'frontend' => [34],
                    'sale' => [],
                    'supplier' => [],
                    'factory' => [],
                ]),
                'stt_notify' => serialize([
                    'sale manager' => [
                        'msTitle' => '%s - %s - Đã tìm được đơn vị sản xuất',
                        'msMessage' =>'Đã tìm đơn vị sản xuất cho đơn hàng %s - %s',
                        'msUrl' => '',
                        'msSale' => '%s'
                    ],
                    'frontend' => [],
                    'sale' => [],
                    'supplier' => [],
                    'factory' => [],
                ]),
                'stt_nameAction' => 'Tìm xưởng',
            ),

            array(
                'stt_id' => 12,
                'stt_name' => 'Đã báo giá',
                'stt_valueA' => 'Đã báo giá',
                'stt_valueF' => 'Đã tìm thấy xưởng',
                'stt_timeSchedule' => 48,
                'stt_parent' => 2,
                'stt_order' => 3,
                'stt_action' => serialize([
                    'sale manager' => [],
                    'frontend' => [13,34],
                    'sale' => [],
                    'supplier' => [],
                    'factory' => [],
                ]),
                'stt_notify' => serialize([
                    'sale manager' => [
                        'msTitle' => 'Đã tìm thấy xưởng',
                        'msMessage' =>'Đơn hàng đã tìm được 3 xưởng phù hợp.',
                        'msUrl' => '',
                        'msSale' => '',
                        'action' => 'Xử lí đơn hàng'
                    ],
                    'frontend' => [
                        'msTitle' => 'Đã tìm thấy xưởng',
                        'msMessage' =>'Đơn hàng của bạn đã tìm được 3 xưởng phù hợp. Vui lòng chọn 1 trong 3 xưởng Alium đề xuất',
                        'msUrl' => '',
                        'msSale' => '',
                        'action' => 'Xử lí đơn hàng'
                    ],
                    'sale' => [
                        'msTitle' => 'Đã tìm thấy xưởng',
                        'msMessage' =>'Đơn hàng của %s đã tìm được 3 xưởng phù hợp',
                        'msUrl' => '',
                        'msSale' => '',
                        'action' => 'Xử lí đơn hàng'
                    ],
                    'supplier' => [],
                    'factory' => [],
                ]),
                'stt_nameAction' => 'Đã tìm thấy xưởng',
            ),

            array(
                'stt_id' => 13,
                'stt_name' => 'Đã chọn xưởng',
                'stt_valueA' => 'Đã chọn xưởng',
                'stt_valueF' => 'Chờ thanh toán',
                'stt_timeSchedule' => 48,
                'stt_parent' => 3,
                'stt_order' => 1,
                'stt_action' => serialize([
                    'sale manager' => [],
                    'frontend' => [14,34],
                    'sale' => [],
                    'supplier' => [],
                    'factory' => [],
                ]),
                'stt_notify' => serialize([
                    'sale manager' => [
                        'msTitle' => 'Đơn hàng %s đấu thầu thành công',
                        'msMessage' => 'Đơn hàng %s đã được khách hàng lựa chọn',
                        'msUrl' => '',
                    ],
                    'frontend' => [],
                    'sale' => [
                        'msTitle' => 'Đơn hàng %s đấu thầu thành công',
                        'msMessage' => 'Đơn hàng %s đã được khách hàng lựa chọn',
                        'msUrl' => '',
                    ],
                    'supplier' => [],
                    'factory' => [
                        'msTitle' => 'Đơn hàng %s đấu thầu thành công',
                        'msMessage' => 'Đơn hàng %s đã được khách hàng lựa chọn',
                        'msUrl' => '',
                    ],
                ]),
                'stt_nameAction' => 'Chờ thanh toán',
            ),

            array(
                'stt_id' => 14,
                'stt_name' => 'Đã thanh toán',
                'stt_valueA' => 'Chờ xác nhận thanh toán lần 1',
                'stt_valueF' => 'Chờ thanh toán',
                'stt_timeSchedule' => '',
                'stt_parent' => 3,
                'stt_order' => 2,
                'stt_action' => serialize([
                    'sale manager' => [],
                    'frontend' => [34],
                    'sale' => [15],
                    'supplier' => [],
                    'factory' => [],
                ]),
                'stt_notify' => serialize([
                    'sale manager' => [
                        'msTitle' => 'Đơn hàng %s - %s - %s đang Chờ xác nhận thanh toán',
                        'msMessage' => 'Đơn hàng %s - %s - %s đang Chờ xác nhận thanh toán',
                        'msUrl' => '',
                        'msSale' => '%s'
                    ],
                    'frontend' => [],
                    'sale' => [
                        'msTitle' => 'Đơn hàng %s - %s - %s đang Chờ xác nhận thanh toán',
                        'msMessage' => 'Đơn hàng %s - %s - %s đang Chờ xác nhận thanh toán',
                        'msUrl' => '',
                        'msSale' => '%s'
                    ],
                    'supplier' => [],
                    'factory' => [],
                ]),
                'stt_nameAction' => 'Chờ thanh toán',
            ),

            array(
                'stt_id' => 15,
                'stt_name' => 'Lên mẫu',
                'stt_valueA' => 'Lên mẫu',
                'stt_valueF' => 'Lên mẫu',
                'stt_timeSchedule' => '',
                'stt_parent' => 4,
                'stt_order' => 1,
                'stt_action' => serialize([
                    'sale manager' => [],
                    'frontend' => [34],
                    'sale' => [],
                    'supplier' => [16],
                    'factory' => [],
                ]),
                'stt_notify' => serialize([
                    'sale manager' => [
                        'msTitle' => 'Đơn hàng %s - %s đang Chờ lên mẫu',
                        'msMessage' => 'Đơn hàng %s - %s đang Chờ lên mẫu',
                        'msUrl' => '',
                        'msSale' => '%s'
                    ],
                    'frontend' => [],
                    'sale' => [],
                    'supplier' => [
                        'msTitle' => 'Đơn hàng %s - %s đang Chờ lên mẫu',
                        'msMessage' => 'Đơn hàng %s - %s đang Chờ lên mẫu',
                        'msUrl' => '',
                        'msSale' => '%s'
                    ],
                    'factory' => [
                        'msTitle' => 'Đơn hàng %s đã chuyển sang trạng thái lên mẫu',
                        'msMessage' => 'Đơn hàng %s đã chuyển sang trạng thái lên mẫu',
                        'msUrl' => '',
                    ],
                ]),
                'stt_nameAction' => 'Lên mẫu',
            ),

            array(
                'stt_id' => 16,
                'stt_name' => 'Duyệt mẫu',
                'stt_valueA' => 'Duyệt mẫu',
                'stt_valueF' => 'Duyệt mẫu',
                'stt_timeSchedule' => '',
                'stt_parent' => 4,
                'stt_order' => 2,
                'stt_action' => serialize([
                    'sale manager' => [],
                    'frontend' => [17,34],
                    'sale' => [17],
                    'supplier' => [],
                    'factory' => [],
                ]),
                'stt_notify' => serialize([
                    'sale manager' => [
                        'msTitle' => 'Đơn hàng %s - %s - %s đang Chờ duyệt mẫu',
                        'msMessage' => 'Đơn hàng %s - %s - %s đang Chờ duyệt mẫu',
                        'msUrl' => '',
                        'msSale' => '%s'
                    ],
                    'frontend' => [],
                    'sale' => [
                        'msTitle' => 'Đơn hàng %s - %s - %s đang Chờ duyệt mẫu',
                        'msMessage' => 'Đơn hàng %s - %s - %s đang Chờ duyệt mẫu',
                        'msUrl' => '',
                        'msSale' => '%s'
                    ],
                    'supplier' => '',
                    'factory' => [],
                ]),
                'stt_nameAction' => 'Duyệt mẫu',
            ),

            array(
                'stt_id' => 17,
                'stt_name' => 'Sửa mẫu',
                'stt_valueA' => 'Sửa mẫu',
                'stt_valueF' => 'Sửa mẫu',
                'stt_timeSchedule' => '',
                'stt_parent' => 4,
                'stt_order' => 3,
                'stt_action' => serialize([
                    'sale manager' => [],
                    'frontend' => [34],
                    'sale' => [],
                    'supplier' => [18],
                    'factory' => [],
                ]),
                'stt_notify' => serialize([
                    'sale manager' => [
                        'msTitle' => 'Đơn hàng %s - %s đang Chờ sửa mẫu',
                        'msMessage' => 'Đơn hàng %s - %s đang Chờ sửa mẫu',
                        'msUrl' => '',
                        'msSale' => '%s'
                    ],
                    'frontend' => [],
                    'sale' => [],
                    'supplier' => [
                        'msTitle' => 'Đơn hàng %s - %s đang Chờ sửa mẫu',
                        'msMessage' => 'Đơn hàng %s - %s đang Chờ sửa mẫu',
                        'msUrl' => '',
                        'msSale' => '%s'
                    ],
                    'factory' => [
                        'msTitle' => 'Đơn hàng %s đã chuyển sang trạng thái sửa mẫu',
                        'msMessage' => 'Đơn hàng %s đã chuyển sang trạng thái sửa mẫu',
                        'msUrl' => '',
                    ],
                ]),
                'stt_nameAction' => 'Sửa mẫu',
            ),

            array(
                'stt_id' => 18,
                'stt_name' => 'Duyệt mẫu',
                'stt_valueA' => 'Duyệt mẫu',
                'stt_valueF' => 'Duyệt mẫu',
                'stt_timeSchedule' => '',
                'stt_parent' => 4,
                'stt_order' => 4,
                'stt_action' => serialize([
                    'sale manager' => [],
                    'frontend' => [34],
                    'sale' => [19],
                    'supplier' => [],
                    'factory' => [],
                ]),
                'stt_notify' => serialize([
                    'sale manager' => [
                        'msTitle' => 'Đơn hàng %s - %s - %s đang Chờ duyệt mẫu',
                        'msMessage' => 'Đơn hàng %s - %s - %s đang Chờ duyệt mẫu',
                        'msUrl' => '',
                        'msSale' => '%s'
                    ],
                    'frontend' => [],
                    'sale' => [
                        'msTitle' => 'Đơn hàng %s - %s - %s đang Chờ duyệt mẫu',
                        'msMessage' => 'Đơn hàng %s - %s - %s đang Chờ duyệt mẫu',
                        'msUrl' => '',
                        'msSale' => '%s'
                    ],
                    'supplier' => '',
                    'factory' => [],
                ]),
                'stt_nameAction' => 'Duyệt mẫu',
            ),

            array(
                'stt_id' => 19,
                'stt_name' => 'Chờ thanh toán',
                'stt_valueA' => 'Chờ thanh toán',
                'stt_valueF' => 'Chờ thanh toán',
                'stt_timeSchedule' => '',
                'stt_parent' => 4,
                'stt_order' => 5,
                'stt_action' => serialize([
                    'sale manager' => [],
                    'frontend' => [20,34],
                    'sale' => [],
                    'supplier' => [],
                    'factory' => [],
                ]),
                'stt_notify' => serialize([
                    'sale manager' => [
                        'msTitle' => 'Đơn hàng của bạn đang chờ thanh toán',
                        'msMessage' => 'Đơn hàng đang chờ xác nhận thanh toán',
                        'msUrl' => '',
                        'msSale' => '%s'
                    ],
                    'frontend' => [
                        'msTitle' => 'Đơn hàng của bạn đang chờ thanh toán',
                        'msMessage' => 'Đơn hàng đang chờ xác nhận thanh toán',
                        'msUrl' => '',
                        'msSale' => '%s'
                    ],
                    'sale' => [],
                    'supplier' => '',
                    'factory' => [],
                ]),
                'stt_nameAction' => 'Chờ thanh toán',
            ),

            array(
                'stt_id' => 20,
                'stt_name' => 'Chờ xác nhận thanh toán lần 2',
                'stt_valueA' => 'Chờ xác nhận thanh toán lần 2',
                'stt_valueF' => 'Chờ thanh toán',
                'stt_timeSchedule' => '',
                'stt_parent' => 4,
                'stt_order' => 6,
                'stt_action' => serialize([
                    'sale manager' => [],
                    'frontend' => [34],
                    'sale' => [21],
                    'supplier' => [],
                    'factory' => [],
                ]),
                'stt_notify' => serialize([
                    'sale manager' => [
                        'msTitle' => 'Đơn hàng %s - %s - %s đang Chờ xác nhận thanh toán',
                        'msMessage' => 'Đơn hàng %s - %s - %s đang Chờ xác nhận thanh toán',
                        'msUrl' => '',
                        'msSale' => '%s'
                    ],
                    'frontend' => [],
                    'sale' => [
                        'msTitle' => 'Đơn hàng %s - %s - %s đang Chờ xác nhận thanh toán',
                        'msMessage' => 'Đơn hàng %s - %s - %s đang Chờ xác nhận thanh toán',
                        'msUrl' => '',
                        'msSale' => '%s'
                    ],
                    'supplier' => '',
                    'factory' => [],
                ]),
                'stt_nameAction' => 'Chờ thanh toán',
            ),

            array(
                'stt_id' => 35,
                'stt_name' => 'Bắt đầu sản xuất',
                'stt_valueA' => 'Bắt đầu sản xuất',
                'stt_valueF' => 'Sản xuất',
                'stt_timeSchedule' => '',
                'stt_parent' => 5,
                'stt_order' => 1,
                'stt_action' => serialize([
                    'sale manager' => [],
                    'frontend' => [34],
                    'sale' => [],
                    'supplier' => [21,22,23,24,25,26,27],
                    'factory' => [21,22,23,24,25,26,27],
                ]),
                'stt_notify' => serialize([
                    'sale manager' => [
                        'msTitle' => 'Đơn hàng %s - %s đã được thanh toán',
                        'msMessage' => 'Đơn hàng %s - %s đã được thanh toán, đang chờ sản xuất',
                        'msUrl' => '',
                        'msSale' => '%s'
                    ],
                    'frontend' => [],
                    'sale' => [],
                    'supplier' => [
                        'msTitle' => 'Đơn hàng %s - %s đã được thanh toán',
                        'msMessage' => 'Đơn hàng %s - %s đã được thanh toán, đang chờ sản xuất',
                        'msUrl' => '',
                        'msSale' => '%s'
                    ],
                    'factory' => [
                        'msTitle' => 'Đơn hàng %s đã chuyển sang trạng thái sản xuất',
                        'msMessage' => 'Đơn hàng %s đã chuyển sang trạng thái sản xuất',
                        'msUrl' => '',
                    ],
                ]),
                'stt_nameAction' => 'Sản xuất',
            ),
            array(
                'stt_id' => 21,
                'stt_name' => 'Thiết kế rập và đi sơ đồ',
                'stt_valueA' => 'Thiết kế rập và đi sơ đồ',
                'stt_valueF' => 'Sản xuất',
                'stt_timeSchedule' => '',
                'stt_parent' => 5,
                'stt_order' => 2,
                'stt_action' => serialize([
                    'sale manager' => [],
                    'frontend' => [34],
                    'sale' => [],
                    'supplier' => [22,23,24,25,26,27],
                    'factory' => [22,23,24,25,26,27],
                ]),
                'stt_notify' => serialize([
                    'sale manager' => '',
                    'frontend' => [],
                    'sale' => [],
                    'supplier' => [],
                    'factory' => [],
                ]),
                'stt_nameAction' => 'Sản xuất',
            ),
            array(
                'stt_id' => 22,
                'stt_name' => 'Nguyện, phụ liệu',
                'stt_valueA' => 'Nguyện, phụ liệu',
                'stt_valueF' => 'Sản xuất',
                'stt_timeSchedule' => '',
                'stt_parent' => 5,
                'stt_order' => 3,
                'stt_action' => serialize([
                    'sale manager' => [],
                    'frontend' => [34],
                    'sale' => [],
                    'supplier' => [23,24,25,26,27],
                    'factory' => [23,24,25,26,27],
                ]),
                'stt_notify' => '',
                'stt_nameAction' => 'Sản xuất',
            ),
            array(
                'stt_id' => 23,
                'stt_name' => 'Cắt',
                'stt_valueA' => 'Cắt',
                'stt_valueF' => 'Sản xuất',
                'stt_timeSchedule' => '',
                'stt_parent' => 5,
                'stt_order' => 4,
                'stt_action' => serialize([
                    'sale manager' => [],
                    'frontend' => [34],
                    'sale' => [],
                    'supplier' => [24,25,26,27],
                    'factory' => [24,25,26,27],
                ]),
                'stt_notify' => '',
                'stt_nameAction' => 'Sản xuất',
            ),
            array(
                'stt_id' => 24,
                'stt_name' => 'Lên mẫu đầu truyền',
                'stt_valueA' => 'Lên mẫu đầu truyền',
                'stt_valueF' => 'Sản xuất',
                'stt_timeSchedule' => '',
                'stt_parent' => 5,
                'stt_order' => 5,
                'stt_action' => serialize([
                    'sale manager' => [],
                    'frontend' => [34],
                    'sale' => [],
                    'supplier' => [25,26,27],
                    'factory' => [25,26,27],
                ]),
                'stt_notify' => '',
                'stt_nameAction' => 'Sản xuất',
            ),
            array(
                'stt_id' => 25,
                'stt_name' => 'May',
                'stt_valueA' => 'May',
                'stt_valueF' => 'Sản xuất',
                'stt_timeSchedule' => '',
                'stt_parent' => 5,
                'stt_order' => 6,
                'stt_action' => serialize([
                    'sale manager' => [],
                    'frontend' => [34],
                    'sale' => [],
                    'supplier' => [26,27],
                    'factory' => [26,27],
                ]),
                'stt_notify' => '',
                'stt_nameAction' => 'Sản xuất',
            ),
            array(
                'stt_id' => 26,
                'stt_name' => 'Gập, Là, Đóng gói',
                'stt_valueA' => 'Gập, Là, Đóng gói',
                'stt_valueF' => 'Sản xuất',
                'stt_timeSchedule' => '',
                'stt_parent' => 5,
                'stt_order' => 7,
                'stt_action' => serialize([
                    'sale manager' => [],
                    'frontend' => [34],
                    'sale' => [],
                    'supplier' => [27],
                    'factory' => [27],
                ]),
                'stt_notify' => '',
                'stt_nameAction' => 'Sản xuất',
            ),

            array(
                'stt_id' => 27,
                'stt_name' => 'Sản xuất xong',
                'stt_valueA' => 'Đã sản xuất xong',
                'stt_valueF' => 'Chờ thanh toán',
                'stt_timeSchedule' => '',
                'stt_parent' => 5,
                'stt_order' => 8,
                'stt_action' => serialize([
                    'sale manager' => [],
                    'frontend' => [34],
                    'sale' => [],
                    'supplier' => [28],
                    'factory' => [28],
                ]),
                'stt_notify' => serialize([
                    'sale manager' => [
                        'msTitle' => 'Đơn hàng %s - %s đã sản xuất',
                        'msMessage' => 'Đơn hàng %s - %s đã sản xuất, đang chờ chuyển tiền và vận chuyển',
                        'msUrl' => '',
                        'msSale' => '%s'
                    ],
                    'frontend' => [
                        'msTitle' => 'Đơn hàng của bạn đã sản xuất',
                        'msMessage' => 'Đơn hàng %s - %s đã sản xuất, vui lòng thanh toán số tiền còn lại để nhận hàng',
                        'msUrl' => '',
                        'msSale' => '%s'
                    ],
                    'sale' => [
                        'msTitle' => 'Đơn hàng %s - %s đã sản xuất',
                        'msMessage' => 'Đơn hàng %s - %s đã sản xuất, đang chờ chuyển tiền và vận chuyển',
                        'msUrl' => '',
                        'msSale' => '%s'
                    ],
                    'supplier' => [],
                    'factory' => [],
                ]),
                'stt_nameAction' => 'Chờ thanh toán',
            ),

            array(
                'stt_id' => 28,
                'stt_name' => 'Chờ xác nhận thanh toán lần 3',
                'stt_valueA' => 'Chờ xác nhận thanh toán lần 3',
                'stt_valueF' => 'Chờ thanh toán',
                'stt_timeSchedule' => '',
                'stt_parent' => 5,
                'stt_order' => 9,
                'stt_action' => serialize([
                    'sale manager' => [],
                    'frontend' => [34],
                    'sale' => [29],
                    'supplier' => [],
                    'factory' => [],
                ]),
                'stt_notify' => serialize([
                    'sale manager' => [
                        'msTitle' => 'Đơn hàng %s - %s - %s đang Chờ xác nhận thanh toán',
                        'msMessage' => 'Đơn hàng %s - %s - %s đang Chờ xác nhận thanh toán',
                        'msUrl' => '',
                        'msSale' => '%s'
                    ],
                    'frontend' => [],
                    'sale' => [
                        'msTitle' => 'Đơn hàng %s - %s - %s đang Chờ xác nhận thanh toán',
                        'msMessage' => 'Đơn hàng %s - %s - %s đang Chờ xác nhận thanh toán',
                        'msUrl' => '',
                        'msSale' => '%s'
                    ],
                    'supplier' => [],
                    'factory' => [],
                ]),
                'stt_nameAction' => 'Chờ thanh toán',
            ),

            array(
                'stt_id' => 29,
                'stt_name' => 'Đang vận chuyển',
                'stt_valueA' => 'Đang vận chuyển',
                'stt_valueF' => 'Vận chuyển',
                'stt_timeSchedule' => '',
                'stt_parent' => 6,
                'stt_order' => 1,
                'stt_action' => serialize([
                    'sale manager' => [],
                    'frontend' => [30],
                    'sale' => [],
                    'supplier' => [],
                    'factory' => [],
                ]),
                'stt_notify' => serialize([
                    'sale manager' => [
                        'msTitle' => 'Đơn hàng %s - %s - %s đang vận chuyển',
                        'msMessage' => 'Đơn hàng %s - %s - %s đang được vận chuyển',
                        'msUrl' => '',
                        'msSale' => '%s'
                    ],
                    'frontend' => [
                        'msTitle' => 'Đơn hàng của bạn đang vận chuyển',
                        'msMessage' => 'Đơn hàng của bạn đang được vận chuyển',
                        'msUrl' => '',
                        'msSale' => '%s',
                    ],
                    'sale' => [
                        'msTitle' => 'Đơn hàng %s - %s - %s đang vận chuyển',
                        'msMessage' => 'Đơn hàng %s - %s - %s đang được vận chuyển',
                        'msUrl' => '',
                        'msSale' => '%s'
                    ],
                    'supplier' => [],
                    'factory' => [],
                ]),
                'stt_nameAction' => 'Vận chuyển',
            ),
            array(
                'stt_id' => 30,
                'stt_name' => 'Đã nhận, chưa đối soát',
                'stt_valueA' => 'Đã nhận, chưa đối soát',
                'stt_valueF' => 'Đã nhận hàng',
                'stt_timeSchedule' => '',
                'stt_parent' => 6,
                'stt_order' => 2,
                'stt_action' => serialize([
                    'sale manager' => [],
                    'frontend' => [],
                    'sale' => [31],
                    'supplier' => [],
                    'factory' => [],
                ]),
                'stt_notify' => serialize([
                    'sale manager' => [
                        'msTitle' => 'Đơn hàng %s - %s đã giao hàng',
                        'msMessage' => 'Đơn hàng %s - %s - %s đã được giao',
                        'msUrl' => '',
                        'msSale' => '%s'
                    ],
                    'frontend' => [],
                    'sale' => [
                        'msTitle' => 'Đơn hàng %s - %s đã giao hàng',
                        'msMessage' => 'Đơn hàng %s - %s - %s đã được giao',
                        'msUrl' => '',
                        'msSale' => '%s'
                    ],
                    'supplier' => [],
                    'factory' => [],
                ]),
                'stt_nameAction' => 'Vận chuyển',
            ),

            array(
                'stt_id' => 31,
                'stt_name' => 'Đối soát',
                'stt_valueA' => 'Đối soát',
                'stt_valueF' => 'Đối soát',
                'stt_timeSchedule' => '',
                'stt_parent' => 6,
                'stt_order' => 3,
                'stt_action' => serialize([
                    'sale manager' => [],
                    'frontend' => [],
                    'sale' => [32],
                    'supplier' => [],
                    'factory' => [],
                ]),
                'stt_notify' => serialize([
                    'sale manager' => [
                        'msTitle' => 'Đơn hàng %s - %s đã giao hàng',
                        'msMessage' => 'Đơn hàng %s - %s - %s đã được giao hàng, đã đối soát',
                        'msUrl' => '',
                        'msSale' => '%s'
                    ],
                    'frontend' => [],
                    'sale' => [
                        'msTitle' => 'Đơn hàng %s - %s đã giao hàng',
                        'msMessage' => 'Đơn hàng %s - %s - %s đã được giao hàng, đã đối soát',
                        'msUrl' => '',
                        'msSale' => '%s'
                    ],
                    'supplier' => [],
                    'factory' => [],
                ]),
                'stt_nameAction' => 'Vận chuyển',
            ),
            array(
                'stt_id' => 32,
                'stt_name' => 'Đang xử lí khiếu nại',
                'stt_valueA' => 'Đang xử lí khiếu nại',
                'stt_valueF' => 'Xử lí khiếu nại',
                'stt_timeSchedule' => '',
                'stt_parent' => 6,
                'stt_order' => 4,
                'stt_action' => serialize([
                    'sale manager' => [],
                    'frontend' => [],
                    'sale' => [32],
                    'supplier' => [],
                    'factory' => [],
                ]),
                'stt_notify' => serialize([
                    'sale manager' => [
                        'msTitle' => 'Đơn hàng %s - %s đang xử lí khiếu nại',
                        'msMessage' => 'Đơn hàng %s - %s - %s đang xử lí khiếu nại',
                        'msUrl' => '',
                        'msSale' => '%s'
                    ],
                    'frontend' => [],
                    'sale' => [],
                    'supplier' => [],
                    'factory' => [],
                ]),
                'stt_nameAction' => 'Vận chuyển',
            ),


            array(
                'stt_id' => 33,
                'stt_name' => 'Đã hoàn thành',
                'stt_valueA' => 'Đã hoàn thành',
                'stt_valueF' => 'Đã hoàn thành',
                'stt_timeSchedule' => '',
                'stt_parent' => 7,
                'stt_order' => 1,
                'stt_action' => serialize([
                    'sale manager' => [],
                    'frontend' => [],
                    'sale' => [],
                    'supplier' => [],
                    'factory' => [],
                ]),
                'stt_notify' => serialize([
                    'sale manager' => [
                        'msTitle' => 'Đơn hàng %s - %s đã hoàn thành',
                        'msMessage' => 'Đơn hàng %s - %s đã hoàn thành',
                        'msUrl' => '',
                        'msSale' => '%s'
                    ],
                    'frontend' => [
                        'msTitle' => 'Đơn hàng của bạn đã hoàn thành',
                        'msMessage' => 'Đơn hàng %s đã hoàn thành',
                        'msUrl' => '',
                        'msSale' => '%s'
                    ],
                    'sale' => [],
                    'supplier' => [],
                    'factory' => [
                        'msTitle' => 'Đơn hàng %s đã hoàn thành',
                        'msMessage' => 'Đơn hàng %s đã hoàn thành',
                        'msUrl' => '',
                    ],
                ]),
                'stt_nameAction' => 'Đã hoàn thành',
            ),

            array(
                'stt_id' => 34,
                'stt_name' => 'Hủy',
                'stt_valueA' => 'Hủy',
                'stt_valueF' => 'Hủy',
                'stt_timeSchedule' => '',
                'stt_parent' => 8,
                'stt_order' => 1,
                'stt_action' => '',
                'stt_notify' => serialize([
                    'sale manager' => [
                        'msTitle' => 'Đơn hàng %s - %s đã bị hủy',
                        'msMessage' => 'Đơn hàng %s - %s đã bị hủy',
                        'msUrl' => '',
                        'msSale' => '%s'
                    ],
                    'frontend' => [],
                    'sale' => [
                        'msTitle' => 'Đơn hàng %s - %s đã bị hủy',
                        'msMessage' => 'Đơn hàng %s - %s đã bị hủy',
                        'msUrl' => '',
                        'msSale' => '%s'
                    ],
                    'supplier' => [
                        'msTitle' => 'Đơn hàng %s - %s đã bị hủy',
                        'msMessage' => 'Đơn hàng %s - %s đã bị hủy',
                        'msUrl' => '',
                        'msSale' => '%s'
                    ],
                    'factory' => [
                        'msTitle' => 'Đơn hàng %s - %s đã bị hủy',
                        'msMessage' => 'Đơn hàng %s - %s đã bị hủy',
                        'msUrl' => '',
                    ],
                ]),
                'stt_nameAction' => 'Hủy',
            ),

            array(
                'stt_id' => 101,
                'stt_name' => 'Đang hoạt động',
                'stt_valueA' => 'Đang hoạt động',
                'stt_valueF' => 'Đang hoạt động',
                'stt_timeSchedule' => '',
                'stt_parent' => 101,
                'stt_order' => 101,
                'stt_action' => '',
                'stt_notify' => '',
                'stt_nameAction' => 'Đang hoạt động',
            ),
        ]);
    }
}

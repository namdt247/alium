<?php

use Illuminate\Database\Seeder;

class OrderTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('order')->delete();
        
        \DB::table('order')->insert(array (
            0 => 
            array (
                'od_id' => 1,
                'od_code' => 'DH1907151',
                'od_name' => 'Vũ Hồng Quân',
                'od_locationId' => NULL,
                'od_phone' => '0988727271',
                'od_email' => 'thanhnhan@alium.vn',
                'od_country' => 245,
                'od_city' => 2,
                'od_district' => 0,
                'od_address' => NULL,
                'od_postalCode' => 0,
                'od_quantity' => 0,
                'od_quality' => 0,
                'od_product' => 1,
                'od_templatePrice' => 0.0,
                'od_createdBy' => 3,
                'od_assigneeTo' => 1,
                'od_status' => 9,
                'od_priceUnit' => 0.0,
                'od_total' => 0.0,
                'od_paid' => 0.0,
                'od_requiredType' => NULL,
                'od_wantedPrice' => 0.0,
                'od_paymentMethod' => NULL,
                'od_coupon' => NULL,
                'od_parent' => 0,
                'od_type' => 0,
                'od_message' => NULL,
                'od_content' => NULL,
                'od_requiredDate' => NULL,
                'od_deliveredTime' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'od_id' => 2,
                'od_code' => 'DH1907152',
                'od_name' => 'Ngô Bích Phượng',
                'od_locationId' => NULL,
                'od_phone' => '0988727271',
                'od_email' => 'dkjd@alium.vn',
                'od_country' => 245,
                'od_city' => 1,
                'od_district' => 0,
                'od_address' => NULL,
                'od_postalCode' => 0,
                'od_quantity' => 0,
                'od_quality' => 0,
                'od_product' => 1,
                'od_templatePrice' => 0.0,
                'od_createdBy' => 4,
                'od_assigneeTo' => 2,
                'od_status' => 9,
                'od_priceUnit' => 0.0,
                'od_total' => 0.0,
                'od_paid' => 0.0,
                'od_requiredType' => NULL,
                'od_wantedPrice' => 0.0,
                'od_paymentMethod' => NULL,
                'od_coupon' => NULL,
                'od_parent' => 0,
                'od_type' => 0,
                'od_message' => NULL,
                'od_content' => NULL,
                'od_requiredDate' => NULL,
                'od_deliveredTime' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            2 => 
            array (
                'od_id' => 3,
                'od_code' => 'DH1908171',
                'od_name' => 'Quân Vũ',
                'od_locationId' => NULL,
                'od_phone' => '0975298868',
                'od_email' => 'quanvh.sebk@gmail.com',
                'od_country' => 245,
                'od_city' => 2,
                'od_district' => 26,
                'od_address' => '123 Hoàng Quốc Việt',
                'od_postalCode' => 10000,
                'od_quantity' => 60,
                'od_quality' => 3,
                'od_product' => 1,
                'od_templatePrice' => 0.0,
                'od_createdBy' => 1,
                'od_assigneeTo' => 0,
                'od_status' => 9,
                'od_priceUnit' => 0.0,
                'od_total' => 0.0,
                'od_paid' => 0.0,
                'od_requiredType' => '1,2,3,4,5,6',
                'od_wantedPrice' => 150000.0,
                'od_paymentMethod' => NULL,
                'od_coupon' => NULL,
                'od_parent' => 0,
                'od_type' => 10110,
                'od_message' => 'Yêu cầu cao cho xưởng',
                'od_content' => NULL,
                'od_requiredDate' => '2019-09-07',
                'od_deliveredTime' => NULL,
                'created_at' => '2019-08-17 10:13:04',
                'updated_at' => '2019-08-17 10:13:04',
            ),
            3 => 
            array (
                'od_id' => 4,
                'od_code' => 'DH1908172',
                'od_name' => 'Quân Vũ',
                'od_locationId' => NULL,
                'od_phone' => '0975298868',
                'od_email' => 'quanvh.sebk@gmail.com',
                'od_country' => 245,
                'od_city' => 0,
                'od_district' => 0,
                'od_address' => '1213 Hoàng Quốc Việt',
                'od_postalCode' => 10000,
                'od_quantity' => 90,
                'od_quality' => 4,
                'od_product' => 3,
                'od_templatePrice' => 0.0,
                'od_createdBy' => 1,
                'od_assigneeTo' => 0,
                'od_status' => 9,
                'od_priceUnit' => 0.0,
                'od_total' => 0.0,
                'od_paid' => 0.0,
                'od_requiredType' => '1,2,3,4,5,6',
                'od_wantedPrice' => 230000.0,
                'od_paymentMethod' => NULL,
                'od_coupon' => NULL,
                'od_parent' => 0,
                'od_type' => 10000,
                'od_message' => 'Yêu cầu khác, đơn hàng số 2',
                'od_content' => NULL,
                'od_requiredDate' => '2019-09-06',
                'od_deliveredTime' => NULL,
                'created_at' => '2019-08-17 10:58:00',
                'updated_at' => '2019-08-17 10:58:00',
            ),
            4 => 
            array (
                'od_id' => 5,
                'od_code' => 'DH1908173',
                'od_name' => 'Quân Vũ',
                'od_locationId' => NULL,
                'od_phone' => '0975298868',
                'od_email' => 'quanvh.sebk@gmail.com',
                'od_country' => 245,
                'od_city' => 0,
                'od_district' => 0,
                'od_address' => '45 Phạm Tuấn Tài',
                'od_postalCode' => 0,
                'od_quantity' => 60,
                'od_quality' => 3,
                'od_product' => 10,
                'od_templatePrice' => 0.0,
                'od_createdBy' => 1,
                'od_assigneeTo' => 0,
                'od_status' => 9,
                'od_priceUnit' => 0.0,
                'od_total' => 0.0,
                'od_paid' => 0.0,
                'od_requiredType' => '1,2,3,4,5,6',
                'od_wantedPrice' => 90000.0,
                'od_paymentMethod' => NULL,
                'od_coupon' => NULL,
                'od_parent' => 0,
                'od_type' => 100,
                'od_message' => 'Xuất khẩu, thắt lưng',
                'od_content' => NULL,
                'od_requiredDate' => '2019-09-06',
                'od_deliveredTime' => NULL,
                'created_at' => '2019-08-17 10:58:45',
                'updated_at' => '2019-08-17 10:58:45',
            ),
            5 => 
            array (
                'od_id' => 6,
                'od_code' => 'DH1908174',
                'od_name' => 'Quân Vũ',
                'od_locationId' => NULL,
                'od_phone' => '0975298868',
                'od_email' => 'quanvh.sebk@gmail.com',
                'od_country' => 245,
                'od_city' => 0,
                'od_district' => 0,
                'od_address' => '45 Phạm Tuấn Tài',
                'od_postalCode' => 0,
                'od_quantity' => 60,
                'od_quality' => 3,
                'od_product' => 10,
                'od_templatePrice' => 0.0,
                'od_createdBy' => 1,
                'od_assigneeTo' => 0,
                'od_status' => 9,
                'od_priceUnit' => 0.0,
                'od_total' => 0.0,
                'od_paid' => 0.0,
                'od_requiredType' => '1,2,3,4,5,6',
                'od_wantedPrice' => 900000.0,
                'od_paymentMethod' => NULL,
                'od_coupon' => NULL,
                'od_parent' => 0,
                'od_type' => 100,
                'od_message' => 'Xuất khẩu, thắt lưng',
                'od_content' => NULL,
                'od_requiredDate' => '2019-09-06',
                'od_deliveredTime' => NULL,
                'created_at' => '2019-08-17 10:58:45',
                'updated_at' => '2019-08-17 10:58:45',
            ),
            6 => 
            array (
                'od_id' => 7,
                'od_code' => 'DH1908175',
                'od_name' => 'Quân Vũ',
                'od_locationId' => NULL,
                'od_phone' => '0975298868',
                'od_email' => 'quanvh.sebk@gmail.com',
                'od_country' => 245,
                'od_city' => 0,
                'od_district' => 0,
                'od_address' => '45 Phạm Tuấn Tài',
                'od_postalCode' => 0,
                'od_quantity' => 60,
                'od_quality' => 3,
                'od_product' => 10,
                'od_templatePrice' => 0.0,
                'od_createdBy' => 1,
                'od_assigneeTo' => 0,
                'od_status' => 9,
                'od_priceUnit' => 0.0,
                'od_total' => 0.0,
                'od_paid' => 0.0,
                'od_requiredType' => '1,2,3,4,5,6',
                'od_wantedPrice' => 900000.0,
                'od_paymentMethod' => NULL,
                'od_coupon' => NULL,
                'od_parent' => 0,
                'od_type' => 100,
                'od_message' => 'Xuất khẩu, thắt lưng',
                'od_content' => NULL,
                'od_requiredDate' => '2019-09-06',
                'od_deliveredTime' => NULL,
                'created_at' => '2019-08-17 10:58:45',
                'updated_at' => '2019-08-17 10:58:45',
            ),
            7 => 
            array (
                'od_id' => 8,
                'od_code' => 'DH1908176',
                'od_name' => 'Quân Vũ',
                'od_locationId' => NULL,
                'od_phone' => '0975298868',
                'od_email' => 'quanvh.sebk@gmail.com',
                'od_country' => 245,
                'od_city' => 0,
                'od_district' => 0,
                'od_address' => '45 Phạm Tuấn Tài',
                'od_postalCode' => 0,
                'od_quantity' => 60,
                'od_quality' => 3,
                'od_product' => 10,
                'od_templatePrice' => 0.0,
                'od_createdBy' => 1,
                'od_assigneeTo' => 0,
                'od_status' => 9,
                'od_priceUnit' => 0.0,
                'od_total' => 0.0,
                'od_paid' => 0.0,
                'od_requiredType' => '1,2,3,4,5,6',
                'od_wantedPrice' => 900000.0,
                'od_paymentMethod' => NULL,
                'od_coupon' => NULL,
                'od_parent' => 0,
                'od_type' => 100,
                'od_message' => 'Xuất khẩu, thắt lưng',
                'od_content' => NULL,
                'od_requiredDate' => '2019-09-06',
                'od_deliveredTime' => NULL,
                'created_at' => '2019-08-17 10:58:45',
                'updated_at' => '2019-08-17 10:58:45',
            ),
            8 => 
            array (
                'od_id' => 9,
                'od_code' => 'DH1908177',
                'od_name' => 'Quân Vũ',
                'od_locationId' => NULL,
                'od_phone' => '0975298868',
                'od_email' => 'quanvh.sebk@gmail.com',
                'od_country' => 245,
                'od_city' => 0,
                'od_district' => 0,
                'od_address' => '45 Phạm Tuấn Tài',
                'od_postalCode' => 0,
                'od_quantity' => 60,
                'od_quality' => 3,
                'od_product' => 10,
                'od_templatePrice' => 0.0,
                'od_createdBy' => 1,
                'od_assigneeTo' => 0,
                'od_status' => 9,
                'od_priceUnit' => 0.0,
                'od_total' => 0.0,
                'od_paid' => 0.0,
                'od_requiredType' => '1,2,3,4,5,6',
                'od_wantedPrice' => 900000.0,
                'od_paymentMethod' => NULL,
                'od_coupon' => NULL,
                'od_parent' => 0,
                'od_type' => 100,
                'od_message' => 'Xuất khẩu, thắt lưng',
                'od_content' => NULL,
                'od_requiredDate' => '2019-09-06',
                'od_deliveredTime' => NULL,
                'created_at' => '2019-08-17 10:58:45',
                'updated_at' => '2019-08-17 10:58:45',
            ),
            9 => 
            array (
                'od_id' => 10,
                'od_code' => 'DH1908178',
                'od_name' => 'Quân Vũ',
                'od_locationId' => NULL,
                'od_phone' => '0975298868',
                'od_email' => 'quanvh.sebk@gmail.com',
                'od_country' => 245,
                'od_city' => 0,
                'od_district' => 0,
                'od_address' => '45 Phạm Tuấn Tài',
                'od_postalCode' => 0,
                'od_quantity' => 60,
                'od_quality' => 3,
                'od_product' => 10,
                'od_templatePrice' => 0.0,
                'od_createdBy' => 1,
                'od_assigneeTo' => 0,
                'od_status' => 9,
                'od_priceUnit' => 0.0,
                'od_total' => 0.0,
                'od_paid' => 0.0,
                'od_requiredType' => '1,2,3,4,5,6',
                'od_wantedPrice' => 900000.0,
                'od_paymentMethod' => NULL,
                'od_coupon' => NULL,
                'od_parent' => 0,
                'od_type' => 100,
                'od_message' => 'Xuất khẩu, thắt lưng',
                'od_content' => NULL,
                'od_requiredDate' => '2019-09-06',
                'od_deliveredTime' => NULL,
                'created_at' => '2019-08-17 10:58:45',
                'updated_at' => '2019-08-17 10:58:45',
            ),
            10 => 
            array (
                'od_id' => 11,
                'od_code' => 'DH1908179',
                'od_name' => 'Quân Vũ',
                'od_locationId' => NULL,
                'od_phone' => '0975298868',
                'od_email' => 'quanvh.sebk@gmail.com',
                'od_country' => 245,
                'od_city' => 0,
                'od_district' => 0,
                'od_address' => '45 Phạm Tuấn Tài',
                'od_postalCode' => 0,
                'od_quantity' => 60,
                'od_quality' => 3,
                'od_product' => 10,
                'od_templatePrice' => 0.0,
                'od_createdBy' => 1,
                'od_assigneeTo' => 0,
                'od_status' => 9,
                'od_priceUnit' => 0.0,
                'od_total' => 0.0,
                'od_paid' => 0.0,
                'od_requiredType' => '1,2,3,4,5,6',
                'od_wantedPrice' => 900000.0,
                'od_paymentMethod' => NULL,
                'od_coupon' => NULL,
                'od_parent' => 0,
                'od_type' => 100,
                'od_message' => 'Xuất khẩu, thắt lưng',
                'od_content' => NULL,
                'od_requiredDate' => '2019-09-06',
                'od_deliveredTime' => NULL,
                'created_at' => '2019-08-17 10:58:45',
                'updated_at' => '2019-08-17 10:58:45',
            ),
            11 => 
            array (
                'od_id' => 12,
                'od_code' => 'DH1908180',
                'od_name' => 'Quân Vũ',
                'od_locationId' => NULL,
                'od_phone' => '0975298868',
                'od_email' => 'quanvh.sebk@gmail.com',
                'od_country' => 245,
                'od_city' => 0,
                'od_district' => 0,
                'od_address' => '45 Phạm Tuấn Tài',
                'od_postalCode' => 0,
                'od_quantity' => 60,
                'od_quality' => 3,
                'od_product' => 10,
                'od_templatePrice' => 0.0,
                'od_createdBy' => 1,
                'od_assigneeTo' => 0,
                'od_status' => 9,
                'od_priceUnit' => 0.0,
                'od_total' => 0.0,
                'od_paid' => 0.0,
                'od_requiredType' => '1,2,3,4,5,6',
                'od_wantedPrice' => 900000.0,
                'od_paymentMethod' => NULL,
                'od_coupon' => NULL,
                'od_parent' => 0,
                'od_type' => 100,
                'od_message' => 'Xuất khẩu, thắt lưng',
                'od_content' => NULL,
                'od_requiredDate' => '2019-09-06',
                'od_deliveredTime' => NULL,
                'created_at' => '2019-08-17 10:58:45',
                'updated_at' => '2019-08-17 10:58:45',
            ),
            12 => 
            array (
                'od_id' => 13,
                'od_code' => 'DH1908181',
                'od_name' => 'Quân Vũ',
                'od_locationId' => NULL,
                'od_phone' => '0975298868',
                'od_email' => 'quanvh.sebk@gmail.com',
                'od_country' => 245,
                'od_city' => 0,
                'od_district' => 0,
                'od_address' => '45 Phạm Tuấn Tài',
                'od_postalCode' => 0,
                'od_quantity' => 60,
                'od_quality' => 3,
                'od_product' => 10,
                'od_templatePrice' => 0.0,
                'od_createdBy' => 1,
                'od_assigneeTo' => 0,
                'od_status' => 9,
                'od_priceUnit' => 0.0,
                'od_total' => 0.0,
                'od_paid' => 0.0,
                'od_requiredType' => '1,2,3,4,5,6',
                'od_wantedPrice' => 900000.0,
                'od_paymentMethod' => NULL,
                'od_coupon' => NULL,
                'od_parent' => 0,
                'od_type' => 100,
                'od_message' => 'Xuất khẩu, thắt lưng',
                'od_content' => NULL,
                'od_requiredDate' => '2019-09-06',
                'od_deliveredTime' => NULL,
                'created_at' => '2019-08-17 10:58:45',
                'updated_at' => '2019-08-17 10:58:45',
            ),
            13 => 
            array (
                'od_id' => 14,
                'od_code' => 'DH1908182',
                'od_name' => 'Quân Vũ',
                'od_locationId' => NULL,
                'od_phone' => '0975298868',
                'od_email' => 'quanvh.sebk@gmail.com',
                'od_country' => 245,
                'od_city' => 0,
                'od_district' => 0,
                'od_address' => '45 Phạm Tuấn Tài',
                'od_postalCode' => 0,
                'od_quantity' => 60,
                'od_quality' => 3,
                'od_product' => 10,
                'od_templatePrice' => 0.0,
                'od_createdBy' => 1,
                'od_assigneeTo' => 0,
                'od_status' => 9,
                'od_priceUnit' => 0.0,
                'od_total' => 0.0,
                'od_paid' => 0.0,
                'od_requiredType' => '1,2,3,4,5,6',
                'od_wantedPrice' => 900000.0,
                'od_paymentMethod' => NULL,
                'od_coupon' => NULL,
                'od_parent' => 0,
                'od_type' => 100,
                'od_message' => 'Xuất khẩu, thắt lưng',
                'od_content' => NULL,
                'od_requiredDate' => '2019-09-06',
                'od_deliveredTime' => NULL,
                'created_at' => '2019-08-17 10:58:45',
                'updated_at' => '2019-08-17 10:58:45',
            ),
            14 => 
            array (
                'od_id' => 15,
                'od_code' => 'DH1908183',
                'od_name' => 'Quân Vũ',
                'od_locationId' => NULL,
                'od_phone' => '0975298868',
                'od_email' => 'quanvh.sebk@gmail.com',
                'od_country' => 245,
                'od_city' => 0,
                'od_district' => 0,
                'od_address' => '45 Phạm Tuấn Tài',
                'od_postalCode' => 0,
                'od_quantity' => 60,
                'od_quality' => 3,
                'od_product' => 10,
                'od_templatePrice' => 0.0,
                'od_createdBy' => 1,
                'od_assigneeTo' => 0,
                'od_status' => 9,
                'od_priceUnit' => 0.0,
                'od_total' => 0.0,
                'od_paid' => 0.0,
                'od_requiredType' => '1,2,3,4,5,6',
                'od_wantedPrice' => 900000.0,
                'od_paymentMethod' => NULL,
                'od_coupon' => NULL,
                'od_parent' => 0,
                'od_type' => 100,
                'od_message' => 'Xuất khẩu, thắt lưng',
                'od_content' => NULL,
                'od_requiredDate' => '2019-09-06',
                'od_deliveredTime' => NULL,
                'created_at' => '2019-08-17 10:58:45',
                'updated_at' => '2019-08-17 10:58:45',
            ),
            15 => 
            array (
                'od_id' => 16,
                'od_code' => 'DH1908184',
                'od_name' => 'Quân Vũ',
                'od_locationId' => NULL,
                'od_phone' => '0975298868',
                'od_email' => 'quanvh.sebk@gmail.com',
                'od_country' => 245,
                'od_city' => 0,
                'od_district' => 0,
                'od_address' => '45 Phạm Tuấn Tài',
                'od_postalCode' => 0,
                'od_quantity' => 60,
                'od_quality' => 3,
                'od_product' => 10,
                'od_templatePrice' => 0.0,
                'od_createdBy' => 1,
                'od_assigneeTo' => 0,
                'od_status' => 9,
                'od_priceUnit' => 0.0,
                'od_total' => 0.0,
                'od_paid' => 0.0,
                'od_requiredType' => '1,2,3,4,5,6',
                'od_wantedPrice' => 900000.0,
                'od_paymentMethod' => NULL,
                'od_coupon' => NULL,
                'od_parent' => 0,
                'od_type' => 100,
                'od_message' => 'Xuất khẩu, thắt lưng',
                'od_content' => NULL,
                'od_requiredDate' => '2019-09-06',
                'od_deliveredTime' => NULL,
                'created_at' => '2019-08-17 10:58:45',
                'updated_at' => '2019-08-17 10:58:45',
            ),
        ));
        
        
    }
}
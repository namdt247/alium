<?php

use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('product')->insert([
            array(
                'prd_name' => 'Đồ trẻ em',
                'prd_cate' => 1,
                'prd_createdBy' => 1
            ),
            array(
                'prd_name' => 'Dòng thời trang nữ',
                'prd_cate' => 1,
                'prd_createdBy' => 1
            ),
            array(
                'prd_name' => 'Dòng thời trang nam',
                'prd_cate' => 1,
                'prd_createdBy' => 1
            ),
            array(
                'prd_name' => 'Đồ ngủ',
                'prd_cate' => 1,
                'prd_createdBy' => 1
            ),
            array(
                'prd_name' => 'Váy ren, váy công chúa, váy cưới',
                'prd_cate' => 1,
                'prd_createdBy' => 1
            ),
            array(
                'prd_name' => 'Đồ bơi',
                'prd_cate' => 1,
                'prd_createdBy' => 1
            ),
            array(
                'prd_name' => 'Đồ thể thao',
                'prd_cate' => 1,
                'prd_createdBy' => 1
            ),
            array(
                'prd_name' => 'Đồ lót',
                'prd_cate' => 1,
                'prd_createdBy' => 1
            ),
            array(
                'prd_name' => 'Cavat',
                'prd_cate' => 1,
                'prd_createdBy' => 1
            ),
            array(
                'prd_name' => 'Tất',
                'prd_cate' => 1,
                'prd_createdBy' => 1
            ),
            array(
                'prd_name' => 'Thắt lưng',
                'prd_cate' => 1,
                'prd_createdBy' => 1
            ),
            array(
                'prd_name' => 'Túi vải',
                'prd_cate' => 1,
                'prd_createdBy' => 1
            ),
            array(
                'prd_name' => 'Quần Jeans',
                'prd_cate' => 2,
                'prd_createdBy' => 1
            ),
            array(
                'prd_name' => 'Áo sơ mi',
                'prd_cate' => 2,
                'prd_createdBy' => 1
            ),
            array(
                'prd_name' => 'Đồ da',
                'prd_cate' => 2,
                'prd_createdBy' => 1
            ),
            array(
                'prd_name' => 'Đồ vest',
                'prd_cate' => 3,
                'prd_createdBy' => 1
            ),
            array(
                'prd_name' => 'Áo phông',
                'prd_cate' => 3,
                'prd_createdBy' => 1
            ),
            array(
                'prd_name' => 'Đồ bảo hộ',
                'prd_cate' => 3,
                'prd_createdBy' => 1
            ),
        ]);

        DB::table('product_tran')->insert([
            array(
                'prd_name' => 'Đồ trẻ em',
                'product_prd_id' => 1,
                'locale' => 'vi',
            ),
            array(
                'prd_name' => 'Dòng thời trang nữ',
                'product_prd_id' => 2,
                'locale' => 'vi',
            ),
            array(
                'prd_name' => 'Dòng thời trang nam',
                'product_prd_id' => 3,
                'locale' => 'vi',
            ),
            array(
                'prd_name' => 'Đồ ngủ',
                'product_prd_id' => 4,
                'locale' => 'vi',
            ),
            array(
                'prd_name' => 'Váy ren, váy công chúa, váy cưới',
                'product_prd_id' => 5,
                'locale' => 'vi',
            ),
            array(
                'prd_name' => 'Đồ bơi',
                'product_prd_id' => 6,
                'locale' => 'vi',
            ),
            array(
                'prd_name' => 'Đồ thể thao',
                'product_prd_id' => 7,
                'locale' => 'vi',
            ),
            array(
                'prd_name' => 'Đồ lót',
                'product_prd_id' => 8,
                'locale' => 'vi',
            ),
            array(
                'prd_name' => 'Cavat',
                'product_prd_id' => 9,
                'locale' => 'vi',
            ),
            array(
                'prd_name' => 'Tất',
                'product_prd_id' => 10,
                'locale' => 'vi',
            ),
            array(
                'prd_name' => 'Thắt lưng',
                'product_prd_id' => 11,
                'locale' => 'vi',
            ),
            array(
                'prd_name' => 'Túi vải',
                'product_prd_id' => 12,
                'locale' => 'vi',
            ),
            array(
                'prd_name' => 'Quần Jeans',
                'product_prd_id' => 13,
                'locale' => 'vi',
            ),
            array(
                'prd_name' => 'Áo sơ mi',
                'product_prd_id' => 14,
                'locale' => 'vi',
            ),
            array(
                'prd_name' => 'Đồ da',
                'product_prd_id' => 15,
                'locale' => 'vi',
            ),
            array(
                'prd_name' => 'Đồ vest',
                'product_prd_id' => 16,
                'locale' => 'vi',
            ),
            array(
                'prd_name' => 'Áo phông',
                'product_prd_id' => 17,
                'locale' => 'vi',
            ),
            array(
                'prd_name' => 'Đồ bảo hộ',
                'product_prd_id' => 18,
                'locale' => 'vi',
            ),
        ]);
    }
}

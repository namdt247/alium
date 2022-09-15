<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $this->call([
             Role_userSeeder::class,
             UserSeeder::class,
//             CateProductSeeder::class,
             CateArticleSeeder::class,
//             ProductSeeder::class,
             RolesAndPermissionsSeeder::class,
             ConfigTableSeeder::class,
//             SupplierleSeeder::class,
             OrderStatusSeeder::class,

             CountryTableSeeder::class,
             CityTableSeeder::class,
             DistrictTableSeeder::class,
//             OrderTableSeeder::class
         ]);
    }
}

class Role_userSeeder extends Seeder{
    public function run()
    {
        DB::table('role_user')->insert([
            array(
                'role_id' => 1,
                'role_name' => 'super-admin',
                'role_value' => 'Super Administrator',
            ),
            array(
                'role_id' => 2,
                'role_name' => 'admin',
                'role_value' => 'Administrator',
            ),
            array(
                'role_id' => 3,
                'role_name' => 'moderator',
                'role_value' => 'Moderator',
            ),
            array(
                'role_id' => 11,
                'role_name' => 'normal',
                'role_value' => 'Normal',
            ),
        ]);
    }
}

class CateProductSeeder extends Seeder{
    public function run()
    {
        DB::table('cate_product')->insert([
            array(
                'cate_id' => 1,
                'cate_name' => 'Quần áo',
                'cate_value' => 'Quần áo',
                'cate_alias' => 'quan-ao',
                'cate_size' => ''
            ),
            array(
                'cate_id' => 2,
                'cate_name' => 'Đồ trẻ em',
                'cate_value' => 'Đồ trẻ em',
                'cate_alias' => 'do-tre-em',
                'cate_size' => ''
            ),
            array(
                'cate_id' => 3,
                'cate_name' => 'Đồ khác',
                'cate_value' => 'Đồ khác',
                'cate_alias' => 'do-khac',
                'cate_size' => ''
            ),

        ]);

        DB::table('cate_product_tran')->insert([
            array(
                'cate_product_cate_id' => 1,
                'cate_value' => 'Quần áo',
                'cate_alias' => 'quan-ao',
                'cate_size' => '',
                'locale' => 'vi'
            ),
            array(
                'cate_product_cate_id' => 2,
                'cate_value' => 'Đồ trẻ em',
                'cate_alias' => 'do-tre-em',
                'cate_size' => '',
                'locale' => 'vi'
            ),
            array(
                'cate_product_cate_id' => 3,
                'cate_value' => 'Đồ khác',
                'cate_alias' => 'do-khac',
                'cate_size' => '',
                'locale' => 'vi'
            ),
        ]);
    }
}

class CateArticleSeeder extends Seeder{
    public function run()
    {
        DB::table('cate_article')->insert([
            array(
                'cate_id' => 1,
                'cate_name' => 'Câu chuyện Alium-er',
                'cate_value' => 'Câu chuyện Alium-er',
                'cate_alias' => 'cau-chuyen-alium-er',
                'cate_status' => 1
            ),
            array(
                'cate_id' => 2,
                'cate_name' => 'Video',
                'cate_value' => 'Video',
                'cate_alias' => 'video',
                'cate_status' => 1
            ),
            array(
                'cate_id' => 10,
                'cate_name' => 'Hướng dẫn đặt sản xuất',
                'cate_value' => 'Hướng dẫn đặt sản xuất',
                'cate_alias' => 'huong-dan-dat-san-xuat',
                'cate_status' => 2
            ),
            array(
                'cate_id' => 11,
                'cate_name' => 'Hướng dẫn đăng ký xưởng',
                'cate_value' => 'Hướng dẫn đăng ký xưởng',
                'cate_alias' => 'huong-dan-dang-ky-xuong',
                'cate_status' => 2
            ),
        ]);

        DB::table('cate_article_tran')->insert([
            array(
                'cate_article_cate_id' => 10,
                'cate_value' => 'Hướng dẫn đặt sản xuất',
                'cate_alias' => 'huong-dan-dat-san-xuat',
                'locale' => 'vi'
            ),
            array(
                'cate_article_cate_id' => 11,
                'cate_value' => 'Hướng dẫn đăng ký xưởng',
                'cate_alias' => 'huong-dan-dang-ky-xuong',
                'locale' => 'vi'
            ),
            array(
                'cate_article_cate_id' => 1,
                'cate_value' => 'Câu chuyện Alium-er',
                'cate_alias' => 'cau-chuyen-alium-er',
                'locale' => 'vi'
            ),
            array(
                'cate_article_cate_id' => 2,
                'cate_value' => 'Video',
                'cate_alias' => 'video',
                'locale' => 'vi',
            ),
        ]);
    }
}

class SupplierleSeeder extends Seeder{
    public function run()
    {
        DB::table('supplier')->insert([
            array(
                'sp_code' => 'XM1907151',
                'sp_name' => 'Xưởng Thanh Nhàn',
                'sp_email' => 'thanhnhan@alium.vn',
                'sp_phone' => '0988727271',
                'sp_city' => 3,
                'sp_createdBy' => 1,
            ),
            array(
                'sp_code' => 'XM1907152',
                'sp_name' => 'Xưởng Phượng Ớt',
                'sp_email' => 'abd@alium.vn',
                'sp_phone' => '0898765433',
                'sp_city' => 1,
                'sp_createdBy' => 1,
            ),
            array(
                'sp_code' => 'XM1907154',
                'sp_name' => 'Xưởng Thanh Hà',
                'sp_email' => 'hathanh@alium.vn',
                'sp_phone' => '0898865433',
                'sp_city' => 2,
                'sp_createdBy' => 1,
            ),
        ]);

        DB::table('order')->insert([
            array(
                'od_code' => 'DH1907151',
                'od_name' => 'Vũ Hồng Quân',
                'od_email' => 'thanhnhan@alium.vn',
                'od_phone' => '0988727271',
                'od_createdBy' => 3,
                'od_assigneeTo' => 1,
                'od_status' => 2
            ),
            array(
                'od_code' => 'DH1907152',
                'od_name' => 'Ngô Bích Phượng',
                'od_email' => 'dkjd@alium.vn',
                'od_phone' => '0988727271',
                'od_createdBy' => 4,
                'od_assigneeTo' => 2,
                'od_status' => 2
            ),
        ]);

        DB::table('rating')->insert([
            array(
                'rate_star' => 4,
                'rate_content' => 'Chăm sóc nhiệt tình, phục vụ tốt',
                'rate_targetType' => \App\Models\Order::class,
                'rate_targetId' => 1,
                'rate_authorType' => \App\Models\User::class,
                'rate_authorId' => 3,
                'rate_status' => 2
            ),
            array(
                'rate_star' => 3,
                'rate_content' => 'Chăm sóc nhiệt tình, phục vụ tốt',
                'rate_targetType' => \App\Models\Order::class,
                'rate_targetId' => 2,
                'rate_authorType' => \App\Models\User::class,
                'rate_authorId' => 4,
                'rate_status' => 2
            ),
            array(
                'rate_star' => 5,
                'rate_content' => 'Chăm sóc nhiệt tình, phục vụ tốt',
                'rate_targetType' => \App\Models\Order::class,
                'rate_targetId' => 1,
                'rate_authorType' => \App\Models\User::class,
                'rate_authorId' => 4,
                'rate_status' => 2
            ),
        ]);
    }
}

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run()
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
        $superAdmin = Role::create(['name' => 'super-admin']);
        $admin = Role::create(['name' => 'admin']);
        Role::create(['name' => 'moderator']);
        Role::create(['name' => 'normal']);

        \App\Models\User::find(1)->assignRole('super-admin');
        \App\Models\User::find(2)->assignRole('admin');

        $editor = Permission::create(['name' => 'editor']);
        $sale = Permission::create(['name' => 'sale']);
        $saleManage = Permission::create(['name' => 'sale manager']);
        $customer = Permission::create(['name' => 'customer care']);
        $support = Permission::create(['name' => 'support']);
        $supplier = Permission::create(['name' => 'supplier']);

        $superAdmin->syncPermissions([$editor, $sale, $customer, $support,$saleManage, $supplier]);
        $admin->syncPermissions([$editor, $sale, $customer, $support,$saleManage, $supplier]);

    }
}

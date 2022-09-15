<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user')->insert([
            array(
                'user_id' => 1,
                'user_name' => 'quanvh',
                'user_showName' => 'Quân Vũ',
                'password' => '$2y$10$o7wLww6zVjsqLERXVG5M9.b6kK31aj5St8Bx5cgoAz86h2CVu31Va',
                'user_des' => 'Quân Vũ super administrator',
                'user_email' => 'quanvh.sebk@gmail.com',
                'user_phone' => '0975298868',
                'user_avatar' => '',
                'user_address' => '',
                'user_type' => \App\Http\DAL\DAL_Config::TYPE_USER_SYSTEM,
                'user_role' => \App\Http\DAL\DAL_Config::ROLE_USER_SP_ADMIN,
                'user_verify' => 1,
                'user_verifyCode' => time().uniqid(true),
                'remember_token' => '',
            ),
            array(
                'user_id' => 2,
                'user_name' => 'alium',
                'user_showName' => 'Alium',
                'password' => '$2y$10$o7wLww6zVjsqLERXVG5M9.b6kK31aj5St8Bx5cgoAz86h2CVu31Va',
                'user_des' => 'alium administrator',
                'user_email' => '',
                'user_phone' => '0967934206',
                'user_avatar' => '',
                'user_address' => '',
                'user_type' => \App\Http\DAL\DAL_Config::TYPE_USER_SYSTEM,
                'user_role' => \App\Http\DAL\DAL_Config::ROLE_USER_ADMIN,
                'user_verify' => 0,
                'user_verifyCode' => time().uniqid(true),
                'remember_token' => '',
            ),
//            array(
//                'user_id' => 3,
//                'user_name' => 'tester',
//                'user_showName' => 'BA Alium',
//                'password' => '$2y$10$o7wLww6zVjsqLERXVG5M9.b6kK31aj5St8Bx5cgoAz86h2CVu31Va',
//                'user_des' => 'alium administrator',
//                'user_email' => '',
//                'user_phone' => '0967934206',
//                'user_avatar' => '',
//                'user_address' => '',
//                'user_type' => \App\Http\DAL\DAL_Config::TYPE_USER_SYSTEM,
//                'user_role' => \App\Http\DAL\DAL_Config::ROLE_USER_ADMIN,
//                'user_verify' => 0,
//                'user_verifyCode' => time().uniqid(true),
//                'remember_token' => '',
//            ),

//            array(
//                'user_id' => 3,
//                'user_name' => 'nhanle',
//                'user_showName' => 'Thanh Nhàn',
//                'password' => '$2y$10$o7wLww6zVjsqLERXVG5M9.b6kK31aj5St8Bx5cgoAz86h2CVu31Va',
//                'user_des' => 'alium administrator',
//                'user_email' => 'nhan@alium.vn',
//                'user_phone' => '0967934206',
//                'user_avatar' => '',
//                'user_address' => '',
//                'user_type' => \App\Http\DAL\DAL_Config::TYPE_USER_REGISTER,
//                'user_role' => \App\Http\DAL\DAL_Config::ROLE_USER_NORMAL,
//                'user_verify' => 0,
//                'user_verifyCode' => time().uniqid(true),
//                'remember_token' => '',
//            ),
//            array(
//                'user_id' => 4,
//                'user_name' => 'phuongnt',
//                'user_showName' => 'Lê Thị Phượng',
//                'password' => '$2y$10$o7wLww6zVjsqLERXVG5M9.b6kK31aj5St8Bx5cgoAz86h2CVu31Va',
//                'user_des' => 'alium administrator',
//                'user_email' => 'phuong@alium.vn',
//                'user_phone' => '0967934206',
//                'user_avatar' => '',
//                'user_address' => '',
//                'user_type' => \App\Http\DAL\DAL_Config::TYPE_USER_REGISTER,
//                'user_role' => \App\Http\DAL\DAL_Config::ROLE_USER_NORMAL,
//                'user_verify' => 0,
//                'user_verifyCode' => time().uniqid(true),
//                'remember_token' => '',
//            ),
        ]);
    }
}

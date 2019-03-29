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
        // $this->call(UsersTableSeeder::class);
        // DB::table('bs_user')->insert([
        //     'username' => '大马1'
        // ]);
        // DB::table('bs_user')->insert([
        //     'username' => '大马2'
        // ]);
        // DB::table('bs_user')->insert([
        //     'username' => '大马3'
        // ]);
        // DB::table('bs_user')->insert([
        //     'username' => '大马4'
        // ]);

        DB::table('permissions')->insert([
            'fid'=> 0,
            'name' => '首页',
            'url'  => 'admin_home',
            'is_menu' => '1'
        ]);
        DB::table('permissions')->insert([
            'fid'=> 0,
            'name' => '系统设置',
            'url'  => '#',
            'is_menu' => '1'
        ]);
        DB::table('permissions')->insert([
            'fid'=> 2,
            'name' => '权限列表',
            'url'  => 'admin.permissions.list',
            'is_menu' => '1'
        ]);
        DB::table('permissions')->insert([
            'fid'=> 2,
            'name' => '权限添加',
            'url'  => 'admin.permissions.create',
            'is_menu' => '1'
        ]);
        DB::table('permissions')->insert([
            'fid'=> 2,
            'name' => '执行权限添加',
            'url'  => 'admin.permissions.doCreate',
            'is_menu' => '2'
        ]);
         DB::table('admin_users')->insert([
            'username'=>'admin',
            'password'=>md5('123qwe'),
            'image_url'=>'',
            'is_super'=>'2',
            'status'  =>'1'
        ]);
    }
}

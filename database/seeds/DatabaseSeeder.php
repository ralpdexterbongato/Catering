<?php

use Illuminate\Database\Seeder;
use App\CompanyMap;
use App\User;
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
        // CompanyMap::insert(['company_id'=>'1','city'=>'Surat','lat'=>'21.1702','lng'=>'72.8311']);
        User::insert(['name'=>'administrator','email'=>'randomail@yopmail.com','username'=>'admin','password'=>bcrypt('admin'),'role'=>'2','confirmation_code'=>'coDHNjnAuQStUmQBd3v0teM7iV5bId','verified'=>'0','avatar'=>'1513387225_5a3474d966de3.png']);
    }
}

<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name'  => 'wahyu',
            'email' => 'wahyu@gmail.com',
            'email_verified_at' => date("Y-m-d H:i:s", time()),
            'password' => bcrypt('wahyu1993'),
            'is_admin'  => true,
        ]);
    }
}

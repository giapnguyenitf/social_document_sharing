<?php

use App\Models\User;
use App\Models\Category;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'admin',
            'email' => 'admin@edocumentlab.com',
            'password' => bcrypt('notknow#1'),
            'rules' => 2,
        ]);

        Category::create([
            'name' => 'Khác',
            'parent_id' => 0,
        ]);
    }
}

<?php

use Illuminate\Database\Seeder;
Use App\Models\User;
Use App\Models\Category;

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
            'email' => 'admin@gmail.com',
            'password' => bcrypt('notknow#1'),
            'rules' => 2,
        ]);

        Category::create([
            'name' => 'Khác',
            'parent_id' => 0,
        ]);
    }
}

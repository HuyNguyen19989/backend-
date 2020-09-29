<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        DB::table('books')->insert([
            'book_name' => str::random(10),
            'description' => 'Bộ sách mẫu',
            'author' => 'Tác giả ',
            'book_category'=>'Kỹ năng sống',

        ]);
    }
}

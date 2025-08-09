<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('books')->insert([
            'id' => '1',
            'title' => 'Harry Potter',
            'author' => 'J.K. Rowling',
            'publisher' => 'Gramedia',
            'year' => '1990',
            'category_id' => '1',
            'book_gambar' => 'sada',
        ]);
    }
}

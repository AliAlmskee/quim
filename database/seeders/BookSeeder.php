<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Book;
use Illuminate\Support\Facades\DB;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $books = [
            [
                'name' => 'الـكَـوَاكِـبُ الـزَّاهِـرَةُ في الأربعين المتواترة',
                'photo' => '17260864791_unnamed.jpg',
            ],
        ];

        foreach ($books as $book) {
            Book::create($book);
        }

        DB::table('book_hadith')->insert([
            ['book_id' => 1, 'hadith_id' => 1],
            ['book_id' => 1, 'hadith_id' => 2],
            ['book_id' => 1, 'hadith_id' => 3],
        ]);
    }
}

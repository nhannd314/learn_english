<?php

namespace Database\Seeders;

use App\Models\Word;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WordSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'word' => 'apple',
                'ipa' => '/ˈæpəl/',
                'vn' => [
                    ['pos' => 'n', 'meaning' => 'quả táo']
                ],
            ],
            [
                'word' => 'comment',
                'ipa' => '/ˈkɒment/',
                'vn' => [
                    ['pos' => 'n', 'meaning' => 'sự bình luận'],
                    ['pos' => 'v', 'meaning' => 'bình luận']
                ],
            ],
            [
                'word' => 'run',
                'ipa' => '/rʌn/',
                'vn' => [
                    ['pos' => 'v', 'meaning' => 'chạy'],
                    ['pos' => 'n', 'meaning' => 'cuộc chạy']
                ],
            ],
        ];

        foreach ($data as $item) {
            Word::create($item);
        }
    }
}

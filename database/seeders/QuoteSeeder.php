<?php

namespace Database\Seeders;

use App\Models\Quote;
use Illuminate\Database\Seeder;

class QuoteSeeder extends Seeder
{
    public function run(): void
    {
        Quote::insert([
            [
                'text' => 'Простота — это высшая форма изысканности.',
                'author' => 'Леонардо да Винчи',
                'category' => 'wisdom',
                'bg_color' => '#FFDE00',
                'text_color' => '#000000',
            ],
            [
                'text' => 'Делай то, что можешь, с тем, что имеешь, там, где ты есть.',
                'author' => 'Теодор Рузвельт',
                'category' => 'motivation',
                'bg_color' => '#00FF41',
                'text_color' => '#000000',
            ],
            [
                'text' => 'Единственный способ делать великую работу — любить то, что ты делаешь.',
                'author' => 'Стив Джобс',
                'category' => 'motivation',
                'bg_color' => '#FF3300',
                'text_color' => '#FFFFFF',
            ],
            [
                'text' => 'Будь собой; прочие роли уже заняты.',
                'author' => 'Оскар Уайльд',
                'category' => 'wisdom',
                'bg_color' => '#000000',
                'text_color' => '#FFDE00',
            ],
            [
                'text' => 'Не бойся идти медленно — бойся стоять на месте.',
                'author' => 'Китайская пословица',
                'category' => 'wisdom',
                'bg_color' => '#FF6600',
                'text_color' => '#000000',
            ],
            [
                'text' => 'Жизнь — это то, что с тобой происходит, пока ты строишь другие планы.',
                'author' => 'Джон Леннон',
                'category' => 'life',
                'bg_color' => '#CC00FF',
                'text_color' => '#FFFFFF',
            ],
            [
                'text' => 'В середине хаоса скрывается возможность.',
                'author' => 'Альберт Эйнштейн',
                'category' => 'motivation',
                'bg_color' => '#00E5FF',
                'text_color' => '#000000',
            ],
        ]);
    }
}

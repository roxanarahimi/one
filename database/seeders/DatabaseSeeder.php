<?php

namespace Database\Seeders;

use App\Models\ArticleCategory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
            \App\Models\ArticleCategory::factory()
            ->has(\App\Models\Article::factory()->count(3))
            ->create();
    }
}

<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\Movie::class, 50)->create();
//        factory(App\Article::class, 50)->create()->each(function ($article) {
//            $article->categories()->sync($article->category_id);
//        });
    }
}

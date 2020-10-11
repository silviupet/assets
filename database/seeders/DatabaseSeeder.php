<?php

namespace Database\Seeders;

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
        \App\Models\User::factory(10)->create();
//

//        factory(App\User::class, 10)->create()->each(function ($user) {
//            $user->assets()->save(factory(App\Asset::class)->make());
//        });


//        $asset->atributes()->save(factory(App\Attribute::class)->make());
//
//
//        $asset->categories()->save(factory(App\Category::class)->make());
//
//        $atribute->tags()->save(factory(App\Tag::class)->make());
//        $atribute->documents()->save(factory(App\Document::class)->make());
//

    }

}

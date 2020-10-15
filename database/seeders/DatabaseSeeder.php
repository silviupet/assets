<?php

namespace Database\Seeders;

use App\Models\Asset;
use App\Models\Category;
use App\Models\Document;
use App\Models\Tag;
use App\Models\User;
use App\Models\Team;
use App\Models\Atribute;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;



class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS =0');
        DB::table('users')->truncate();
        DB::table('assets')->truncate();
        DB::table('atributes')->truncate();
        DB::table('categories')->truncate();
        DB::table('documents')->truncate();
        DB::table('tags')->truncate();
        Db::table('teams')->truncate();
        Db::table('asset_atribute')->truncate();
        Db::table('team_user')->truncate();
        Db::table('atribute_tag')->truncate();






// creare 10 useri si pt fiecare creare 10 asset (user->assets() rel one to many)
       User::factory(10)->create()->each(function($user) {
           $user->assets()->save(Asset::factory()->make());

       });
        User::factory()->make()->each(function($user) {
            $user->teams()->save(Team::factory()->make());
        });
////        });
// creare 10 atribute legate de cele 10 asseturi create anterior   (asset->atributes() rel one to many)
        Asset::factory()->make()->each(function($asset) {
            $asset->atributes()->save(Atribute::factory()->make());

        });
//creare 10 category
        Category::factory(10)->create();
//pt fiecare atribut creare 10 tag (atribute->tags() - many to many
        Atribute::factory()->make()->each(function($atribute){
            $atribute->tags()->save(Tag::factory()->make());
        });
//pt fiecare atribut creare documente (atribute->documents() - one to many
        Atribute::factory()->make()->each(function($atribute){
            $atribute->documents()->save(Document::factory()->make());
        });


    }

}

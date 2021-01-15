<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Cviebrock\EloquentSluggable\Sluggable;


class Asset extends Model
{
    use HasFactory;
    use SoftDeletes;
    use Sluggable;

    protected $fillable = [
        'name',
        'user_id',
        'category_id',
        'user_id',
        'team_id',
        'slug'

    ];
//    one to many - un user mai multe asseturi
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
//    one to many un assets are mai multe atrinute
    public function atributes()
    {
        return $this->hasMany('App\Models\Atribute');
    }
//    one to many intr-o categorie sunt mai multe asseturi
    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable() :array
    {
        return [
            'slug' => [
                'source' => 'name',
                'onUpdate' =>true
            ]
        ];
    }


    public static function boot ()
    {
        parent::boot();

        self::deleting(function (Asset $event) {

            foreach ($event->atributes as $atribute)
            {
                $atribute->delete();
            }
        });
    }

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Asset extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'user_id',
        'category_id',
        'user_id',
        'team_id'

    ];
//    one to many - un user mai multe asseturi
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
//    many to many un assets are mai multe atrinute si invers
    public function atributes()
    {
        return $this->belongsToMany('App\Models\Atribute');
    }
//    one to many intr-o categorie sunt mai multe asseturi
    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }



}

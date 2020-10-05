<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Asset extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'user_id',
        'deleted_at'
    ];
//    one to many - un user mai multe asseturi
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
//    many to many un assets are mai multe atrinute si invers
    public function atribute()
    {
        return $this->belongsToMany('App\Models\Atribute');
    }
//    one to many intr-o categorie sunt mai multe asseturi
    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }

}

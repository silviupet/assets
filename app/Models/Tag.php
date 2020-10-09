<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tag extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable =  [
        'name',
        'user_id',
        'team_id'
        ];
    public function atributes()
    {
       return $this->belongsToMany('App\Models\Atribute');
    }


}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Document extends Model
{
    use HasFactory;
    protected $fillable = ['name',
                            'link',
                            'atribute_id',
                            'user_id',
                            'team_id'
                        ];
    use SoftDeletes;
    public function asset()
    {
       return $this->belongsTo('App\Models\Atribute');


    }

}

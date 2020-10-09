<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Atribute extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = ['name',
                            'description',
                            'from_date',
                            'expiry_date',
                            'price',
                            'currency',
                            'vendor',
                            'other_condition',
                            'document_id',
                            'user_id',
                            'team_id'
                            ];

     public function assets()
     {
         return $this->belongsToMany('App\Models\Asset');
     }

     public function documents()
     {
         return $this->hasMany('App\Models\Documents');
     }

     public function tags()
     {
         return $this->belongsToMany('App\Models\Tag');
     }
}

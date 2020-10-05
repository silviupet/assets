<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected fillable [
        'name';
        'asset_id';
        ];
    public function assets()
    {
        return $this->hasMany('App\Models\Asset')
    }

}

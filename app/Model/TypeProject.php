<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class TypeProject extends Model
{
    use HasTranslations;

    protected $translatable =[
        "name",
        "description"
    ];

    public function brief(){
       return $this->hasOne(Brief::class,'type_project_id');
    }
}

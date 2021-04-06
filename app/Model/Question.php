<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Question extends Model
{
    use HasTranslations;

    protected $translatable =[
        "question",
        "note"
    ];

    public function brief(){
        return $this->belongsTo(Brief::class);
    }
}

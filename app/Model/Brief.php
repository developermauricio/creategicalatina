<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Brief extends Model
{
    use HasTranslations;

    protected $translatable =[
        "title",
        "note"
    ];

    public function question(){
        return $this->hasMany(Question::class, 'brief_id');
    }
}

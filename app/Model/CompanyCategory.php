<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class CompanyCategory extends Model
{
    use HasTranslations;
    protected $translatable =[
        "name",
        "description"
    ];
}

<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Archive extends Model
{
    protected $fillable = ['uuid', 'archive', 'archivable_id', 'archivable_type', 'type'];
    public function archivable(){
        return $this->morphTo();
    }
}

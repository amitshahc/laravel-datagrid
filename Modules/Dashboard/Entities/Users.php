<?php

namespace Modules\Dashboard\Entities;

use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    protected $fillable = [];

    public function filters()
    {
        return $this->hasMany('Modules\Dashboard\Entities\Filters','user_id');
    }    
}

<?php

namespace Modules\Dashboard\Entities;

use Illuminate\Database\Eloquent\Model;

class Filters extends Model
{
    protected $fillable = ['name', 'user_id', 'public'];
}

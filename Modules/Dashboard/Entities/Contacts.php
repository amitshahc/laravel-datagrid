<?php

namespace Modules\Dashboard\Entities;

use Illuminate\Database\Eloquent\Model;

class Contacts extends Model
{
    protected $fillable = ['name','email','phone','gender','age'];
}

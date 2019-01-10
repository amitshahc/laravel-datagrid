<?php

namespace Modules\Dashboard\Entities\Repository\Eloquents;

use Modules\Dashboard\Entities\Repository\Interfaces\Contacts as ContactsContract;
use Modules\Dashboard\Entities\Contacts as ContactsModel;

class Contacts implements ContactsContract
{
    protected $model;

    public function __construct(ContactsModel $model)
    {
        $this->model = $model;
    }

    public function getList(){
        // \DB::enableQueryLog();
        return $this->model::all('id','name','email','phone','gender','age');
        // dd(\DB::getQueryLog());
    }
}

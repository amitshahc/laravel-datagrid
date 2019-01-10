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
        //return $this->model::select('id','name','email','phone','gender','age')->limit(100)->get();
        return $this->model::select('id','name','email','phone','gender','age')->paginate(100);
        // dd(\DB::getQueryLog());
    }
}

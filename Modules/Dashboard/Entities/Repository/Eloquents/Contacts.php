<?php

namespace Modules\Dashboard\Entities\Repository\Eloquents;

use Modules\Dashboard\Entities\Contacts as ContactsModel;
use Modules\Dashboard\Entities\Repository\Interfaces\Contacts as ContactsContract;
use Modules\Dashboard\Entities\Repository\Traits\Contacts as ContactsTrait;
use Modules\Dashboard\Entities\Repository\Traits\Filters as FiltersTrait;

class Contacts implements ContactsContract
{
    use ContactsTrait;
    use FiltersTrait;
    protected $model;
    protected $userId;

    public function __construct(ContactsModel $model)
    {
        $this->model = $model;
    }

    public function setUserId($id)
    {
        $this->userId = $id;
    }

    public function beginTransaction()
    {
        \DB::beginTransaction();
    }

    public function rollBack()
    {
        \DB::rollBack();
    }

    public function commit()
    {
        \DB::commit();
    }
}

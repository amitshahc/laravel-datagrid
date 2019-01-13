<?php

namespace Modules\Dashboard\Entities\Repository\Interfaces;

interface Contacts
{
    public function setUserId($id);
    public function beginTransaction();
    public function rollBack();
    public function commit();

    public function getList();
    public function getFilteredList($filter);

    public function createFilter($data);
}

<?php

namespace Modules\Dashboard\Entities\Repository\Traits;
use Modules\Dashboard\Entities\Filters as FilterModel;

trait Filters
{
    public function createFilter($data)
    {
        $data['user_id'] = $this->userId;

        return FilterModel::create($data);
    }
}


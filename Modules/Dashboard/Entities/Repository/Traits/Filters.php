<?php

namespace Modules\Dashboard\Entities\Repository\Traits;

use Modules\Dashboard\Entities\Filters as FilterModel;
use Modules\Dashboard\Entities\Users as UserModel;

trait Filters
{
    public function createFilter($data)
    {
        $data['user_id'] = $this->userId;

        return FilterModel::create($data);
    }

    public function getFilters_public()
    {
        $user = UserModel::findOrFail($this->userId);        
        return $user->filters()->public()->get();
        //return FilterModel::wherePublic(true)->get();
    }

    public function getFilters_private()
    {
        $user = UserModel::findOrFail($this->userId);        
        return $user->filters()->private()->get();

        // return FilterModel::wherePublic(false)
        // ->whereUserId($this->userId)
        // ->get();
    }
}

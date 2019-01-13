<?php

namespace Modules\Dashboard\Entities\Repository\Traits;

trait Contacts
{
    public function getList()
    {
        // \DB::enableQueryLog();
        //return $this->model::select('id','name','email','phone','gender','age')->limit(100)->get();
        return $this->model::select('id', 'name', 'email', 'phone', 'gender', 'age')->paginate(100);
        // dd(\DB::getQueryLog());
    }

    public function getFilteredList($filter)
    {
        \DB::enableQueryLog();
        $query = $this->model::select('id', 'name', 'email', 'phone', 'gender', 'age');

        if (isset($filter['name_value']) && isset($filter['name_operator'])) {
            $filter['name_value'] = $filter['name_operator'] === 'like' ? '%' . $filter['name_value'] . '%' : $filter['name_value'];
            $query = $query->where('name', $filter['name_operator'], $filter['name_value']);
        }

        if (isset($filter['email_value']) && isset($filter['email_operator'])) {
            $filter['email_value'] = $filter['email_operator'] === 'like' ? '%' . $filter['email_value'] . '%' : $filter['email_value'];
            $query = $query->where('email', $filter['email_operator'], $filter['email_value']);
        }

        if (isset($filter['phone_value']) && isset($filter['phone_operator'])) {
            $filter['phone_value'] = $filter['phone_operator'] === 'like' ? '%' . $filter['phone_value'] . '%' : $filter['phone_value'];
            $query = $query->where('phone', $filter['phone_operator'], $filter['phone_value']);
        }

        if (isset($filter['gender_value'])) {
            $query = $query->where('gender', $filter['gender_value']);
        }

        if (isset($filter['age_value']) && isset($filter['age_operator'])) {
            $query = $query->where('age', $filter['age_operator'], $filter['age_value']);
        }

        return $query->paginate(100);
        //dd(\DB::getQueryLog());
    }
}

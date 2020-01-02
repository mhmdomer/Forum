<?php

namespace App\Filters;


class ThreadFilters extends Filters
{

    public $filters = ['by'];

    public function by($name) {
        $user = \App\User::where('name', $name)->firstOrFail();
        $this->builder->where('user_id', $user->id);
    }

}
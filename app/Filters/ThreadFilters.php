<?php

namespace App\Filters;


class ThreadFilters extends Filters
{

    public $filters = ['by', 'popular', 'unanswered'];

    protected function by($name)
    {
        $user = \App\User::where('name', $name)->firstOrFail();
        $this->builder->where('user_id', $user->id);
    }

    protected function popular($popular) {
        // clear up the default orders and order by popularity
        $this->builder->getQuery()->orders = [];
        return $this->builder->orderBy('replies_count', 'desc');
    }

    protected function unanswered($unanswered) {
        $this->builder->getQuery()->orders = [];
        return $this->builder->doesntHave('replies');
    }
}

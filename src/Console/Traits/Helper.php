<?php

namespace Rekamy\Generator\Console\Traits;

trait Helper
{
    public $whereLike;

    public function whereLike(string $attribute, string $searchTerm)
    {
		return $this->orWhere($attribute, 'LIKE', "%{$searchTerm}%");
    }
}

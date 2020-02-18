<?php

namespace Rekamy\Generator\Console\Traits;

trait Helper
{
  public $like;

  public function like(string $attribute, string $searchTerm)
  {
    return $this->orWhere($attribute, 'LIKE', "%{$searchTerm}%");
  }
}

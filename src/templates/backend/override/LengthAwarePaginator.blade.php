<?="
<?php

namespace App\Contracts\Overrides;

use Illuminate\Pagination\LengthAwarePaginator as BaseLengthAwarePaginator;

class LengthAwarePaginator extends BaseLengthAwarePaginator
{
    /**
     * Get the instance as an array.
     *
     * @return array
     */
    public function toArray()
    {
        return [
            'draw' => (int) request()->get('draw'),
            'current_page' => \$this->currentPage(),
            'data' => \$this->items->toArray(),
            'first_page_url' => \$this->url(1),
            'from' => \$this->firstItem(),
            'last_page' => \$this->lastPage(),
            'last_page_url' => \$this->url(\$this->lastPage()),
            'links' => \$this->linkCollection()->toArray(),
            'next_page_url' => \$this->nextPageUrl(),
            'path' => \$this->path(),
            'per_page' => \$this->perPage(),
            'prev_page_url' => \$this->previousPageUrl(),
            'to' => \$this->lastItem(),
            'recordsTotal' => \$this->items->count(),
            'recordsFiltered' => \$this->total(),
        ];
    }

    /**
     * Get the current page for the request.
     *
     * @param  int  \$currentPage
     * @param  string  \$pageName
     * @return int
     */
    protected function setCurrentPage(\$currentPage, \$pageName)
    {
        \$currentPage = \$currentPage ?: static::resolveCurrentPage('start');

        return \$this->isValidPageNumber(\$currentPage) ? (int) \$currentPage : 1;
    }
}
"
?>
<?="<?php

namespace App\Contracts\Bloc\Concerns;

trait HasAuditorRelations
{
    public function author()
    {
        return \$this->belongsTo(User::class, 'created_by');
    }

    public function editor()
    {
        return \$this->belongsTo(User::class, 'updated_by');
    }

    public function deletedBy()
    {
        return \$this->belongsTo(User::class, 'deleted_by');
    }
}
"
?>
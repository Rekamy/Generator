<?=
"<?php

namespace $namespace;

use App\Contracts\Repositories\Concerns\CrudableRepository;
use App\Contracts\Repositories\CrudRepositoryInterface;
use App\Models\\$modelName;
use Prettus\Repository\Eloquent\BaseRepository;

/**
 * Class $className
 * @package App\Repositories
 *
 * @method $modelName find(\$id, \$columns = ['*'])
 * @method $modelName find(\$id, \$columns = ['*'])
 * @method $modelName first(\$columns = ['*'])
*/
class $className extends BaseRepository implements CrudRepositoryInterface
{
    use CrudableRepository;

    /**
     * @var array
     */
    protected \$fieldSearchable = [\n"?>
<?php
    foreach ($columns as $column) { 
        echo "\t\t'" . $column->getName() . "',\n";
    } 
?>
<?="\t];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return $modelName::class;
    }
    
}

"?>
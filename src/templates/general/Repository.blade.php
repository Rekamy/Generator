<?=
"<?php

namespace $namespace;

use Illuminate\Pagination\Paginator;
use App\Models\\$modelName;
use Prettus\Repository\Eloquent\BaseRepository;
use DB;
use Exception;

/**
 * Class $className
 * @package App\Repositories
 *
 * @method $modelName find(\$id, \$columns = ['*'])
 * @method $modelName find(\$id, \$columns = ['*'])
 * @method $modelName first(\$columns = ['*'])
*/
class $className extends BaseRepository
{
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
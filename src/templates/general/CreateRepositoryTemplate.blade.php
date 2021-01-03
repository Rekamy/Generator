<?=
"<?php

namespace " . $context->namespace['repository'] . ";

use Illuminate\Pagination\Paginator;
use App\Models\\" . ucfirst(Str::camel(Str::singular($tablename))) . ";
use Prettus\Repository\Eloquent\BaseRepository;
use DB;
use Exception;

/**
 * Class " . ucfirst(Str::camel(Str::singular($tablename))) . "Repository
 * @package App\Repositories
 *
 * @method " . ucfirst(Str::camel(Str::singular($tablename))) . " find(\$id, \$columns = ['*'])
 * @method " . ucfirst(Str::camel(Str::singular($tablename))) . " find(\$id, \$columns = ['*'])
 * @method " . ucfirst(Str::camel(Str::singular($tablename))) . " first(\$columns = ['*'])
*/
class " . ucfirst(Str::camel(Str::singular($tablename))) . "Repository extends BaseRepository
{
    /**
     * @var array
     */
    protected \$fieldSearchable = [
"?>
    <?php
    foreach ($db->columns as $i => $column) { 
        if($column->TABLE_NAME == $tablename) {
            echo "\n\t\t'" . $column->COLUMN_NAME . "',";
        }
    } ?>
<?="
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return " . ucfirst(Str::camel(Str::singular($tablename))) . "::class;
    }
    
}

"?>

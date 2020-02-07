<?=
"<?php

namespace App\Repositories;

use App\Models\\" . ucfirst(Str::camel(Str::singular($tablename))) . ";
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class " . ucfirst(Str::camel(Str::singular($tablename))) . "Repository
 * @package App\Repositories
 * @version April 10, 2019, 3:42 am +08
 *
 * @method " . ucfirst(Str::camel(Str::singular($tablename))) . " findWithoutFail(\$id, \$columns = ['*'])
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

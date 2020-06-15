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
    
    public function " . lcfirst(Str::camel($tablename)) . "(\$input)
	{
		Paginator::currentPageResolver(function () use (\$input) {
			return (\$input['start'] / \$input['length'] + 1);
		});

		\$model = \$this;

		if (!empty(\$input['search']['value'])) {
			foreach (\$this->fieldSearchable as \$column) {
				\$model = \$model->whereLike(\$column, \$input['search']['value']);
			}
		}

		return \$model->paginate(\$input['length']);
    }
    
    public function create" . ucfirst(Str::camel(Str::singular($tablename))) . "(\$input)
	{
		DB::beginTransaction();
		try {
			if (!\$this->create(\$input)) {
				throw new Exception('Error Processing Request', 405);
			}
			DB::commit();
		} catch (\Throwable \$th) {
			DB::rollBack();
			throw new Exception(\$th->getMessage(), \$th->getCode());
		}
	}
    
    public function show" . ucfirst(Str::camel(Str::singular($tablename))) . "(\$id)
	{
		try {
			if (!\$" . lcfirst(Str::camel(Str::singular($tablename))) . " = \$this->find(\$id)) {
				throw new Exception('Error Processing Request', 405);
			}
			return \$this->successResponse('Successfully Update Data', \$" . lcfirst(Str::camel(Str::singular($tablename))) . ");
		} catch (\Throwable \$th) {
			return \$this->failResponse(\$th->getMessage(), \$th->getCode());
		}
	}

    public function update" . ucfirst(Str::camel(Str::singular($tablename))) . "(\$id, \$input)
	{
		DB::beginTransaction();
		try {
			if (!\$this->update(\$input, \$id)) {
				throw new Exception('Error Processing Request', 405);
			}
			DB::commit();
		} catch (\Throwable \$th) {
			DB::rollBack();
			throw new Exception(\$th->getMessage(), \$th->getCode());
		}
	}

	public function delete" . ucfirst(Str::camel(Str::singular($tablename))) . "(\$id)
	{
		DB::beginTransaction();
		try {
			if (!\$this->delete(\$id)) {
				throw new Exception('Error Processing Request', 405);
			}
			DB::commit();
			return \$this->successResponse('Data Has Been Deleted');
		} catch (\Throwable \$th) {
			DB::rollBack();
			return \$this->failResponse(\$th->getMessage(), \$th->getCode());
		}
	}
}

"?>

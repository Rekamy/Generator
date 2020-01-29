<?=
    "<?php

namespace " . $context->namespace['api_controller'] . ";

use App\Http\Requests\API\Create" . ucfirst(Str::camel(Str::singular($tablename))) . "APIRequest;
use App\Http\Requests\API\Update" . ucfirst(Str::camel(Str::singular($tablename))) . "APIRequest;
use App\Models\\" . ucfirst(Str::camel(Str::singular($tablename))) . ";
use App\Repositories\\" . ucfirst(Str::camel(Str::singular($tablename))) . "Repository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class " . ucfirst(Str::camel(Str::singular($tablename))) . "Controller
 * @package " . $context->namespace['api_controller'] . "
 */
class " . ucfirst(Str::camel(Str::singular($tablename))) . "APIController extends AppBaseController
{
    /** @var  " . ucfirst(Str::camel(Str::singular($tablename))) . "Repository */
    private \$" . Str::camel(Str::singular($tablename)) . "Repository;

    public function __construct(" . ucfirst(Str::camel(Str::singular($tablename))) . "Repository \$" . Str::camel(Str::singular($tablename)) . "Repo)
    {
        \$this->" . Str::camel(Str::singular($tablename)) . "Repository = \$" . Str::camel(Str::singular($tablename)) . "Repo;
    }

    /**
     * @param Request \$request
     * @return Response
     * @OA\Get(
     *     path=\"/api/" . lcfirst(Str::singular(str_replace('_', '', $tablename))) . "\",
     *     tags={\"" . ucfirst(Str::singular(str_replace('_', '', $tablename))) . "\"},
     *     summary=\"Get list of " . ucfirst(str_replace('_', '', $tablename)) . "\",
     *     description=\"Get " . ucfirst(str_replace('_', '', $tablename)) . "\",
     *     @OA\Response(response=200, description=\"" . ucfirst(Str::singular(str_replace('_', '', $tablename))) . " Module\"),
     *     @OA\Response(response=400, description=\"Bad request\"),
     *     @OA\Response(response=404, description=\"Resource Not Found\"),
     *     security={{\"passport\": {\"*\"}}},
     * )
     */
    public function index(Request \$request)
    {
        \$this->" . Str::camel(Str::singular($tablename)) . "Repository->pushCriteria(new RequestCriteria(\$request));
        \$this->" . Str::camel(Str::singular($tablename)) . "Repository->pushCriteria(new LimitOffsetCriteria(\$request));
        \$" . Str::camel($tablename) . " = \$this->" . Str::camel(Str::singular($tablename)) . "Repository->paginate(10);

        return \$this->sendResponse(\$" . Str::camel($tablename) . "->toArray(), '" . Str::singular(ucFirst(str_replace('_', ' ', $tablename))) . " retrieved successfully');
    }

    /**
     * @param Create" . ucfirst(Str::camel(Str::singular($tablename))) . "APIRequest \$request
     * @return Response
     * @OA\Post(
     *     path=\"/api/" . lcfirst(Str::singular(str_replace('_', '', $tablename))) . "\",
     *     tags={\"" . ucfirst(Str::singular(str_replace('_', '', $tablename))) . "\"},
     *     summary=\"Store a " . ucfirst(Str::singular(str_replace('_', '', $tablename))) . " into database\",
     *     description=\"Store " . ucfirst(str_replace('_', '', $tablename)) . "\",
     *     @OA\Response(response=200, description=\"" . ucfirst(Str::singular(str_replace('_', '', $tablename))) . " Module\"),
     *     @OA\Response(response=400, description=\"Bad request\"),
     *     @OA\Response(response=404, description=\"Resource Not Found\"),
     *     security={{\"passport\": {\"*\"}}}," ?> 
    <?php foreach ($db->columns as $i => $column) {
        if ($column->COLUMN_NAME == "id" || strpos($column->COLUMN_NAME, "_at") || strpos($column->COLUMN_NAME, "_by") || $column->COLUMN_NAME == "status_id") {
            continue;
        }
        if ($column->TABLE_NAME == $tablename) {
            if ($column->ORDINAL_POSITION == 2) { ?>
<?= " *     @OA\Parameter(
     *          name=\"" . $column->COLUMN_NAME . "\",
     *          in=\"query\",\n" ?>
<?php if ($column->IS_NULLABLE == "NO") { ?>
    <?= "\t *          required=true,
     *          @OA\Schema(" ?>
    <?php if ($column->DATA_TYPE == "integer" || $column->DATA_TYPE == "int") { ?>
    <?= "\n\t *              type=\"integer\"" ?>
    <?php } else if ($column->DATA_TYPE == "datetime" || $column->DATA_TYPE == "timestamp") { ?>
    <?= "\n\t *              type=\"datetime\"" ?>
    <?php } else { ?>
    <?= "\n\t *              type=\"string\"" ?>
    <?php } ?>
<?= "\n\t *          )," ?>
<?php } else { ?>
    <?= "\t *          required=false,
     *          @OA\Schema(" ?>
    <?php if ($column->DATA_TYPE == "integer" || $column->DATA_TYPE == "int") { ?>
    <?= "\n\t *              type=\"integer\"" ?>
    <?php } else if ($column->DATA_TYPE == "datetime" || $column->DATA_TYPE == "timestamp") { ?>
    <?= "\n\t *              type=\"datetime\"" ?>
    <?php } else { ?>
    <?= "\n\t *              type=\"string\"" ?>
    <?php } ?>
<?= "\n\t *          )," ?>

<?php } ?>
<?= "\n\t *     )," ?>
    <?php } else { ?>
<?= "\n\t *     @OA\Parameter(
     *          name=\"" . $column->COLUMN_NAME . "\",
     *          in=\"query\",\n" ?>
<?php if ($column->IS_NULLABLE == "NO") { ?>
<?= "\t *          required=true,
     *          @OA\Schema(" ?>
    <?php if ($column->DATA_TYPE == "integer" || $column->DATA_TYPE == "int") { ?>
    <?= "\n\t *              type=\"integer\"" ?>
    <?php } else if ($column->DATA_TYPE == "datetime" || $column->DATA_TYPE == "timestamp") { ?>
    <?= "\n\t *              type=\"datetime\"" ?>
    <?php } else { ?>
    <?= "\n\t *              type=\"string\"" ?>
    <?php } ?>
<?= "\n\t *          )," ?>
<?php } else { ?>
<?= "\t *          required=false,
     *          @OA\Schema(" ?>
    <?php if ($column->DATA_TYPE == "integer" || $column->DATA_TYPE == "int") { ?>
    <?= "\n\t *              type=\"integer\"" ?>
    <?php } else if ($column->DATA_TYPE == "datetime" || $column->DATA_TYPE == "timestamp") { ?>
    <?= "\n\t *              type=\"datetime\"" ?>
    <?php } else { ?>
    <?= "\n\t *              type=\"string\"" ?>
    <?php } ?>
<?= "\n\t *          )," ?>
<?php } ?>
<?= "\n\t *     )," ?>
     <?php
                }
            }
        } ?><?= "
     * )
     */
    public function store(Create" . ucfirst(Str::camel(Str::singular($tablename))) . "APIRequest \$request)
    {
        \$input = \$request->all();

        \$" . Str::camel($tablename) . " = \$this->" . Str::camel(Str::singular($tablename)) . "Repository->create(\$input);

        return \$this->sendResponse(\$" . Str::camel($tablename) . "->toArray(), '" . Str::singular(ucFirst(str_replace('_', ' ', $tablename))) . " saved successfully');
    }

    /**
     * @param int \$id
     * @return Response
     * @OA\Get(
     *     path=\"/api/" . lcfirst(Str::singular(str_replace('_', '', $tablename))) . "/{id}\",
     *     tags={\"" . ucfirst(Str::singular(str_replace('_', '', $tablename))) . "\"},
     *     summary=\"Get a " . ucfirst(Str::singular(str_replace('_', '', $tablename))) . " by ID\",
     *     description=\"Get " . ucfirst(str_replace('_', '', $tablename)) . " by id\",
     *     @OA\Response(response=200, description=\"" . ucfirst(Str::singular(str_replace('_', '', $tablename))) . " Module\"),
     *     @OA\Response(response=400, description=\"Bad request\"),
     *     @OA\Response(response=404, description=\"Resource Not Found\"),
     *     security={{\"passport\": {\"*\"}}},
     *     @OA\Parameter(
     *          name=\"id\",
     *          in=\"path\",
     *          required=true,
     *          @OA\Schema(
     *              type=\"integer\"
     *          )
     *     ),
     * )
     */
    public function show(\$id)
    {
        /** @var " . ucFirst(Str::camel(Str::singular($tablename))) . " \$" . Str::camel($tablename) . " */
        \$" . Str::camel($tablename) . " = \$this->" . Str::camel(Str::singular($tablename)) . "Repository->findWithoutFail(\$id);

        if (empty(\$" . Str::camel($tablename) . ")) {
            return \$this->sendError('" . Str::singular(ucFirst(str_replace('_', ' ', $tablename))) . " not found');
        }

        return \$this->sendResponse(\$" . Str::camel($tablename) . "->toArray(), '" . Str::singular(ucFirst(str_replace('_', ' ', $tablename))) . " retrieved successfully');
    }

    /**
     * @param int \$id
     * @param Update" . ucfirst(Str::camel(Str::singular($tablename))) . "APIRequest \$request
     * @return Response
     * @OA\Patch(
     *     path=\"/api/" . lcfirst(Str::singular(str_replace('_', '', $tablename))) . "/{id}\",
     *     tags={\"" . ucfirst(Str::singular(str_replace('_', '', $tablename))) . "\"},
     *     summary=\"Update a " . ucfirst(Str::singular(str_replace('_', '', $tablename))) . " by ID\",
     *     description=\"Update " . ucfirst(str_replace('_', '', $tablename)) . "\",
     *     @OA\Response(response=200, description=\"" . ucfirst(Str::singular(str_replace('_', '', $tablename))) . " Module\"),
     *     @OA\Response(response=400, description=\"Bad request\"),
     *     @OA\Response(response=404, description=\"Resource Not Found\"),
     *     security={{\"passport\": {\"*\"}}}," ?> 
    <?php foreach ($db->columns as $i => $column) {
        if (strpos($column->COLUMN_NAME, "_at") || strpos($column->COLUMN_NAME, "_by") || $column->COLUMN_NAME == "status_id") {
            continue;
        }
        if ($column->TABLE_NAME == $tablename) {
            if ($column->ORDINAL_POSITION == 2) { ?>
<?= " *     @OA\Parameter(
     *          name=\"" . $column->COLUMN_NAME . "\",
     *          in=\"query\",\n" ?>
<?php if ($column->IS_NULLABLE == "NO") { ?>
    <?= "\t *          required=true,
     *          @OA\Schema(" ?>
    <?php if ($column->DATA_TYPE == "integer" || $column->DATA_TYPE == "int") { ?>
    <?= "\n\t *              type=\"integer\"" ?>
    <?php } else if ($column->DATA_TYPE == "datetime" || $column->DATA_TYPE == "timestamp") { ?>
    <?= "\n\t *              type=\"datetime\"" ?>
    <?php } else { ?>
    <?= "\n\t *              type=\"string\"" ?>
    <?php } ?>
<?= "\n\t *          )," ?>
<?php } else { ?>
    <?= "\t *          required=false,
     *          @OA\Schema(" ?>
    <?php if ($column->DATA_TYPE == "integer" || $column->DATA_TYPE == "int") { ?>
    <?= "\n\t *              type=\"integer\"" ?>
    <?php } else if ($column->DATA_TYPE == "datetime" || $column->DATA_TYPE == "timestamp") { ?>
    <?= "\n\t *              type=\"datetime\"" ?>
    <?php } else { ?>
    <?= "\n\t *              type=\"string\"" ?>
    <?php } ?>
<?= "\n\t *          )," ?>
<?php } ?>
<?= "\n\t *     )," ?>
    <?php } else { ?>
<?= "\n\t *     @OA\Parameter(
     *          name=\"" . $column->COLUMN_NAME . "\"," ?>
    <?php if ($column->COLUMN_NAME == "id") { ?>
        <?= " *          in=\"path\",\n" ?>
        <?php } else { ?>
        <?= " *          in=\"query\",\n" ?>
        <?php } ?>
<?php if ($column->IS_NULLABLE == "NO") { ?>
    <?= "\t *          required=true,
     *          @OA\Schema(" ?>
    <?php if ($column->DATA_TYPE == "integer" || $column->DATA_TYPE == "int") { ?>
    <?= "\n\t *              type=\"integer\"" ?>
    <?php } else if ($column->DATA_TYPE == "datetime" || $column->DATA_TYPE == "timestamp") { ?>
    <?= "\n\t *              type=\"datetime\"" ?>
    <?php } else { ?>
    <?= "\n\t *              type=\"string\"" ?>
    <?php } ?>
<?= "\n\t *          )," ?>
<?php } else { ?>
    <?= "\t *          required=false,
     *          @OA\Schema(" ?>
    <?php if ($column->DATA_TYPE == "integer" || $column->DATA_TYPE == "int") { ?>
    <?= "\n\t *              type=\"integer\"" ?>
    <?php } else if ($column->DATA_TYPE == "datetime" || $column->DATA_TYPE == "timestamp") { ?>
    <?= "\n\t *              type=\"datetime\"" ?>
    <?php } else { ?>
    <?= "\n\t *              type=\"string\"" ?>
    <?php } ?>
<?= "\n\t *          )," ?>
<?php } ?>
<?= "\n\t *     )," ?>
     <?php
                }
            }
        } ?><?= "
     * )
     */
    public function update(\$id, Update" . ucfirst(Str::camel(Str::singular($tablename))) . "APIRequest \$request)
    {
        \$input = \$request->all();

        /** @var " . ucfirst(Str::camel($tablename)) . " \$" . Str::camel($tablename) . " */
        \$" . Str::camel($tablename) . " = \$this->" . Str::camel(Str::singular($tablename)) . "Repository->findWithoutFail(\$id);

        if (empty(\$" . Str::camel($tablename) . ")) {
            return \$this->sendError('" . ucFirst(str_replace('_', ' ', $tablename)) . " not found');
        }

        \$" . Str::camel($tablename) . " = \$this->" . Str::camel(Str::singular($tablename)) . "Repository->update(\$input, \$id);

        return \$this->sendResponse(\$" . Str::camel($tablename) . "->toArray(), '" . Str::singular(ucFirst(str_replace('_', ' ', $tablename))) . " updated successfully');
    }

    /**
     * @param int \$id
     * @return Response
     * @OA\Delete(
     *     path=\"/api/" . lcfirst(Str::singular(str_replace('_', '', $tablename))) . "/{id}\",
     *     tags={\"" . ucfirst(Str::singular(str_replace('_', '', $tablename))) . "\"},
     *     summary=\"Delete a " . ucfirst(Str::singular(str_replace('_', '', $tablename))) . " by ID\",
     *     description=\"Delete " . ucfirst(str_replace('_', '', $tablename)) . "\",
     *     @OA\Response(response=200, description=\"" . ucfirst(Str::singular(str_replace('_', '', $tablename))) . " Module\"),
     *     @OA\Response(response=400, description=\"Bad request\"),
     *     @OA\Response(response=404, description=\"Resource Not Found\"),
     *     security={{\"passport\": {\"*\"}}},
     *     @OA\Parameter(
     *          name=\"id\",
     *          in=\"path\",
     *          required=true,
     *     ),
     * )
     */
    public function destroy(\$id)
    {
        /** @var " . ucfirst(Str::camel($tablename)) . " \$" . Str::camel($tablename) . "  */
        \$" . Str::camel($tablename) . " = \$this->" . Str::camel(Str::singular($tablename)) . "Repository->findWithoutFail(\$id);

        if (empty(\$" . Str::camel($tablename) . ")) {
            return \$this->sendError('" . Str::singular(ucFirst(str_replace('_', ' ', $tablename))) . " not found');
        }

        \$" . Str::camel($tablename) . "->delete();

        return \$this->sendResponse(\$id, '" . Str::singular(ucFirst(str_replace('_', ' ', $tablename))) . " deleted successfully');
    }

    /**
     * @param int \$id
     * @return Response
     * @OA\Get(
     *     path=\"/api/" . lcfirst(Str::singular(str_replace('_', '', $tablename))) . "/filter\",
     *     tags={\"" . ucfirst(Str::singular(str_replace('_', '', $tablename))) . "\"},
     *     summary=\"General filter to get " . ucfirst(str_replace('_', '', $tablename)) . ". Just name the column name\",
     *     description=\"Filter " . ucfirst(Str::singular(str_replace('_', '', $tablename))) . " Data\",
     *     @OA\Response(response=200, description=\"" . Ucfirst(str_replace('_', '', $tablename)) . " Module\"),
     *     @OA\Response(response=400, description=\"Bad request\"),
     *     @OA\Response(response=404, description=\"Resource Not Found\"),
     *     security={{\"passport\": {\"*\"}}}," ?>
    <?php
    foreach ($db->columns as $i => $column) {
        if ($column->TABLE_NAME == $tablename) {
            if ($column->ORDINAL_POSITION == 1) { ?>
        <?= "\n\t *     @OA\Parameter(
     *          name=\"" . $column->COLUMN_NAME . "\",
     *          in=\"query\"," ?>
<?= "\n\t *          required=false,
     *          @OA\Schema(" ?>
    <?php if ($column->DATA_TYPE == "integer" || $column->DATA_TYPE == "int") { ?>
    <?= "\n\t *              type=\"integer\"" ?>
    <?php } else if ($column->DATA_TYPE == "datetime" || $column->DATA_TYPE == "timestamp") { ?>
    <?= "\n\t *              type=\"datetime\"" ?>
    <?php } else { ?>
    <?= "\n\t *              type=\"string\"" ?>
    <?php } ?>
<?= "\n\t *          )," ?>
<?= "\n\t *    )," ?>
       <?php
                } else { ?>
<?= "\n\t *     @OA\Parameter(
     *          name=\"" . $column->COLUMN_NAME . "\",
     *          in=\"query\"," ?>
<?= "\n\t *          required=false,
     *          @OA\Schema(" ?>
    <?php if ($column->DATA_TYPE == "integer" || $column->DATA_TYPE == "int") { ?>
    <?= "\n\t *              type=\"integer\"" ?>
    <?php } else if ($column->DATA_TYPE == "datetime" || $column->DATA_TYPE == "timestamp") { ?>
    <?= "\n\t *              type=\"datetime\"" ?>
    <?php } else { ?>
    <?= "\n\t *              type=\"string\"" ?>
    <?php } ?>
<?= "\n\t *          )," ?>
<?= "\n\t *    )," ?>
        <?php
                }
            }
        }
        ?>
    <?= "\n\t * )
     */
    public function filterData(Request \$request)
    {
        \$this->" . Str::camel(lcfirst(Str::singular($tablename))) . "Repository->pushCriteria(new RequestCriteria(\$request));
        \$this->" . Str::camel(lcfirst(Str::singular($tablename))) . "Repository->pushCriteria(new LimitOffsetCriteria(\$request));
        \$input = \$request->all();
        
        if(!empty(\$input))
        {
            \$" . Str::camel(lcfirst($tablename)) . " = \$this->" . Str::camel(lcfirst(Str::singular($tablename))) . "Repository->findWhere(\$input);
            return \$this->sendResponse(\$" . Str::camel(lcfirst($tablename)) . "->toArray(), '" . ucfirst(Str::singular(str_replace('_', '', $tablename))) . " retrieved successfully');
        } else {
            \$" . Str::camel(lcfirst($tablename)) . " = \$this->" . Str::camel(lcfirst(Str::singular($tablename))) . "Repository->all();
            return \$this->sendResponse(\$" . Str::camel(lcfirst($tablename)) . "->toArray(), '" . ucfirst(str_replace('_', '', $tablename)) . " retrieved successfully');
        }
    }
}
"
    ?>

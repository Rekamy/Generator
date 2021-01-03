<?=
"<?php

/**
 * @OA\Get(
 *     path=\"/api/" . lcfirst(Str::singular(str_replace('_', '', $tablename))) . "\",
 *     tags={\"" . ucfirst(Str::singular(str_replace('_', '', $tablename))) . "\"},
 *     summary=\"Get list of " . ucfirst(str_replace('_', '', $tablename)) . "\",
 *     description=\"Get " . ucfirst(str_replace('_', '', $tablename)) . "\",
 *     @OA\Response(response=200, description=\"" . ucfirst(Str::singular(str_replace('_', '', $tablename))) . " Module\"),
 *     @OA\Response(response=400, description=\"Bad request\"),
 *     @OA\Response(response=404, description=\"Resource Not Found\"),
 * )
 */

/**
 * @OA\Post(
 *     path=\"/api/" . lcfirst(Str::singular(str_replace('_', '', $tablename))) . "\",
 *     tags={\"" . ucfirst(Str::singular(str_replace('_', '', $tablename))) . "\"},
 *     summary=\"Store a " . ucfirst(Str::singular(str_replace('_', '', $tablename))) . " into database\",
 *     description=\"Store " . ucfirst(str_replace('_', '', $tablename)) . "\",
 *     @OA\Response(response=200, description=\"" . ucfirst(Str::singular(str_replace('_', '', $tablename))) . " Module\"),
 *     @OA\Response(response=400, description=\"Bad request\"),
 *     @OA\Response(response=404, description=\"Resource Not Found\")," ?> 
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
<?= " *          required=true,
 *          @OA\Schema(" ?>
<?php if ($column->DATA_TYPE == "integer" || $column->DATA_TYPE == "int") { ?>
<?= "\n *              type=\"integer\"" ?>
<?php } else if ($column->DATA_TYPE == "datetime" || $column->DATA_TYPE == "timestamp") { ?>
<?= "\n *              type=\"datetime\"" ?>
<?php } else { ?>
<?= "\n *              type=\"string\"" ?>
<?php } ?>
<?= "\n *          )," ?>
<?php } else { ?>
<?= "\t *          required=false,
 *          @OA\Schema(" ?>
<?php if ($column->DATA_TYPE == "integer" || $column->DATA_TYPE == "int") { ?>
<?= "\n *              type=\"integer\"" ?>
<?php } else if ($column->DATA_TYPE == "datetime" || $column->DATA_TYPE == "timestamp") { ?>
<?= "\n *              type=\"datetime\"" ?>
<?php } else { ?>
<?= "\n *              type=\"string\"" ?>
<?php } ?>
<?= "\n *          )," ?>

<?php } ?>
<?= "\n *     )," ?>
<?php } else { ?>
<?= "\n *     @OA\Parameter(
 *          name=\"" . $column->COLUMN_NAME . "\",
 *          in=\"query\",\n" ?>
<?php if ($column->IS_NULLABLE == "NO") { ?>
<?= " *          required=true,
 *          @OA\Schema(" ?>
<?php if ($column->DATA_TYPE == "integer" || $column->DATA_TYPE == "int") { ?>
<?= "\n *              type=\"integer\"" ?>
<?php } else if ($column->DATA_TYPE == "datetime" || $column->DATA_TYPE == "timestamp") { ?>
<?= "\n *              type=\"datetime\"" ?>
<?php } else { ?>
<?= "\n *              type=\"string\"" ?>
<?php } ?>
<?= "\n *          )," ?>
<?php } else { ?>
<?= " *          required=false,
 *          @OA\Schema(" ?>
<?php if ($column->DATA_TYPE == "integer" || $column->DATA_TYPE == "int") { ?>
<?= "\n *              type=\"integer\"" ?>
<?php } else if ($column->DATA_TYPE == "datetime" || $column->DATA_TYPE == "timestamp") { ?>
<?= "\n *              type=\"datetime\"" ?>
<?php } else { ?>
<?= "\n *              type=\"string\"" ?>
<?php } ?>
<?= "\n *          )," ?>
<?php } ?>
<?= "\n *     )," ?>
    <?php
            }
        }
    } ?><?= "
 * )
 */

/**
 * @OA\Get(
 *     path=\"/api/" . lcfirst(Str::singular(str_replace('_', '', $tablename))) . "/{id}\",
 *     tags={\"" . ucfirst(Str::singular(str_replace('_', '', $tablename))) . "\"},
 *     summary=\"Get a " . ucfirst(Str::singular(str_replace('_', '', $tablename))) . " by ID\",
 *     description=\"Get " . ucfirst(str_replace('_', '', $tablename)) . " by id\",
 *     @OA\Response(response=200, description=\"" . ucfirst(Str::singular(str_replace('_', '', $tablename))) . " Module\"),
 *     @OA\Response(response=400, description=\"Bad request\"),
 *     @OA\Response(response=404, description=\"Resource Not Found\"),
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

/**
 * @OA\Patch(
 *     path=\"/api/" . lcfirst(Str::singular(str_replace('_', '', $tablename))) . "/{id}\",
 *     tags={\"" . ucfirst(Str::singular(str_replace('_', '', $tablename))) . "\"},
 *     summary=\"Update a " . ucfirst(Str::singular(str_replace('_', '', $tablename))) . " by ID\",
 *     description=\"Update " . ucfirst(str_replace('_', '', $tablename)) . "\",
 *     @OA\Response(response=200, description=\"" . ucfirst(Str::singular(str_replace('_', '', $tablename))) . " Module\"),
 *     @OA\Response(response=400, description=\"Bad request\"),
 *     @OA\Response(response=404, description=\"Resource Not Found\")," ?> 
<?php foreach ($db->columns as $i => $column) {
    if (strpos($column->COLUMN_NAME, "_at") || strpos($column->COLUMN_NAME, "_by") || $column->COLUMN_NAME == "status_id") {
        continue;
    }
    if ($column->TABLE_NAME == $tablename) {
        if ($column->ORDINAL_POSITION == 2) { ?>
<?= " 
 *     @OA\Parameter(
 *          name=\"" . $column->COLUMN_NAME . "\",
 *          in=\"query\",\n" ?>
<?php if ($column->IS_NULLABLE == "NO") { ?>
<?= " 
 *          required=true,
 *          @OA\Schema(" ?>
<?php if ($column->DATA_TYPE == "integer" || $column->DATA_TYPE == "int") { ?>
<?= "\n *              type=\"integer\"" ?>
<?php } else if ($column->DATA_TYPE == "datetime" || $column->DATA_TYPE == "timestamp") { ?>
<?= "\n *              type=\"datetime\"" ?>
<?php } else { ?>
<?= "\n *              type=\"string\"" ?>
<?php } ?>
<?= "\n *          )," ?>
<?php } else { ?>
<?= " *          required=false,
 *          @OA\Schema(" ?>
<?php if ($column->DATA_TYPE == "integer" || $column->DATA_TYPE == "int") { ?>
<?= "\n *              type=\"integer\"" ?>
<?php } else if ($column->DATA_TYPE == "datetime" || $column->DATA_TYPE == "timestamp") { ?>
<?= "\n *              type=\"datetime\"" ?>
<?php } else { ?>
<?= "\n *              type=\"string\"" ?>
<?php } ?>
<?= "\n *          )," ?>
<?php } ?>
<?= "\n *     )," ?>
<?php } else { ?>
<?= "\n *     @OA\Parameter(
 *          name=\"" . $column->COLUMN_NAME . "\"," ?>
<?php if ($column->COLUMN_NAME == "id") { ?>
    <?= " *          in=\"path\",\n" ?>
    <?php } else { ?>
    <?= " *          in=\"query\",\n" ?>
    <?php } ?>
<?php if ($column->IS_NULLABLE == "NO") { ?>
<?= " *          required=true,
 *          @OA\Schema(" ?>
<?php if ($column->DATA_TYPE == "integer" || $column->DATA_TYPE == "int") { ?>
<?= "\n *              type=\"integer\"" ?>
<?php } else if ($column->DATA_TYPE == "datetime" || $column->DATA_TYPE == "timestamp") { ?>
<?= "\n *              type=\"datetime\"" ?>
<?php } else { ?>
<?= "\n *              type=\"string\"" ?>
<?php } ?>
<?= "\n *          )," ?>
<?php } else { ?>
<?= " *          required=false,
 *          @OA\Schema(" ?>
<?php if ($column->DATA_TYPE == "integer" || $column->DATA_TYPE == "int") { ?>
<?= "\n *              type=\"integer\"" ?>
<?php } else if ($column->DATA_TYPE == "datetime" || $column->DATA_TYPE == "timestamp") { ?>
<?= "\n *              type=\"datetime\"" ?>
<?php } else { ?>
<?= "\n *              type=\"string\"" ?>
<?php } ?>
<?= "\n *          )," ?>
<?php } ?>
<?= "\n *     )," ?>
    <?php
            }
        }
    } ?><?= "
 * )
 */

/**
 * @OA\Delete(
 *     path=\"/api/" . lcfirst(Str::singular(str_replace('_', '', $tablename))) . "/{id}\",
 *     tags={\"" . ucfirst(Str::singular(str_replace('_', '', $tablename))) . "\"},
 *     summary=\"Delete a " . ucfirst(Str::singular(str_replace('_', '', $tablename))) . " by ID\",
 *     description=\"Delete " . ucfirst(str_replace('_', '', $tablename)) . "\",
 *     @OA\Response(response=200, description=\"" . ucfirst(Str::singular(str_replace('_', '', $tablename))) . " Module\"),
 *     @OA\Response(response=400, description=\"Bad request\"),
 *     @OA\Response(response=404, description=\"Resource Not Found\"),
 *     @OA\Parameter(
 *          name=\"id\",
 *          in=\"path\",
 *          required=true,
 *     ),
 * )
 */

/**
 * @OA\Get(
 *     path=\"/api/" . lcfirst(Str::singular(str_replace('_', '', $tablename))) . "/filter\",
 *     tags={\"" . ucfirst(Str::singular(str_replace('_', '', $tablename))) . "\"},
 *     summary=\"General filter to get " . ucfirst(str_replace('_', '', $tablename)) . ". Just name the column name\",
 *     description=\"Filter " . ucfirst(Str::singular(str_replace('_', '', $tablename))) . " Data\",
 *     @OA\Response(response=200, description=\"" . Ucfirst(str_replace('_', '', $tablename)) . " Module\"),
 *     @OA\Response(response=400, description=\"Bad request\"),
 *     @OA\Response(response=404, description=\"Resource Not Found\")," ?>
<?php
foreach ($db->columns as $i => $column) {
    if ($column->TABLE_NAME == $tablename) {
        if ($column->ORDINAL_POSITION == 1) { ?>
    <?= "\n *     @OA\Parameter(
 *          name=\"" . $column->COLUMN_NAME . "\",
 *          in=\"query\"," ?>
<?= "\n *          required=false,
 *          @OA\Schema(" ?>
<?php if ($column->DATA_TYPE == "integer" || $column->DATA_TYPE == "int") { ?>
<?= "\n *              type=\"integer\"" ?>
<?php } else if ($column->DATA_TYPE == "datetime" || $column->DATA_TYPE == "timestamp") { ?>
<?= "\n *              type=\"datetime\"" ?>
<?php } else { ?>
<?= "\n *              type=\"string\"" ?>
<?php } ?>
<?= "\n *          )," ?>
<?= "\n *    )," ?>
    <?php
            } else { ?>
<?= "\n *     @OA\Parameter(
 *          name=\"" . $column->COLUMN_NAME . "\",
 *          in=\"query\"," ?>
<?= "\n *          required=false,
 *          @OA\Schema(" ?>
<?php if ($column->DATA_TYPE == "integer" || $column->DATA_TYPE == "int") { ?>
<?= "\n *              type=\"integer\"" ?>
<?php } else if ($column->DATA_TYPE == "datetime" || $column->DATA_TYPE == "timestamp") { ?>
<?= "\n *              type=\"datetime\"" ?>
<?php } else { ?>
<?= "\n *              type=\"string\"" ?>
<?php } ?>
<?= "\n *          )," ?>
<?= "\n *    )," ?>
    <?php
            }
        }
    }
    ?>
<?= "
 * )
 */
"
?>

<?php use Rekamy\Generator\Console\RuleParser; ?>
<?=
"<?php

/**
 * @OA\Get(
 *     path=\"$route\",
 *     tags={\"$tags\"},
 *     summary=\"Get $title\",
 *     description=\"Get list of $title\",
 *     @OA\Response(response=200, description=\"$title Module\"),
 *     @OA\Response(response=400, description=\"Bad request\"),
 *     @OA\Response(response=404, description=\"Resource Not Found\"),
 * )
 */

/**
 * @OA\Post(
 *     path=\"$route\",
 *     tags={\"$tags\"},
 *     summary=\"Store $title\",
 *     description=\"Store a $title into database\",
 *     @OA\Response(response=200, description=\"$title Module\"),
 *     @OA\Response(response=400, description=\"Bad request\"),
 *     @OA\Response(response=404, description=\"Resource Not Found\")," ?>
<?php 
foreach ($columns as $i => $column) : 
    $required = ($column->getNotnull()) ? 'true' : 'false';
?><?= 
"*     @OA\Parameter(
 *          name=\"{$column->getName()}\",
 *          in=\"query\",
 *          required=$required, 
 *          @OA\Schema(
 *              type=\"" . RuleParser::parseType($column->getType()->getName()) . "\"
 *          ),
 *     ),\n " ?>
<?php endforeach; ?>
<?= "* )
 */

/**
 * @OA\Get(
 *     path=\"$route/{id}\",
 *     tags={\"$tags\"},
 *     summary=\"Get a $title by ID\",
 *     description=\"Get $title by id\",
 *     @OA\Response(response=200, description=\"$title Module\"),
 *     @OA\Response(response=400, description=\"Bad request\"),
 *     @OA\Response(response=404, description=\"Resource Not Found\"),
 *     @OA\Parameter(
 *          name=\"id\",
 *          in=\"path\",
 *          required=true,
 *          @OA\Schema(
 *              type=\"string\"
 *          )
 *     ),
 * )
 */

/**
 * @OA\Patch(
 *     path=\"$route/{id}\",
 *     tags={\"$tags\"},
 *     summary=\"Update a $title by ID\",
 *     description=\"Update $title\",
 *     @OA\Response(response=200, description=\"$title Module\"),
 *     @OA\Response(response=400, description=\"Bad request\"),
 *     @OA\Response(response=404, description=\"Resource Not Found\")," ?>
<?php 
foreach ($columns as $i => $column) : 
    $required = ($column->getNotnull()) ? 'true' : 'false';
?><?= 
"*     @OA\Parameter(
 *          name=\"{$column->getName()}\",
 *          in=\"query\",
 *          required=$required, 
 *          @OA\Schema(
 *              type=\"" . RuleParser::parseType($column->getType()->getName()) . "\"
 *          ),
 *     ),\n " ?>
<?php endforeach; ?>
<?= "* )
 */


/**
 * @OA\Delete(
 *     path=\"$route/{id}\",
 *     tags={\"$tags\"},
 *     summary=\"Delete a $title by ID\",
 *     description=\"Delete $title\",
 *     @OA\Response(response=200, description=\"$title Module\"),
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
 *     path=\"$route/filter\",
 *     tags={\"$tags\"},
 *     summary=\"General filter to get $title. Just name the column name\",
 *     description=\"Filter $title Data\",
 *     @OA\Response(response=200, description=\"$title Module\"),
 *     @OA\Response(response=400, description=\"Bad request\"),
 *     @OA\Response(response=404, description=\"Resource Not Found\")," ?>
<?php 
foreach ($columns as $i => $column) : 
    $required = ($column->getNotnull()) ? 'true' : 'false';
?><?= 
"*     @OA\Parameter(
 *          name=\"{$column->getName()}\",
 *          in=\"query\",
 *          required=$required, 
 *          @OA\Schema(
 *              type=\"" . RuleParser::parseType($column->getType()->getName()) . "\"
 *          ),
 *     ),\n " ?>
<?php endforeach; ?>
<?= "* )
 */
"
?>
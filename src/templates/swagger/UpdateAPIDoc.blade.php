<?php use Rekamy\Generator\Core\RuleParser; ?>
<?=
"<?php

namespace App\APIDoc;

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
class ${className} {
} 
"
?>

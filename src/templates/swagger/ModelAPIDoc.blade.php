<?php use Rekamy\Generator\Core\RuleParser; ?>
<?=
"<?php

namespace App\APIDoc;

/**
 * @OA\Schema(
 *     schema=\"$title\",
 *     description=\"Model $title schema\",\n " ?>
<?php
$requiredColumns = collect();
foreach ($columns as $i => $column) {
    if($column->getNotnull()) {
        $requiredColumns->push("\"{$column->getName()}\"");
    }
}
if($requiredColumns->isNotEmpty()) {
    $requiredColumnsList = $requiredColumns->join(', ');
    echo " *    required={ {$requiredColumnsList} },\n ";
}
?>
<?php foreach ($columns as $i => $column) : ?>
<?=
"*     @OA\Property(
 *          property=\"{$column->getName()}\",
 *          description=\"{$column->getName()}\",
 *          type=\"" . RuleParser::parseSwaggerType($column->getType()->getName()) . "\",
 *          example=\"" . RuleParser::parseSwaggerExample($column->getType()->getName()) . "\",
 *     ),\n " ?>
<?php endforeach; ?>
<?= "* )
 */
class ${className} {
}
"
?>

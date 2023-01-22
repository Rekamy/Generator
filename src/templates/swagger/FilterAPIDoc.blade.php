<?php use Rekamy\Generator\Core\RuleParser; ?>
<?=
"<?php

namespace App\APIDoc;

use OpenApi\Attributes as OA;
use Symfony\Component\HttpFoundation\Response;

/**
 * @OA\Get(
 *     path=\"$route/filter\",
 *     tags={\"$tags\", \"CRUD\"},
 *     summary=\"General filter to get $title. Just name the column name\",
 *     description=\"Filter $title Data\",
 *     @OA\Response(response=200, description=\"$title Module\", @OA\MediaType(mediaType=\"application/json\")),
 *     @OA\Response(response=400, description=\"Bad request\", @OA\MediaType(mediaType=\"application/json\")),
 *     @OA\Response(response=401, description=\"Unauthorized\", @OA\MediaType(mediaType=\"application/json\")),
 *     @OA\Response(response=403, description=\"Forbidden\", @OA\MediaType(mediaType=\"application/json\")),
 *     @OA\Response(response=422, description=\"Unprocessable Content\", @OA\MediaType(mediaType=\"application/json\")),
 *     @OA\Response(response=404, description=\"Resource Not Found\", @OA\MediaType(mediaType=\"application/json\")),
 *     @OA\Response(response=500, description=\"Internal Server Error\", @OA\MediaType(mediaType=\"application/json\"))," ?>
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

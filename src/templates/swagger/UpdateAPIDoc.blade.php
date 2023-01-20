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
 *     @OA\Parameter(
 *          name=\"id\",
 *          in=\"path\",
 *          required=true,
 *          @OA\Schema(type=\"string\")
 *     ),
 *     @OA\RequestBody(
 *          required=true,
 *          @OA\JsonContent(ref=\"#/components/schemas/{$title}\"),
 *     ),
 *     @OA\Response(response=200, description=\"{$title} Module\"),
 *     @OA\Response(response=400, description=\"Bad request\"),
 *     @OA\Response(response=404, description=\"Resource Not Found\"),
 * )
 */
class {$className} {
}
"
?>

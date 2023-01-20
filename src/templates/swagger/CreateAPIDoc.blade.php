<?php use Rekamy\Generator\Core\RuleParser; ?>
<?=
"<?php

namespace App\APIDoc;

/**
 * @OA\Post(
 *     path=\"{$route}\",
 *     tags={\"{$tags}\"},
 *     summary=\"Store {$title}\",
 *     description=\"Store a {$title} into database\",
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

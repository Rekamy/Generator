<?php use Rekamy\Generator\Core\RuleParser; ?>
<?=
"<?php

namespace App\APIDoc;

/**
 * @OA\Get(
 *     path=\"$route\",
 *     tags={\"$tags\"},
 *     summary=\"Get $title\",
 *     description=\"Get list of $title\",
 *     @OA\Response(response=200, description=\"$title Module\", @OA\MediaType(mediaType=\"application/json\")),
 *     @OA\Response(response=400, description=\"Bad request\", @OA\MediaType(mediaType=\"application/json\")),
 *     @OA\Response(response=404, description=\"Resource Not Found\", @OA\MediaType(mediaType=\"application/json\")),
 * )
 */
class ${className} {
} 
"
?>

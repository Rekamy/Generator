<?php use Rekamy\Generator\Core\RuleParser; ?>
<?=
"<?php

namespace App\APIDoc;

/**
 * @OA\Get(
 *     path=\"$route/{id}\",
 *     tags={\"$tags\"},
 *     summary=\"Get a $title by ID\",
 *     description=\"Get $title by id\",
 *     @OA\Response(response=200, description=\"$title Module\", @OA\MediaType(mediaType=\"application/json\")),
 *     @OA\Response(response=400, description=\"Bad request\", @OA\MediaType(mediaType=\"application/json\")),
 *     @OA\Response(response=404, description=\"Resource Not Found\", @OA\MediaType(mediaType=\"application/json\")),
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
class ${className} {
} 
"
?>

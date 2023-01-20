<?php use Rekamy\Generator\Core\RuleParser; ?>
<?=
"<?php

namespace App\APIDoc;

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
class ${className} {
} 
"
?>

<?="<?php

namespace App\Contracts\Repositories;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface CaseRecordRepository.
 *
 * @package namespace App\Repositories;
 */
interface CrudRepositoryInterface extends RepositoryInterface
{
    public function indexAction(\$input);

    public function storeAction(\$input);

    public function showAction(\$id);

    public function updateAction(\$id , \$input);

    public function destroyAction(\$id);
}
"
?>
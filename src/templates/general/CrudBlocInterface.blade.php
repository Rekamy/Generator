<?="<?php

namespace App\Contracts\Bloc;
use Prettus\Repository\Contracts\RepositoryInterface;
use App\Contracts\Requests\RequestInterface;


/**
 * FIXME:
 * This interface should specify as Builder Class abstraction
 *  - make() : build factory
 *  - get() : get factory instance
 *  - addStack() : add factory stack
 *
 */
interface CrudBlocInterface
{

    public function registerRequest(RequestInterface \$request);

    public function registerRepository(RepositoryInterface \$repository);

    public function index(array \$input);

    public function store(array \$input);

    public function show(integer \$id);

    public function update(integer \$id, array \$input);

    public function destroy(integer \$id);

}
"
?>
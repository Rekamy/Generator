<?="<?php

namespace App\Bloc;

use App\Contracts\Bloc\Concerns\CrudableBloc;
use App\Contracts\Bloc\Concerns\HasRepository;
use App\Contracts\Bloc\Concerns\HasRequest;
use App\Contracts\Bloc\CrudBlocInterface;

abstract class CrudBloc implements CrudBlocInterface
{
    use HasRepository, HasRequest, CrudableBloc;
}
"
?>
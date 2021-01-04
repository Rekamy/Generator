<?="<?php

namespace App\Contracts\Requests;

use App\Contracts\Bloc\CrudBlocInterface;

interface CrudRequestInterface
{
    // public function getBloc(CrudBlocInterface \$bloc);

    /**
     * Determine if the user is authorized to make index request.
     *
     * @return bool
     */
    public function validateIndex();

    /**
     * Determine if the user is authorized to make store request.
     *
     * @return bool
     */
    public function validateStore();

    /**
     * Determine if the user is authorized to make show request.
     *
     * @return bool
     */
    public function validateShow();

    /**
     * Determine if the user is authorized to make update request.
     *
     * @return bool
     */
    public function validateUpdate();

    /**
     * Determine if the user is authorized to make destroy request.
     *
     * @return bool
     */
    public function validateDestroy();


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules();
}
"
?>
<?=
"<?php

namespace App\Http\Requests;

use App\Bloc\\$blocName;
use Illuminate\Foundation\Http\FormRequest;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Contracts\Requests\CrudRequestInterface;
use Validator;

class $className extends FormRequest implements CrudRequestInterface
{
    
    public function validateIndex()
    {
        \$haveAccess = auth()->user()->can($blocName::permission('index'));
        if (!\$haveAccess) throw new \Exception(\"Unauthorized Processing Request\", 403);
    }

    public function validateStore()
    {

        \$haveAccess = auth()->user()->can($blocName::permission('create'));
        if (!\$haveAccess) throw new \Exception(\"Unauthorized Processing Request\", 403);

        // \$validator = Validator::make(request()->all(), \$this->rules());
        // if (\$validator->fails()) return response()->json(['errors' => \$validator->errors()]);
    }

    public function validateShow()
    {
        \$haveAccess = auth()->user()->can($blocName::permission('show'));
        if (!\$haveAccess) throw new \Exception(\"Unauthorized Processing Request\", 403);
    }


    public function validateUpdate()
    {
        \$haveAccess = auth()->user()->can($blocName::permission('update'));
        if (!\$haveAccess) throw new \Exception(\"Unauthorized Processing Request\", 403);
    }


    public function validateDestroy()
    {
        \$haveAccess = auth()->user()->can($blocName::permission('destroy'));
        if (!\$haveAccess) throw new \Exception(\"Unauthorized Processing Request\", 403);
    }


    public function rules()
    {
        return [
            //
        ];
    }
}
"?>
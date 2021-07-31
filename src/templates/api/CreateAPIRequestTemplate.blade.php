<?=
"<?php

namespace " . $context->path['backend']['api_request']['namespace'] . ";

use App\Models\\" . ucfirst(Str::camel(Str::singular($tablename))) . ";
use InfyOm\Generator\Request\APIRequest;

class Create" . ucfirst(Str::camel(Str::singular($tablename))) . "APIRequest extends APIRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return " . ucfirst(Str::camel(Str::singular($tablename))) . "::\$rules;
    }
}
"
?>

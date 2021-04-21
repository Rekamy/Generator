<?="<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserProfileResource extends JsonResource
{
    public static \$wrap = null;
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  \$request
     * @return array
     */
    public function toArray(\$request)
    {
        \$this->resource->append('name')->makeVisible('name');

        \$token = \$this->resource->createToken(config('app.token_name'), ['*']);
        if (!\$token) throw new Exception('Error Processing Request', 422);

        \$roles = \$this->resource->getRoleNames()->first(); // Returns a collection


        return [
            'user' => \$this->resource,
            'roles' => \$roles,
            'token' => \$token->accessToken,
            'scopes' => ['*'],
        ];
    }
}
"
?>
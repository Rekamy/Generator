<?= <<<'SCRIPT'
<?php

namespace App\Http\Controllers\Auth;

use App\Exceptions\ValidationException;
use Illuminate\Http\Request;
use App\Models\User;
// use App\Models\Profile;
use App\Http\Controllers\Base\Controller;
use App\Http\Resources\UserProfileResource;
use DB;
use Exception;
use Illuminate\Validation\UnauthorizedException;
use Spatie\Permission\Models\Role;
use Auth;

class AuthController extends Controller
{
    /**
     * Registration
     */
    public function register(Request $request)
    {
        DB::beginTransaction();
        try {
            $this->validateRegistration($request);

            $user = User::create($request->all());
            if (!$user) throw new Exception('Error Processing Request', 422);

            // dummy map profile
            // Profile::first()->user()->associate($user)->save();
            // $user->givePermissionTo('view_profiles');

            Auth::guard('web')->login($user);

            // $permissions = Permission::where('name', 'like', '%_index')->pluck('name')->toArray();
            $permissions = $this->getPermissions($user);
            $token = $user->createToken(config('app.token_name'));
            // $token = $user->createToken(config('app.token_name'), ['*']);
            if (!$token) throw new Exception('Error Processing Request', 422);

            DB::commit();
            return [
                'user' => $user,
                'token' => $token->accessToken,
                'scopes' => $user->permissions->pluck('name')
            ];
        } catch (\Throwable $th) {
            DB::rollback();
            throw $th;
        }
    }

    /**
     * Login
     */
    public function login(Request $request)
    {
        try {
            $this->validateLogin($request);

            if (!Auth::guard('web')->once($request->all()))
                throw new UnauthorizedException('Invalid Login or password.', 401);

            $user = Auth::guard('web')->user();

            return new UserProfileResource($user);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Impersonate
     */
    public function impersonate(Request $request, User $user)
    {
        try {
            $this->validateImpersonate($request);
            Auth::guard('web')->login($user);

            $user = Auth::guard('web')->user();

            return new UserProfileResource($user);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    private function getPermissions($user)
    {

        // $permissions = Permission::whereIn('name', [
        //     'department_cases_index',
        //     'users_index',
        //     // 'users_create',
        //     'users_show',
        //     // 'users_update',
        //     // 'users_destroy',
        // ])->pluck('name')->toArray();
        $permissions = [
            // '*',
            'view_profiles',
        ];
        return $permissions;
    }

    /**
     * Logout
     */
    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
    }

    /**
     * Revoke all other token
     */
    public function revokeTokens(Request $request)
    {
        $request->user()->revokeTokens();
    }

    private function validateRegistration(Request $request)
    {
        $rules = [
            (new User)->username() => 'required|min:4|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
            // TODO: not implemented yet
            // 'confirm_password' => 'required|min:8',
        ];

        $validation = validator($request->all(), $rules);
        if ($validation->fails()) throw new ValidationException($validation);
    }

    private function validateLogin(Request $request)
    {
        $rules = [
            (new User)->username() => 'required|min:4',
            'password' => 'required|min:8',
        ];

        $validation = validator($request->all(), $rules);
        if ($validation->fails()) throw new ValidationException($validation);
    }

    private function validateImpersonate(Request $request)
    {
        if (!$request->has('impersonate'))
            throw new Exception('Bad Request. Impersonate tag required.', 400);
    }
}
"
SCRIPT;
?>
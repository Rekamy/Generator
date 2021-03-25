<?="<?php
namespace App\Http\Controllers\Auth;

use App\Exceptions\ValidationException;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Controllers\Base\Controller;
use DB;
use Exception;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\UnauthorizedException;
use Laravel\Passport\Passport;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AuthController extends Controller
{

    /**
     * Registration
     */
    public function register(Request \$request)
    {
        DB::beginTransaction();
        try {
            \$this->validateRegistration(\$request);

            \$user = User::create([
                'username' => \$request->username,
                'email' => \$request->email,
                'password' => bcrypt(\$request->password)
            ]);

            if (!\$user) throw new Exception(\"Error Processing Request\", 422);

            // FIXME: password verification upon registration are redundant
            // if (!auth('web')->attempt(['username' => \$request->username, 'password' => \$request->password]))
            // if (Hash::check(\$user->password, \$request->password))
            //     throw new UnauthorizedException('Invalid Login or password.', 401);
            // \$permissions = Permission::where('name', 'like', '%_index')->pluck('name')->toArray();
            
            \$permissions = ['*'];
            \$token = \$user->createToken(config('app.token_name'), \$permissions);
            // \$token = \$user->createToken(config('app.token_name'), ['*']);
            if (!\$token) throw new Exception(\"Error Processing Request\", 422);

            DB::commit();
            return [
                'user' => \$user,
                'token' => \$token->accessToken,
                'scopes' => \$permissions
            ];
        } catch (\Throwable \$th) {
            DB::rollback();
            throw \$th;
        }
    }

    /**
     * Login
     */
    public function login(Request \$request)
    {
        try {
            \$this->validateLogin(\$request);

            if (!auth('web')->attempt(\$request->all()))
                throw new UnauthorizedException('Invalid Login or password.', 401);

            \$user = auth('web')->user();

            \$permissions = Permission::whereIn('name', [
                'department_cases_index',
                'users_index',
                // 'users_create',
                'users_show',
                // 'users_update',
                // 'users_destroy',
            ])->pluck('name')->toArray();
            \$permissions = ['*'];
            // \$token = \$user->createToken(config('app.token_name'), \$user->getPermissionNames()->toArray());
            \$token = \$user->createToken(config('app.token_name'), \$permissions);

            if (!\$token) throw new Exception(\"Error Processing Request\", 422);

            return [
                'user' => \$user,
                'token' => \$token->accessToken,
                'scopes' => \$permissions
            ];
        } catch (\Throwable \$th) {
            throw \$th;
        }
    }

    /**
     * Logout
     */
    public function logout(Request \$request)
    {
        auth()->user()->token()->revoke();
    }

    /**
     * Revoke all other token
     */
    public function revokeTokens(Request \$request)
    {
        auth()->user()->revokeTokens();
    }

    private function validateRegistration(Request \$request)
    {
        \$rules = [
            'username' => 'required|min:4|unique:users',
            'email' => 'required|email',
            'password' => 'required|min:8',
            // 'confirm_password' => 'required|min:8',
        ];

        \$validation = validator(\$request->all(), \$rules);
        if (\$validation->fails()) throw new ValidationException(\$validation);
    }

    private function validateLogin(Request \$request)
    {
        \$rules = [
            'username' => 'required|min:4',
            'password' => 'required|min:8',
        ];

        \$validation = validator(\$request->all(), \$rules);
        if (\$validation->fails()) throw new ValidationException(\$validation);
    }
}
"
?>
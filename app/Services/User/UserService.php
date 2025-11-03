<?php

namespace App\Services\User;

use App\Http\Resources\User\UserResource;
use App\Models\User;
use App\Services\Core\{BaseService, ErrorService};
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use Laravel\Passport\Bridge\UserRepository;

class UserService extends BaseService
{
    protected $deleteRelations = [];

    public function __construct(UserRepository $repository)
    {
        parent::__construct($repository);
    }

    /**
     * @return array|JsonResponse|void
     */
    public function login(mixed $validated)
    {
        try {

            $user = User::where('email', $validated['email'])->first();

            if (! $user || ! Hash::check($validated['password'], $user->password)) {
                return response()->json([
                    'message' => 'Credenciais inválidas',
                ], 401);
            }

            return [
                'status'      => true,
                'message'     => 'User Logged In Successfully',
                'token'       => $user->createToken('API TOKEN', ['guard-api'])->plainTextToken,
                'user'        => UserResource::make($user),
                'permissions' => $user->getAllPermissions(),
            ];

        } catch (Exception $e) {
            ErrorService::sendError($e);
        }
    }
}

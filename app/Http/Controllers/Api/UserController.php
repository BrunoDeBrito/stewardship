<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\{IndexRequest, LoginUserRequest, StoreUserRequest, UpdateUserRequest};
use App\Http\Resources\User\UserResource;
use App\Models\User;
use App\Services\User\UserService;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class UserController extends Controller
{
    public function __construct(protected UserService $service) {}

    /**
     * @return AnonymousResourceCollection
     */
    public function index(IndexRequest $request)
    {
        return UserResource::collection($this->service->getAll($request->validated()));
    }

    public function show($id): UserResource
    {
        return UserResource::make($this->service->findById($id));
    }

    public function store(StoreUserRequest $request): UserResource|string
    {
        $user = $this->service->create($request->validated());

        return UserResource::make($user);
    }

    public function update(UpdateUserRequest $request, User $user): UserResource
    {
        $this->service->update($user, $request->validated());

        return UserResource::make($user);
    }

    /**
     * @return mixed
     */
    public function destroy($id)
    {
        return $this->service->delete($id);
    }

    public function login(LoginUserRequest $request)
    {
        return $this->service->login($request->validated());
    }
}

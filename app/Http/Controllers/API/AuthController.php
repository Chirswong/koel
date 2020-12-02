<?php

namespace App\Http\Controllers\API;

use App\Service\TokenManager;
use Illuminate\Http\Response;
use Illuminate\Hashing\HashManager;
use App\Repositories\UserRepository;
use App\Http\Requests\API\UserLoginRequest;
use Illuminate\Contracts\Auth\Authenticatable;


class AuthController extends Controller
{
    private $hash;
    private $currentUser;
    private $tokenManager;
    private $userRepository;

    public function __construct(
        HashManager $hash,
        TokenManager $tokenManager,
        ?Authenticatable $currentUser,
        UserRepository $userRepository
    )
    {
        $this->hash = $hash;
        $this->currentUser = $currentUser;
        $this->tokenManager = $tokenManager;
        $this->userRepository = $userRepository;
    }

    public function login(UserLoginRequest $request)
    {
        $user = $this->userRepository->getFirstWhere('email', $request->email);

        if (!$user || !$this->hash->check($request->password, $user->password)) {
            abort(Response::HTTP_UNAUTHORIZED, 'invalid credentials');
        }

        return response()->json([
            'token' => $this->tokenManager->createToken($user)->plainTextToken,
        ]);
    }
}

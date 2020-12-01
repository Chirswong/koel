<?php

namespace App\Http\Controllers\API;


use App\Service\TokenManager;
use Illuminate\Http\Request;
use Illuminate\Hashing\HashManager;
use App\Repositories\UserRepository;
use Illuminate\Auth\Authenticatable;


class AuthController extends Controller
{
    private $userRepository;
    private $hash;
    private $tokenManager;

    private $currentUser;

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
}

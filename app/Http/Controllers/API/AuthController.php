<?php

namespace App\Http\Controllers\API;


use Illuminate\Http\Request;

class AuthController extends Controller
{
    private $userRepository;
    private $hash;
    private $tokenManager;

    private $currentUser;

    public function __construct()
    {

    }
}

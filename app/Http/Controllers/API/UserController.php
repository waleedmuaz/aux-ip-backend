<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use App\Repository\Eloquent\ForgetPasswordRepository;
use App\Repository\UserRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\View\View;


class UserController extends Controller
{

    private $userRepository;
    private $forgetRepository;

    public function __construct(UserRepositoryInterface $userRepository,ForgetPasswordRepository $forgetRepository)
    {
        $this->userRepository = $userRepository;
        $this->forgetRepository = $forgetRepository;
    }

    /**
     * Show the profile for a given user.
     * @return void
     */
    public function index()
    {
        $users = $this->userRepository->all();
        dd('Happy Hacking');
    }
 /**
     * Show the profile for a given user.
     * @param LoginRequest $request
     * @return JsonResponse
  */
    public function login(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');
        $token=$this->userRepository->login($credentials);
        if($token){
            return jsonFormat(200, $token, 'You have Successfully loggedin');
        }
        return jsonFormat(419, [], 'Oppes! You have entered invalid credentials');
    }

    /**
     * Store a new user.
     * @param CreateUserRequest $request
     * @return JsonResponse
     */

    public function store(CreateUserRequest $request)
    {
        $data=[
            'email'=>$request->email,
            'password'=>Hash::make('123123'),
            'name'=>$request->name,
        ];
        $this->forgetRepository->submitForgetPasswordForm($data);
        $this->userRepository->storeUser($data);
        return jsonFormat(200,'', 'user created successfully');
    }


}

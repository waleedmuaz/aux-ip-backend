<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\ForgetPasswordRequest;
use App\Http\Requests\ResetFormRequest;
use App\Repository\Eloquent\ForgetPasswordRepository;
use App\Repository\UserRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ForgotPasswordController extends Controller
{
    private $forgetPasswordRepository;

    public function __construct(ForgetPasswordRepository $forgetPasswordRepository)
    {
        $this->forgetPasswordRepository = $forgetPasswordRepository;
    }

    /**
     * Write code on Method
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function submitForgetPasswordForm(ForgetPasswordRequest $request)
    {
        $data=[
         'email'=>$request->email
        ];
        $response=$this->forgetPasswordRepository->submitForgetPasswordForm($data);
        return jsonFormat('200','',"Successfully Updated");
    }
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function showResetPasswordForm($token) {
        return view('auth.forgetPasswordLink', ['token' => $token]);
    }

    /**
     * Write code on Method
     *
     * @param ResetFormRequest $request
     * @return Response
     */
    public function submitResetPasswordForm(ResetFormRequest $request)
    {
        $data=[
          'email'=>$request->email,
          'token'=>$request->token,
          'password'=>$request->password
        ];
        $response=$this->forgetPasswordRepository->submitResetPasswordForm($data);

        return jsonFormat('200',[],'Your password has been changed!');
    }
}

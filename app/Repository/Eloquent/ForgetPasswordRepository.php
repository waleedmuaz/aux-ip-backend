<?php

namespace App\Repository\Eloquent;

use App\Http\Requests\ResetFormRequest;
use App\Models\User;
use App\Repository\ForgetPasswordRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class ForgetPasswordRepository extends BaseRepository implements ForgetPasswordRepositoryInterface
{

    /**
     * UserRepository constructor.
     *
     * @param User $model
     */
    public function __construct(User $model)
    {
        parent::__construct($model);
    }

    /**
     * @return Collection
     */
    public function all(): Collection
    {
        return $this->model->all();
    }

    /**
     * @param array $attribute
     * @return bool
     */

    public function submitForgetPasswordForm(array $attribute){
        $token = Str::random(64);
        DB::table('password_resets')->insert([
            'email' => $attribute['email'],
            'token' => $token,
            'created_at' => Carbon::now()
        ]);

        Mail::send('email.forgetPassword', ['token' => $token], function($message) use($attribute){
            $message->to($attribute['email']);
            $message->subject('Reset Password');
        });
        return true;
    }

    public function submitResetPasswordForm(array $attribute)
    {
        $updatePassword = DB::table('password_resets')
            ->where([
                'email' => $attribute['email'],
                'token' => $attribute['token']
            ])
            ->first();

        if(!$updatePassword){
            return back()->withInput()->with('error', 'Invalid token!');
        }

        $user = User::where('email', $attribute['email'])
            ->update([
                'password' => Hash::make($attribute['password']),
                'is_email_verify'=>1,
            ]);

        DB::table('password_resets')->where(['email'=> $attribute['email']])->delete();

        return true;
    }

}

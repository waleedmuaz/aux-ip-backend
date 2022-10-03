<?php

namespace App\Repository\Eloquent;

use App\Models\CompniesUser;
use App\Models\User;
use App\Repository\UserRepositoryInterface;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserRepository extends BaseRepository implements UserRepositoryInterface
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
        return User::with('companies.company')->get();
    }

    /**
     * @param array $attribute
     * @return bool
     */

    public function storeUser(array $attribute){
        $user = User::create([
            'name' => $attribute['name'],
            'email' => $attribute['email'],
            'password' => Hash::make($attribute['password']),
            'email_verification_code' => Str::random(5)
        ]);
        $user->assignRole(2);
        $data=[];
        foreach ($attribute['company_id'] as $company){
            $data['company_id']=$company;
            $data['user_id']=$user->id;
            CompniesUser::create($data);
        }
        return true;//$token = $user->createToken('auth_token')->plainTextToken;
    }

    /**
     * @param array $attributes
     * @return false
     */

    public function login(array $attributes)
    {
        $data=[];
        $auth=Auth::attempt($attributes);
        if ($auth && Auth::user()->is_email_verify==1 && $user =Auth::user() ) {
            $data['token']=$user->createToken('auth_token')->plainTextToken;
            $data["user"]=$user;
            $data["role"]=$user->getRoleNames();
            return $data;
        }
        return false;
    }

}

<?php
namespace App\Repository;

use App\Models\User;
use Illuminate\Support\Collection;

interface ForgetPasswordRepositoryInterface
{
    public function all(): Collection;

    public function submitForgetPasswordForm(array $attributes);

    public function submitResetPasswordForm(array $attributes);


}

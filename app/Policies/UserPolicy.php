<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function manage_user(User $user)
    {
        if ($user->role_id > 2)
            return true;
        else
            return false;

    }

    public function check_report(User $user)
    {
        if ($user->role_id > 3)
            return true;
        else
            return false;
    }

    public function import_info(User $user)
    {
        if ($user->role_id > 2)
            return true;
        else
            return false;
    }

}

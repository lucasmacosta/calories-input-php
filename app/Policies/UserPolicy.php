<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    public function before(User $user, $ability)
    {
        if ($user->isAdmin()) {
            return true;
        }
    }

    /**
     * Determine whether the user can view the user.
     *
     * @param  \App\User  $user
     * @param  \App\User  $target_user
     * @return mixed
     */
    public function view(User $user, User $target_user)
    {
        return $user->id == $target_user->id;
    }

    /**
     * Determine whether the user can create users.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->isUsersManager();
    }

    /**
     * Determine whether the user can update the user.
     *
     * @param  \App\User  $user
     * @param  \App\User  $target_user
     * @return mixed
     */
    public function update(User $user, User $target_user)
    {
        return ($user->isUsersManager() && $target_user->isUser()) || $user->id === $target_user->id;
    }

    /**
     * Determine whether the user can delete the user.
     *
     * @param  \App\User  $user
     * @param  \App\User  $target_user
     * @return mixed
     */
    public function delete(User $user, User $target_user)
    {
        return $user->isUsersManager() && $target_user->isUser();
    }
}

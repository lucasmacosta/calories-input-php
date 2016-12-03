<?php

namespace App\Policies;

use App\User;
use App\Meal;
use Illuminate\Auth\Access\HandlesAuthorization;

class MealPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can create meals.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user, User $target_user)
    {
        return $target_user->isUser() && ($user->isAdmin() || $user->id === $target_user->id);
    }

    /**
     * Determine whether the user can update the meal.
     *
     * @param  \App\User  $user
     * @param  \App\Meal  $meal
     * @return mixed
     */
    public function update(User $user, Meal $meal)
    {
        return $meal->user->isUser() && ($user->isAdmin() || $user->id === $meal->user->id);
    }
}

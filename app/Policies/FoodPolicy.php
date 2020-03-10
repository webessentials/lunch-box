<?php

namespace App\Policies;

use App\Food;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class FoodPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any foods.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->role === User::ROLE_ADMIN;
    }

    /**
     * Determine whether the user can view the food.
     *
     * @param  \App\User  $user
     * @param  \App\Food  $food
     * @return mixed
     */
    public function view(User $user, Food $food)
    {
        //
    }

    /**
     * Determine whether the user can create foods.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->role === User::ROLE_ADMIN;
    }

    /**
     * Determine whether the user can update the food.
     *
     * @param  \App\User  $user
     * @param  \App\Food  $food
     * @return mixed
     */
    public function update(User $user, Food $food)
    {
        return $user->role === User::ROLE_ADMIN;
    }

    /**
     * Determine whether the user can delete the food.
     *
     * @param  \App\User  $user
     * @param  \App\Food  $food
     * @return mixed
     */
    public function delete(User $user, Food $food)
    {
        return $user->role === User::ROLE_ADMIN;
    }
}

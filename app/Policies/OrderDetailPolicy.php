<?php

namespace App\Policies;

use App\OrderDetail;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class OrderDetailPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any order details.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->role === User::ROLE_ADMIN;
    }

    /**
     * Determine whether the user can view the order detail.
     *
     * @param  \App\User  $user
     * @param  \App\OrderDetail  $orderDetail
     * @return mixed
     */
    public function view(User $user, OrderDetail $orderDetail)
    {
        //
    }

    /**
     * Determine whether the user can create order details.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the order detail.
     *
     * @param  \App\User  $user
     * @param  \App\OrderDetail  $orderDetail
     * @return mixed
     */
    public function update(User $user, OrderDetail $orderDetail)
    {
        //
    }

    /**
     * Determine whether the user can delete the order detail.
     *
     * @param  \App\User  $user
     * @param  \App\OrderDetail  $orderDetail
     * @return mixed
     */
    public function delete(User $user, OrderDetail $orderDetail)
    {
        //
    }
}

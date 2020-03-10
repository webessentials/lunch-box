<?php

namespace App\Policies;

use App\Schedule;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SchedulePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any schedules.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->role === User::ROLE_ADMIN;
    }

    /**
     * Determine whether the user can view the schedule.
     *
     * @param  \App\User  $user
     * @param  \App\Schedule  $schedule
     * @return mixed
     */
    public function view(User $user, Schedule $schedule)
    {
        //
    }

    /**
     * Determine whether the user can create schedules.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->role === User::ROLE_ADMIN;
    }

    /**
     * Determine whether the user can update the schedule.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function update(User $user)
    {
        return $user->role === User::ROLE_ADMIN;
    }

    /**
     * Determine whether the user can delete the schedule.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function delete(User $user)
    {
        return $user->role === User::ROLE_ADMIN;
    }
}

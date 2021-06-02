<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProductPolicy
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

    public function create(User $user): bool
    {
        return $user->is_admin == true;
    }

    public function store(User $user): bool
    {
        return $user->is_admin == true;
    }

    public function destroy(User $user): bool
    {
        return $user->is_admin == true;
    }

    public function restore(User $user): bool
    {
        return $user->is_admin == true;
    }

    public function edit(User $user): bool
    {
        return $user->is_admin == true;
    }

    public function update(User $user): bool
    {
        return $user->is_admin == true;
    }
}

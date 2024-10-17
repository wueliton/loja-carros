<?php

namespace App\Policies;

use App\Models\Store;
use App\Models\User;

class StorePolicy
{
    public function view(User $user, Store $store)
    {
        return $user->hasRole('super') || $user->stores->contains($store);
    }

    public function update(User $user, Store $store)
    {
        return $user->hasRole('super') || ($user->stores->contains($store) && $user->hasRole('admin'));
    }

    public function create(User $user, Store $store)
    {
        return $user->hasRole('super') || ($user->stores->contains($store) && $user->hasRole('admin'));
    }

    public function delete(User $user, Store $store)
    {
        return $user->hasRole('super') || ($user->stores->contains($store) && $user->hasRole('admin'));
    }
}

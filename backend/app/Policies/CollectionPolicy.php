<?php

namespace App\Policies;

use App\Models\Collection;
use App\Models\User;

class CollectionPolicy
{
    public function modify(User $user, Collection $collection): bool
    {
        return $user->id === $collection->owner_id;
    }
}

<?php

namespace App\Policies;

use App\Models\Board;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class BoardPolicy
{
    /**
     * Determine whether the user can modify the model.
     */
    public function modify(User $user, Board $board): bool
    {
        return $user->id === $board->owner_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Board $board): bool
    {
        return $user->id === $board->owner_id;
    }

}

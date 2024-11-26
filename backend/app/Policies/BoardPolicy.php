<?php

namespace App\Policies;

use App\Models\Board;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class BoardPolicy
{
    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Board $board): bool
    {
        return $user->id === $board->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Board $board): bool
    {
        return $user->id === $board->user_id;
    }

}

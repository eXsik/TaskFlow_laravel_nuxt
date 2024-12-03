<?php

namespace App\Policies;

use App\Models\Card;
use App\Models\User;

class CardPolicy
{
    public function modify(User $user, Card $card): bool
    {
        return $user->id === $card->owner_id;
    }
}

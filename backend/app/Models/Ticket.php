<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Ticket extends Model
{
    protected $fillable = ['title'];

    public function card(): BelongsTo
    {
        return $this->belongsTo(Card::class);
    }
}

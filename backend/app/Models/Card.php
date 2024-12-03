<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Card extends Model
{

    use HasUuids;

    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = ['name', 'owner_id', 'board_id'];

    public function tickets(): HasMany
    {
        return $this->hasMany(Ticket::class);
    }

    public function board(): BelongsTo
    {
        return $this->belongsTo(Board::class);
    }

    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}

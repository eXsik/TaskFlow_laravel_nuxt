<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Card extends Model
{
    protected $fillable = ['title'];

    public function collection(): BelongsTo
    {
        return $this->belongsTo(Collection::class);
    }
}

<?php

namespace App\Providers;

use App\Models\Board;
use App\Models\Card;
use App\Policies\BoardPolicy;
use App\Policies\CardPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Board::class => BoardPolicy::class,
        Card::class => CardPolicy::class,
    ];

    public function boot()
    {
        $this->registerPolicies();

    }
}

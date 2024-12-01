<?php

namespace App\Providers;

use App\Models\Board;
use App\Models\Collection;
use App\Policies\BoardPolicy;
use App\Policies\CollectionPolicy;
use Illuminate\Support\Facades\Gate;
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
        Collection::class => CollectionPolicy::class,
    ];

    public function boot()
    {
        $this->registerPolicies();

    }
}

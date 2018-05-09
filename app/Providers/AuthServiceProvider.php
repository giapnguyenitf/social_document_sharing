<?php

namespace App\Providers;

use App\Models\User;
use App\Models\Document;
use App\Models\Bookmark;
use App\Models\Category;
use App\Policies\UserPolicy;
use App\Policies\DocumentPolicy;
use App\Policies\BookmarkPolicy;
use App\Policies\CategoryPolicy;
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
        'App\Model' => 'App\Policies\ModelPolicy',
        User::class => UserPolicy::class,
        Document::class => DocumentPolicy::class,
        Bookmark::class => BookmarkPolicy::class,
        Category::class => CategoryPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}

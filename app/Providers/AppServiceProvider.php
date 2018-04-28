<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use App\Repositories\Contracts;
use App\Repositories\Eloquent;
use Illuminate\Support\Facades\View;
use App\Models\Category;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        $categories = Category::where('parent_id', '=', config('settings.category.is_parent'))
            ->with('subCategories')
            ->orderBy('name', 'asc')
            ->get();
        View::share('categories', $categories);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            Contracts\UserRepositoryInterface::class,
            Eloquent\UserRepository::class
        );

        $this->app->bind(
            Contracts\DocumentRepositoryInterface::class,
            Eloquent\DocumentRepository::class
        );

        $this->app->bind(
            Contracts\CategoryRepositoryInterface::class,
            Eloquent\CategoryRepository::class
        );

        $this->app->bind(
            Contracts\CommentRepositoryInterface::class,
            Eloquent\CommentRepository::class
        );

        $this->app->bind(
            Contracts\BookmarkRepositoryInterface::class,
            Eloquent\BookmarkRepository::class
        );
    }
}

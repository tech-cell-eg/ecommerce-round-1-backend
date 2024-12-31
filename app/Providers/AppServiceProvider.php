<?php

namespace App\Providers;

use App\Models\Cart;
use App\Models\Favorite;
use App\Models\Review;
use App\Models\User;
use App\Observers\CartObserver;
use App\Observers\FavoriteObserver;
use App\Observers\ReviewObserver;
use App\Observers\UserObserver;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{

    protected $policies = [
    ];
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        User::observe(UserObserver::class);
        Review::observe(ReviewObserver::class);
        Favorite::observe(FavoriteObserver::class);
        Cart::observe(CartObserver::class);

        Gate::define('manage admins', function ($user) {
            return $user->hasRole('admin');
        });

        Gate::define('manage products', function ($user) {
            return $user->hasPermissionTo('manage products');
        });

        Gate::define('manage categories', function ($user) {
            return $user->hasRole('categoriesManager'); 
        });

        Paginator::useBootstrapFive();
    }
}

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
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
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
    }
}

<?php

namespace App\Providers;

use App\Models\User;
use App\Models\Group;
use App\Observers\ModelObserver;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Schema;


class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        User::observe(ModelObserver::class);
        Group::observe(ModelObserver::class);
        // Schema::defaultStringLength(191);
        // foreach (glob(app_path('Models') . '/*.php') as $modelFile) {
        //     $modelClass = 'App\\Models\\' . basename($modelFile, '.php');
        //     $modelInstance = new $modelClass;

        //     if ($modelInstance instanceof Model) {
        //         $modelClass::observe(ModelObserver::class);
        //     }
        // }
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}

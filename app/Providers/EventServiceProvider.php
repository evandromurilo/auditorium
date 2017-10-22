<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'App\Events\RequestStatusChanged' => [
					'App\Listeners\SendStatusChangeNotification',
        ],
				'App\Events\NotificationRead' => [
				],
				'App\Events\MessageCreated' => [
					'App\Listeners\SendNewMessageNotification',
				],
				'App\Events\CallCreated' => [
					'App\Listeners\SendNewCallNotification',
					'App\Listeners\SetCallMembersPermissions',
				],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}

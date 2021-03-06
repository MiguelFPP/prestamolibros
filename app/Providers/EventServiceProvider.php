<?php

namespace App\Providers;

use App\Events\LoanBooksEndEvent;
use App\Events\LoanBooksStartEvent;
use App\Listeners\LoanBooksEndListener;
use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Registered;
use App\Listeners\LoanBooksStartListener;
use JeroenNoten\LaravelAdminLte\Events\BuildingMenu;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

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

        LoanBooksStartEvent::class => [
            LoanBooksStartListener::class,
        ],
        LoanBooksEndEvent::class => [
            LoanBooksEndListener::class
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        Event::listen(BuildingMenu::class, function (BuildingMenu $event) {
            // Add some items to the menu...
            if (session('books')) {
                $event->menu->addAfter('page', [
                    'key' => 'cart_books',
                    'text' => 'Carrito',
                    'route'  => 'loans.show_cart_loan',
                    'active' => ['loan/show-cart*'],
                    'icon' => 'fas fa-shopping-cart',
                    'label' => count(session('books')),
                ]);
            }
        });
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     *
     * @return bool
     */
    public function shouldDiscoverEvents()
    {
        return false;
    }
}

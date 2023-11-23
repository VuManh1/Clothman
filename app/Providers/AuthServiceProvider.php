<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\Order;
use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        VerifyEmail::toMailUsing(function (object $notifiable, string $url) {
            return (new MailMessage)
                ->subject('Xác thực Email')
                ->line('Hãy ấn nút dưới đây để xác thực Email của bạn.')
                ->action('Xác thực Email', $url);
        });

        // Gates
        Gate::define('cancel-order', function (User $user, Order $order) {
            return $user->id === $order->user_id;
        });
    }
}

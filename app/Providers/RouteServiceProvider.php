<?php

namespace App\Providers;

use App\Models\Attachment;
use App\Models\Order;
use App\Models\User;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to the "home" route for your application.
     *
     * This is used by Laravel authentication to redirect users after login.
     *
     * @var string
     */
    public const HOME = '/client/dashboard';

    /**
     * The controller namespace for the application.
     *
     * When present, controller route declarations will automatically be prefixed with this namespace.
     *
     * @var string|null
     */
    // protected $namespace = 'App\\Http\\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        $this->configureRateLimiting();

        $this->routes(function () {
            Route::prefix('api')
                ->middleware('api')
                ->namespace($this->namespace)
                ->group(base_path('routes/api.php'));

            Route::middleware('web')
                ->namespace($this->namespace)
                ->group(base_path('routes/web.php'));
        });

        $this->bindRouteParams();
    }

    /**
     * Bind route parameters
     *
     * @return void
     */
    protected function bindRouteParams(){
        Route::bind('order', function($value){
            // Admin route
            if(request()->is('admin/orders*') || auth('admin')->check()){
                return Order::where('id', $value)->firstOrFail();
            }

            // Client route
            if(auth('web')->check()){
                return auth()->user()
                    ->orders()
                    ->where('id', $value)
                    ->firstOrFail();
            }

            return null;
        });

        Route::bind('message', function($value){
            $order = Route::current()->parameter('order');

            // Admin accessing the route
            if(request()->is('admin*') || auth('admin')->check()){
                if($order){
                    return $order->messages()
                        ->where('id', $value)
                        ->firstOrFail();
                }
            }

            // A client accessing the route
            // Only return messages belonging to client's orders
            if($order){
                if(auth('web')->check() && $order->user_id == auth('web')->id()){
                    return $order->messages()
                        ->where('id', $value)
                        ->firstOrFail();
                }
            }

            return null;
        });

        Route::bind('attachment', function($value){
            $order = Route::current()->parameter('order');
            $message = Route::current()->parameter('message');

            if(is_string($message)){
                $message = $order->messages()->where('id', $message)->first();
            }

            // Admin accessing the attachment
            // Return attachments belonging to any orders
            if(request()->is('admin*') || auth('admin')->check()){
                if($message){
                    return $message->attachments()
                        ->where('id', $value)
                        ->firstOrFail();
                }

                if($order){
                    return $order->attachments()
                        ->where('id', $value)
                        ->firstOrFail();
                }
            }

            // A client accessing the attachment
            // Only return attachments belonging to client's orders
            if($order){
                if(auth('web')->check() && $order->user_id == auth('web')->id()){
                    if($message){
                        return $message->attachments()
                            ->where('id', $value)
                            ->firstOrFail();
                    }

                    return $order->attachments()
                        ->where('id', $value)
                        ->firstOrFail();
                }
            }

            return null;
        });

        Route::bind('client', function($value){
            return User::where('id', $value)->firstOrFail();
        });
    }




    /**
     * Configure the rate limiters for the application.
     *
     * @return void
     */
    protected function configureRateLimiting()
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by(optional($request->user())->id ?: $request->ip());
        });
    }
}

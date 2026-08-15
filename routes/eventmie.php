<?php

use Classiebit\Eventmie\Facades\Eventmie;
use Classiebit\Eventmie\Middleware\Authenticate;
use Classiebit\Eventmie\Models\User;
use Illuminate\Support\Facades\Schema;

/*
|
| Package Routes
|
*/

/* Eventmie-pro package namespace */
$namespace = '\Classiebit\Eventmie\Http\Controllers';

/* Localization */
Route::get('/assets/js/eventmie_lang', function () {
    $lang = session('my_lang', config('app.locale'));
    $allowed = lang_selector();
    if (! is_string($lang) || ! in_array($lang, $allowed, true)) {
        $lang = config('eventmie.default_lang', config('app.locale'));
    }

    App::setLocale($lang);

    $strings = [
        'em' => Lang::get('eventmie::em'),
    ];

    return response(
        'window.i18n = '.json_encode($strings, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_AMP | JSON_HEX_QUOT).';'
    )->header('Content-Type', 'text/javascript; charset=UTF-8');
})->name('eventmie.eventmie_lang');

/* set local timezone */
Route::post('/set/local_timezone', function (Illuminate\Http\Request $request) {

    $timezone = (string) $request->input('local_timezone', '');
    if ($timezone === '' || ! in_array($timezone, timezone_identifiers_list(), true)) {
        $timezone = 'UTC';
    }

    if (Schema::hasTable('settings')) {
        session(['local_timezone' => $timezone]);
    }

    return response()->json(['success' => 'success'], 200);

})->name('eventmie.local_timezone');

// Lang selector
Route::get('/lang/{lang?}', $namespace.'\EventmieController@change_lang')->name('eventmie.change_lang');

// Package Asset
Route::get('frontend-assets', $namespace.'\EventmieController@assets')->name('eventmie.eventmie_assets');

/* Auth */

// Login
Route::get('login', $namespace.'\Auth\LoginController@showLoginForm')->name('eventmie.login');
Route::post('login', $namespace.'\Auth\LoginController@login')->middleware('throttle:5,1')->name('eventmie.login_post');

// Logout
Route::post('/logout', $namespace.'\EventmieController@logout')->name('eventmie.logout');

// Registration
Route::get('register', $namespace.'\Auth\RegisterController@showRegistrationForm')->name('eventmie.register_show');
Route::post('register', $namespace.'\Auth\RegisterController@register')->middleware('throttle:5,1')->name('eventmie.register');

// Forgot password
Route::get('password/reset', $namespace.'\Auth\ForgotPasswordController@showLinkRequestForm')->name('eventmie.password.request');
Route::post('password/email', $namespace.'\Auth\ForgotPasswordController@sendResetLinkEmail')->middleware('throttle:3,1')->name('eventmie.password.email');
Route::get('forgot/password/reset/{token}', $namespace.'\Auth\ResetPasswordController@showResetForm')->name('eventmie.password.reset');
Route::post('forgot/password/reset/post', $namespace.'\Auth\ResetPasswordController@reset')->middleware('throttle:5,1')->name('eventmie.password.reset_post');

// Email Verify
Route::get('email/verify', $namespace.'\Auth\VerificationController@show')->name('verification.notice');
Route::middleware([Authenticate::class])->get('email/verify/{id}', $namespace.'\Auth\VerificationController@verify')->name('verification.verify');
Route::get('email/resend', $namespace.'\Auth\VerificationController@resend')->name('verification.resend');

/* Eventmie-pro package routes */
Route::group([
    'prefix' => config('eventmie.route.prefix'),
    'as' => 'eventmie.',
], function () use ($namespace) {

    /* Welcome */
    Route::get('/', $namespace."\WelcomeController@index")->name('welcome');

    Route::get('/home', function () {
        return redirect()->route('eventmie.welcome');
    });

    /* Events */
    Route::prefix('/events')->group(function () use ($namespace) {
        $controller = $namespace.'\EventsController';

        Route::get('/', "$controller@index")->name('events_index');

        // API (must be registered before the {event} wildcard)
        Route::get('/api/get_events', "$controller@events")->name('events');
        Route::get('/api/categories', "$controller@categories")->name('myevents_categories');
        Route::get('/api/search-events', "$controller@searchEvents")->name('search_events');

        Route::get('/{event}', "$controller@show")->name('events_show');

    });

    /* Bookings */
    Route::prefix('/bookings')->group(function () use ($namespace) {
        $controller = $namespace.'\BookingsController';

        // Redirect back to event
        Route::get('/login-first', "$controller@login_first")->name('login_first');
        Route::get('/signup-first', "$controller@signup_first")->name('signup_first');

        // API
        Route::post('/api/booking_customers', "$controller@get_customers")->name('get_customers');
        Route::post('/api/book_tickets', "$controller@book_tickets")->name('bookings_book_tickets');
    });

    /* My Bookings (customers) */
    Route::prefix('/mybookings')->group(function () use ($namespace) {
        $controller = $namespace.'\MyBookingsController';

        Route::get('/', "$controller@index")->name('mybookings_index');

        // API
        Route::get('/api/get_mybookings', "$controller@mybookings")->name('mybookings');
    });

    /* Events */
    Route::prefix('/dashboard/myevents')->middleware(['auth', 'admin.user'])->group(function () use ($namespace) {
        $controller = $namespace.'\MyEventsController';

        Route::get('/', "$controller@index")->name('myevents_index');
        Route::get('/manage/{slug?}', "$controller@form")->name('myevents_form');
        Route::post('/delete/{slug}', "$controller@delete_event")->name('delete_event');

        // API
        Route::get('/api/get_myevents', "$controller@get_myevents")->name('myevents');
        Route::get('/api/get_all_myevents', "$controller@get_all_myevents")->name('all_myevents');
        Route::post('/api/store', "$controller@store")->name('myevents_store');
        Route::post('/api/store_detail_media', "$controller@storeDetailEditorMedia")->name('myevents_detail_media');
        Route::post('/api/store_media', "$controller@store_media")->name('myevents_store_media');
        Route::post('/api/store_location', "$controller@store_location")->name('myevents_store_location');
        Route::post('/api/store_timing', "$controller@store_timing")->name('myevents_store_timing');
        Route::post('/api/store_seo', "$controller@store_seo")->name('myevents_store_seo');
        Route::get('/api/countries', "$controller@countries")->name('myevents_countries');
        Route::post('/api/get_myevent', "$controller@get_user_event")->name('get_myevent');
        Route::post('/api/publish_myevent', "$controller@event_publish")->name('publish_myevent');

        // delete multiple images
        Route::post('delete/image', "$controller@delete_image")->name('delete_image');
    });

    /* Notification */
    Route::prefix('/notifications')->middleware('auth')->group(function () {

        // read notification
        Route::get('/read/{n_type}', function ($n_type) {
            if ($n_type) {
                $id = Auth::id();
                $user = User::find($id);
                if ($user) {
                    $user->unreadNotifications->where('n_type', $n_type)->markAsRead();
                }
            }

            if (! Auth::user()) {
                return redirect()->route('eventmie.login');
            }

            // Admin: redirect to admin-panel
            if (Auth::user()->hasRole('admin')) {
                if ($n_type == 'user') {
                    return redirect()->route('voyager.users.index');
                } else {
                    return redirect()->route('voyager.dashboard');
                }
            }

            // customer redirect to notification's related page
            if (Auth::user()->hasRole('customer')) {
                // create events notification
                if ($n_type == 'user') {
                    return redirect()->route('eventmie.profile');
                }

                // create booking notification
                if ($n_type == 'bookings') {
                    return redirect()->route('eventmie.mybookings_index');
                }
            }

            // Default: redirect to homepage
            return redirect()->route('eventmie.welcome');
        })->name('notify_read');

    });

    /* Profile */
    Route::prefix('/profile')->group(function () use ($namespace) {
        $controller = $namespace.'\ProfileController';

        Route::get('/', "$controller@index")->name('profile');
        Route::post('/updateAuthUser', "$controller@updateAuthUser")->name('updateAuthUser');
        Route::post('/updatePasswordUser', "$controller@updateSecurity")->name('updatePasswordUser');
    });

    /* Contact */
    Route::prefix('/contact')->group(function () use ($namespace) {
        $controller = $namespace.'\ContactController';

        Route::get('/', "$controller@index")->name('contact');
        Route::post('/save', "$controller@store_contact")->middleware('throttle:5,1')->name('store_contact');
    });

    /* ============================= ALL OTHER ROUTES ABOVE ============================= */
    /* Wildcard routes (add all other routes above) */
    /* Static Pages */
    Route::get('pages/{page}', $namespace."\PagesController@view")->name('page');
    /* ============================= NO ROUTES BELOW THIS ============================= */
});

// Voyager Routes -----------------------------------------------------------------
Route::group([
    'namespace' => $namespace.'\Voyager',
    'prefix' => config('eventmie.route.prefix').'/'.config('eventmie.route.admin_prefix'),
], function () {
    Voyager::routes();
});
// --------------------------------------------------------------------------

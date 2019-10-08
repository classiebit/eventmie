<?php

use Classiebit\Eventmie\Facades\Eventmie;

/*
|--------------------------------------------------------------------------
| Package Routes
|--------------------------------------------------------------------------
|
*/

$namespace = '\Classiebit\Eventmie\Http\Controllers';


Route::group([
    // 'namespace' => $namespace,
    'prefix' => config('eventmie.route.prefix'),
    'as'    => 'eventmie.'
], function() {

    $namespace = '\Classiebit\Eventmie\Http\Controllers';    
        
    // Localization --------------------------------------------------------------------------
    Route::get('/assets/js/eventmie_lang', function () {
        // default lang
        $lang = config('app.locale');
           
        // user lang
        if(session('my_lang'))
        {
            $lang = session('my_lang');    
            \App::setLocale(session('my_lang'));
        }
        
        $strings['em'] = \Lang::get('eventmie::em');
         
        header('Content-Type: text/javascript; charset=UTF-8');
        echo('window.i18n = ' . json_encode($strings) . ';');
        
        exit();
    })->name('eventmie_lang');
    // --------------------------------------------------------------------------

    // eventmie lang selector Route---------------------------------------------------------------------------
    Route::get('/lang/{lang?}', $namespace.'\EventmieController@change_lang')->name('change_lang');

    // Package Asset Routes ------------------------------------------------------------
    Route::get('eventmie-assets', $namespace.'\EventmieController@assets')->name('eventmie_assets');
    // --------------------------------------------------------------------------


    // Auth route --------------------------------------------------------------------
    Auth::routes();

    // Login --------------------------------------------------------------------------
    Route::get('login', $namespace.'\Auth\LoginController@showLoginForm')->name('login');
    Route::post('login', $namespace.'\Auth\LoginController@login')->name('login_post');
    // --------------------------------------------------------------------------

    // Logout route --------------------------------------------------------------------
    Route::match(['get', 'post'], '/logout', $namespace.'\EventmieController@logout')->name('logout');
    // --------------------------------------------------------------------------
    
    // Registration Routes------------------------------------------------------------------------------------
    Route::get('register', $namespace.'\Auth\RegisterController@showRegistrationForm');
    Route::post('register', $namespace.'\Auth\RegisterController@register')->name('register');
    //--------------------------------------------------------------------------------------------------


    // Forgot password Password-------------------------------------------------------------------
    Route::get('password/reset',  $namespace.'\Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
    Route::post('password/email', $namespace.'\Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
    Route::get('forgot/password/reset/{token}', $namespace.'\Auth\ResetPasswordController@showResetForm')->name('password.reset');
    Route::post('forgot/password/reset/post',   $namespace.'\Auth\ResetPasswordController@reset')->name('password.reset_post');
    //-----------------------------------------------------------------------------
    
    
    
    // --------------------------------------------------------------------------
    // Package Controllers Routes ******************************************************
    // --------------------------------------------------------------------------

    // Welcome Routes -------------------------------------------------------------
    Route::get('/', $namespace."\WelcomeController@index")->name('welcome');
    Route::get('/home', function() {
        return redirect()->route('eventmie.welcome');
    });
    // --------------------------------------------------------------------------
    
    // Static Pages Routes -------------------------------------------------------------
    Route::get('/{page}', $namespace."\PagesController@view")
    ->where('page', 'about|terms|privacy')->name('page'); 
    // --------------------------------------------------------------------------

    // Events Routes -----------------------------------------------------------------
    Route::prefix('/events')->group(function () use ($namespace) {
        $controller = $namespace.'\EventsController';
        
        Route::get('/', "$controller@index")->name('events_index');
        
        Route::get('/api/get_events', "$controller@events")->name('events'); // axios route        
        
        // Wildcard routes
        Route::get('/{event}', "$controller@show")->name('events_show');
        
        Route::get('/api/categories', "$controller@categories")->name('myevents_categories');   // axios route  
        
    });
    // --------------------------------------------------------------------------
    
    // Bookings Routes -----------------------------------------------------------------
    Route::prefix('/bookings')->group(function () use ($namespace)  {

        $controller = $namespace.'\BookingsController';

        Route::post('/api/get_customers', "$controller@get_customers")->name('bookings_get_customers');  // axios route
        Route::post('/api/book_tickets', "$controller@book_tickets")->name('bookings_book_tickets');   // axios route
    });
    // --------------------------------------------------------------------------
    
    // My Bookings Routes For Customer  -----------------------------------------------------------------
    Route::prefix('/mybookings')->group(function () use($namespace) {
        
        $controller = $namespace.'\MybookingsController';

        Route::get('/', "$controller@index")->name('mybookings_index');                     
        Route::get('/api/get_mybookings', "$controller@mybookings")->name('mybookings');  // axios route

    });
    // --------------------------------------------------------------------------

    
    // Events Routes -----------------------------------------------------------------
    Route::prefix('/myevents')->group(function () use ($namespace) {
        $controller = $namespace.'\MyEventsController';
        
        Route::get('/', "$controller@index")->name('myevents_index');
        Route::get('/api/get_myevents', "$controller@get_myevents")->name('myevents');                  // axios route
        
        // event create and edit
        Route::get('/manage/{slug?}', "$controller@form")->name('myevents_form');  
        
        Route::post('/api/store', "$controller@store")->name('myevents_store');                             // axios route
        Route::post('/api/store_media', "$controller@store_media")->name('myevents_store_media');           // axios route
        Route::post('/api/store_location', "$controller@store_location")->name('myevents_store_location');  // axios route
        Route::post('/api/store_timing', "$controller@store_timing")->name('myevents_store_timing');        // axios route
        Route::post('/api/store_seo', "$controller@store_seo")->name('myevents_store_seo');  // axios route
        Route::get('/api/countries', "$controller@countries")->name('myevents_countries');      // axios route  
        Route::post('/api/get_myevent', "$controller@get_user_event")->name('get_myevent');      // axios route  
        Route::post('/api/publish_myevent', "$controller@event_publish")->name('publish_myevent');      // axios route  

        // event delete
        Route::get('/delete/{slug}', "$controller@delete_event")->name('delete_event');       // axios route 
     
    });
    //---------------------------------------------------------------------------------------------------------------

    // Notification Route ----------------------------------------------------------------------
    Route::prefix('/notifications')->group(function () use ($namespace)  {
        
        // make read notification 
        Route::get('/read/{n_type}', function($n_type){

            if($n_type) {
                        
                $id   = \Auth::id();
                $user = \Classiebit\Eventmie\Models\User::find($id);
                $user->unreadNotifications->where('n_type', $n_type)->markAsRead();
                
            }
            // admin redirect to dashboard
            if(\Auth::user()->hasRole('admin'))
            {
                if($n_type == "user")
                    return redirect()->route('voyager.users.index');
                else
                    return redirect()->route('voyager.dashboard');
            }

            // customer redirect to notification's related page
            if(\Auth::user()->hasRole('customer'))
            {
                // create events notification
                if($n_type == "user")
                    return redirect()->route('eventmie.profile');
                
                // create booking notification
                if($n_type == "bookings")
                    return redirect()->route('eventmie.mybookings_index');    
            }
            
            // customer redirect to welcome page
            return redirect()->route('eventmie.welcome');
            
        })->name('notify_read');
        
        
    });
    //------------------------------------------------------------------------------------------------------------------

    //Profile Route ----------------------------------------------------------------------------
    Route::prefix('/profile')->group(function () use ($namespace) {
            
        $controller = $namespace.'\ProfileController';
        // view    
        Route::get('/', "$controller@index")->name('profile');
        
        Route::post('/updateAuthUser',"$controller@updateAuthUser")->name('updateAuthUser');
    });
    //------------------------------------------------------------------------------------------

    //Contact Route ----------------------------------------------------------------------------
    Route::prefix('/contact')->group(function () use ($namespace) {
            
        $controller = $namespace.'\ContactController';
        
        // contact view page load 
        Route::get('/', "$controller@index")->name('contact');

        // contact save into contacts tables 
        Route::post('/save', "$controller@store_contact")->name('store_contact');
            
    });
    //-------------------------------------------------------------------------------------------

    
});
// --------------------------------------------------------------------------

// Voyager Routes -----------------------------------------------------------------
Route::group([
    'namespace' => $namespace.'\Voyager',
    'prefix' => config('eventmie.route.prefix').'/'.config('eventmie.route.admin_prefix'),
], function () {
    \Voyager::routes();
});
// --------------------------------------------------------------------------

 
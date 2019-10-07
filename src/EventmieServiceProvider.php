<?php

namespace Classiebit\Eventmie;

use Illuminate\Foundation\AliasLoader;
use Classiebit\Eventmie\Facades\Eventmie as EventmieFacade;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Routing\Router;

// Voyager serviceProvider
use TCG\Voyager\VoyagerServiceProvider as VoyagerServiceProvider;
use TCG\Voyager\Facades\Voyager;

// Ziggy service provider
use Tightenco\Ziggy\ZiggyServiceProvider as ZiggyServiceProvider;
use View;
use Config;


use  Classiebit\Eventmie\Commands\InstallCommand;

class EventmieServiceProvider extends ServiceProvider
{
    
    /**
     * Register the application services.
     */
    public function register()
    {
        // register external packages
        $this->registerPackages();

        // register Eventmie facade
        $loader = AliasLoader::getInstance();
        $loader->alias('Eventmie', EventmieFacade::class);
        $this->app->singleton('eventmie', function () {
            return new Eventmie();
        });

        // boot up all helpers
        $this->loadHelpers();
        
        // boot up config file
        $this->registerConfigs();

        // customise voyager theme
        $this->customVoyagerTheme();

        // initialise console commands 
        if ($this->app->runningInConsole()) 
        {
            $this->registerPublishableResources();
            $this->registerConsoleCommands();
        }
    }

    /**
     * Bootstrap the application services.
     *
     * @param \Illuminate\Routing\Router $router
     */
    public function boot(Router $router)
    {
      
        // load middleware
        $this->loadMiddlewares();

        //exception handler
        \App::singleton(
            \Illuminate\Contracts\Debug\ExceptionHandler::class,
            \Classiebit\Eventmie\Exceptions\MyHandler::class
        );

        if (\Schema::hasTable('settings')) {
            // setup mail configs
            $this->mailConfiguration(setting('mail'));
            
            // setup regional settings
            $this->setRegional(setting('regional'));
        }
        
        
        // load eventmie resources.views
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'eventmie');

        // load eventmie language files publishable.lang
        $this->loadTranslationsFrom(realpath(__DIR__.'/../publishable/lang'), 'eventmie');
        
        // load eventmie database migrations
        if (config('eventmie.database.autoload_migrations', true)) {
            $this->loadMigrationsFrom(realpath(__DIR__.'/../migrations'));
        }
        
    }

    /**
     * Register external package serviceproviders
    */
    private function registerPackages()
    {
        // voyager serviceProvider
        $this->app->register(VoyagerServiceProvider::class);
        
        // ziggy serviceProvider
        $this->app->register(ZiggyServiceProvider::class);
    }

    /**
     * Load middlewares for user group specific access
     */
    private function loadMiddlewares()
    {
        $this->app['router']->aliasMiddleware('auth', \Classiebit\Eventmie\Middleware\Authenticate::class);
        $this->app['router']->aliasMiddleware('customer', \Classiebit\Eventmie\Middleware\CustomerMiddleware::class);
        $this->app['router']->aliasMiddleware('admin', \Classiebit\Eventmie\Middleware\AdminMiddleware::class);
        $this->app['router']->aliasMiddleware('guest', \Classiebit\Eventmie\Middleware\RedirectIfAuthenticated::class);
        $this->app['router']->aliasMiddleware('common', \Classiebit\Eventmie\Middleware\CommonMiddleware::class);
    }

    /**
     * Load helpers.
     */
    private function loadHelpers()
    {
        foreach (glob(__DIR__.'/Helpers/*.php') as $filename) {
            require_once $filename;
        }
    }

    /**
     * Register the publishable files.
     */
    private function registerPublishableResources()
    {
        $with_dummy_option  = false;
        
        $arg_array  = $_SERVER['argv'];

        if(!empty($arg_array))
        {   
            foreach($arg_array as $key => $value)
            {
                
                if($value == "--with-dummy")
                    $with_dummy_option = true; 
            }
        }


        $publishablePath    = dirname(__DIR__).'/publishable';
        $publishable        = [
            
            'config --force' => [
                "{$publishablePath}/config/eventmie.php" => config_path('eventmie.php')
            ],
            'resources --force' => [
                "{$publishablePath}/lang" => resource_path('lang/vendor/eventmie'),
            ],
        ];

        
        // common content for both cases
        $publishable['storage --force'] = ["{$publishablePath}/dummy_content/" => storage_path('app/public')];
        
        if($with_dummy_option)
        {
            // dummmy
            $publishable['seeds --force'] = ["{$publishablePath}/database/seeds/" => database_path('seeds')];

        }
        else
        {
            $publishable['seeds --force'] = ["{$publishablePath}/database/seeds/" => database_path('seeds')];
        }

        foreach ($publishable as $group => $paths) {
            $this->publishes($paths, $group);
        }
        
    }

    /**
     * Setup Eventmie configs
      */
    private function registerConfigs()
    {
        $this->mergeConfigFrom(
            dirname(__DIR__).'/publishable/config/eventmie.php', 'eventmie'
        );

        /* ===== OVERRIDE VOYAGER CONFIG WITHOUT PUBLISHING voyager.php TO LARAVEL APP ===== */
        // merge new config with voyager original config
        $voyager_config = dirname(__DIR__).'/publishable/config/voyager.php';
        $this->app['config']->set('voyager', require $voyager_config);
    
        /* ================================================================================= */
        
    }

    /**
     * Customise voyager theme
      */
    private function customVoyagerTheme()
    {
        $theme_url = eventmie_url().'/'.config('eventmie.route.prefix').'/eventmie-assets?path='.urlencode('css/voyager.css');
        $this->app['config']->set('voyager.additional_css.custom_theme', $theme_url);
    }

    /**
     * Register the commands accessible from the Console.
     */
    private function registerConsoleCommands()
    {
        $this->commands(Commands\InstallCommand::class);
    }
    
    /**
     *  Set mail configs from admin panel settings
     */
    private function mailConfiguration($mail = [])
    {
        Config::set('mail.host', $mail['mail_host']);
        Config::set('mail.port', $mail['mail_port']);
        Config::set('mail.driver', $mail['mail_driver']);
        Config::set('mail.from', ['address' => $mail['mail_sender_email'],
                                    'name' =>  $mail['mail_sender_name']
                                ]);
        Config::set('mail.encryption', $mail['mail_encryption']);
        Config::set('mail.username', $mail['mail_username']);
        Config::set('mail.password', $mail['mail_password']);
            
    }
     
    /**
     * Regional settings
     * Timezone & Language
     * 
     * Set regional settings from admin panel settings
    */
    private function setRegional($regional = [])
    {
        // set server side timezone
        Config::set('app.timezone', $regional['timezone_default']);

        // change only frontend language
        $default_lang = config('eventmie.default_lang');

        // do not change language on admin panel
        $current_url = url()->current();
        $admin_prefix = config('eventmie.route.admin_prefix');
        if (! (strpos($current_url, $admin_prefix) !== false) )
            $this->app->setLocale($default_lang);
    }

}

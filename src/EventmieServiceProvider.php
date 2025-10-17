<?php

namespace Classiebit\Eventmie;

use Illuminate\Foundation\AliasLoader;
use Classiebit\Eventmie\Facades\Eventmie as EventmieFacade;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Log;

/* Laravel packages start*/ 
use TCG\Voyager\VoyagerServiceProvider as VoyagerServiceProvider;
use TCG\Voyager\Facades\Voyager;
use TCG\Voyager\Models\Setting;

use View;
use Config;

use Devrabiul\CookieConsent\CookieConsentServiceProvider as CookieConsentServiceProvider;


/* Console commands */
use  Classiebit\Eventmie\Commands\InstallCommand;
use  Classiebit\Eventmie\Commands\UpdateCommand;

/* Bootstrap Pagination as default */
use Illuminate\Pagination\Paginator;

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
        
        if (\Schema::hasTable('settings')) 
        {
            if (Setting::find(1)) 
            {
                // setup mail configs
                $this->mailConfiguration(setting('mail'));
                
                // setup regional settings
                $this->setRegional(setting('regional'));
                
                // setup storage 
                $this->configureStorage();
            }
        }
        
        // load eventmie resources.views
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'eventmie');

        // load eventmie language files publishable.lang
        $this->loadTranslationsFrom(realpath(__DIR__.'/../publishable/lang'), 'eventmie');
        
        // load eventmie database migrations
        if (config('eventmie.database.autoload_migrations', true)) 
            $this->loadMigrationsFrom(realpath(__DIR__.'/../publishable/database/migrations'));

        /* Pagination default: Bootstrap (for Laravel 8+) */
        if($this->app->version() >= 8) {
            Paginator::useBootstrap();
        }
    }

    private function configureStorage()
    {
        if (function_exists('setting')) {
            $disk = setting('storage.filesystem_disk', 'local');

            // If S3 is selected, validate required variables
            if ($disk === 's3') {
                $requiredS3Settings = [
                    'aws_access_key_id' => setting('storage.aws_access_key_id'),
                    'aws_secret_access_key' => setting('storage.aws_secret_access_key'),
                    'aws_default_region' => setting('storage.aws_default_region'),
                    'aws_bucket' => setting('storage.aws_bucket'),
                    'aws_url' => setting('storage.aws_url'),
                ];

                // Check if any required setting is null or empty
                $missingSettings = array_filter($requiredS3Settings, fn($value) => is_null($value) || $value === '');

                if (empty($missingSettings)) {
                    // All required settings are present, configure S3
                    Config::set('filesystems.disks.s3', [
                        'driver' => 's3',
                        'key' => $requiredS3Settings['aws_access_key_id'],
                        'secret' => $requiredS3Settings['aws_secret_access_key'],
                        'region' => $requiredS3Settings['aws_default_region'],
                        'bucket' => $requiredS3Settings['aws_bucket'],
                        'url' => $requiredS3Settings['aws_url'],
                        'endpoint' => setting('storage.aws_endpoint', env('AWS_ENDPOINT', null)),
                        'use_path_style_endpoint' => setting('storage.aws_use_path_style_endpoint', env('AWS_USE_PATH_STYLE_ENDPOINT', false)),
                    ]);
                    Config::set('filesystems.default', 's3');
                    Config::set('eventmie.admin_storage', 's3');
                    Config::set('voyager.storage.disk', 's3');
                } else {
                    // Missing required settings, fall back to local disk
                    Log::warning('S3 configuration failed due to missing settings: ' . implode(', ', array_keys($missingSettings)));
                    Config::set('filesystems.default', 'local');
                }
            } else {
                // Non-S3 disk selected, use the specified disk
                Config::set('filesystems.default', $disk);
                Config::set('voyager.storage.disk', 'public');
            }
        }
    }

    /**
     * Register external package serviceproviders
    */
    private function registerPackages()
    {
        // voyager serviceProvider
        $this->app->register(VoyagerServiceProvider::class);
        
        // cookie consent
        $this->app->register(CookieConsentServiceProvider::class);
        
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
        $this->app['router']->aliasMiddleware('admin.user', \Classiebit\Eventmie\Middleware\VoyagerAdminMiddleware::class);
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
        $publishablePath    = dirname(__DIR__).'/publishable';

        $publishable        = [
            'config' => [
                "{$publishablePath}/config/eventmie.php" => config_path('eventmie.php'),
                "{$publishablePath}/config/laravel-cookie-consent.php" => config_path('laravel-cookie-consent.php'),
            ],
            'resources' => [
                "{$publishablePath}/lang" => resource_path('lang/vendor/eventmie')
            ],
            'storage' => [
                "{$publishablePath}/dummy_content/" => storage_path('app/public')
            ]
        ];
        
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
        
        // Cookie Consent config
        $this->mergeConfigFrom(
            dirname(__DIR__).'/publishable/config/laravel-cookie-consent.php', 'laravel-cookie-consent'
        );
        
        // twice because of auto-generating locales
        // voyager
        $voyager_config = dirname(__DIR__).'/publishable/config/voyager.php';
        $this->app['config']->set('voyager', require $voyager_config);
    }

    /**
     * Customise voyager theme
      */
    private function customVoyagerTheme()
    {
        $theme_url = url('').'/frontend-assets?path='.urlencode('css/voyager.css');
        $this->app['config']->set('voyager.additional_css.custom_theme', $theme_url);
    }

    /**
     * Register the commands accessible from the Console.
     */
    private function registerConsoleCommands()
    {
        $this->commands(Commands\InstallCommand::class);
        $this->commands(Commands\UpdateCommand::class);
    }
    
    /**
     *  Set mail configs from admin panel settings
     */
    private function mailConfiguration($mail = [])
    {
        // defaults
        $MAIL_MAILER        = 'log';
        $MAIL_HOST          = null;
        $MAIL_PORT          = null;
        $MAIL_USERNAME      = null;
        $MAIL_PASSWORD      = null;
        $MAIL_ENCRYPTION    = null;
        $MAIL_FROM_ADDRESS  = null;
        $MAIL_FROM_NAME     = null;
        if(
            !empty($mail['mail_host']) && 
            !empty($mail['mail_port']) && 
            !empty($mail['mail_driver']) && 
            !empty($mail['mail_sender_email']) && 
            !empty($mail['mail_sender_name']) && 
            !empty($mail['mail_username']) && 
            !empty($mail['mail_password'])  
        )
        {
            $MAIL_MAILER        = $mail['mail_driver'];
            $MAIL_HOST          = $mail['mail_host'];
            $MAIL_PORT          = $mail['mail_port'];
            $MAIL_USERNAME      = $mail['mail_username'];
            $MAIL_PASSWORD      = $mail['mail_password'];
            $MAIL_ENCRYPTION    = $mail['mail_encryption'];
            $MAIL_FROM_ADDRESS  = $mail['mail_sender_email'];
            $MAIL_FROM_NAME     = $mail['mail_sender_name'];
        }   
        
        Config::set('mail.driver', $MAIL_MAILER);
        Config::set('mail.host', $MAIL_HOST);
        Config::set('mail.port', $MAIL_PORT);
        Config::set('mail.username', $MAIL_USERNAME);
        Config::set('mail.password', $MAIL_PASSWORD);
        Config::set('mail.encryption', $MAIL_ENCRYPTION);
        Config::set('mail.from', ['address' => $MAIL_FROM_ADDRESS, 'name' =>  $MAIL_FROM_NAME]);
            
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
        $this->app->setLocale($default_lang);
    }

}

<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Route config
    |--------------------------------------------------------------------------
    |
    | Here you can specify package route Eventmie site and admin panel url prefix
    |
    | prefix : null
    | If prefix is null, then Eventmie site url will be example.com
    |
    | prefix : 'events' -> example.com/events
    | Eventmie site url will be example.com/events
    |
    |
    | admin_prefix : 'admin'
    | Eventmie admin panel url will be example.com/<prefix>/admin
    |
    |
    */
    'route' => [
        'prefix'            => null, 
        'admin_prefix'      => 'admin', // required
    ],


    /*
    |--------------------------------------------------------------------------
    | Developer Mode
    |--------------------------------------------------------------------------
    |
    | Below are all developer settings, change only if you're developer and 
    | having experience Laravel and Laravel Voyager
    |
    |
    */
    'voyager' => [
        'prefix'            => null, 
        'admin_prefix'      => 'admin', // required
    ],    

    /*
    |--------------------------------------------------------------------------
    | Default language
    |--------------------------------------------------------------------------
    |
    | Eventmie default language
    |
    |
    */
    'default_lang'  => 'en',

    
    /*
    |--------------------------------------------------------------------------
    | Detect RTL language
    |--------------------------------------------------------------------------
    |
    | Below are all RTL languages pre defined, and the website direction will 
    | be changed accordingly
    |
    |
    */
    'rtl_langs'        => [
        'ar', // arabic
        'fa', // persian
        'he', // hebrew
        'ms', // malay
        'ur', // urdu
        'ml' // malayalam
    ],



];



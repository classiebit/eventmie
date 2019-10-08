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
    | If prefix is null, then Eventmie base url will be example.com
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
    | Database Config
    |--------------------------------------------------------------------------
    |
    | Here you can specify Eventmie database settings
    |
    */
    'database' => [
        'autoload_migrations' => true,
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



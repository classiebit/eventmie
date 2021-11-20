# Eventmie Lite

**Welcome to Eventmie Lite**

<br>

Eventmie is an Event planning and management Laravel package. With Eventmie, launch a dedicated platform for Event planning on your domain. Streamline the event planning process through automation. Eventmie is secure, scalable, production-ready.

<br>

Just **install** it into a brand new Laravel application or an existing one and start selling events for free.

---

#### Read the documentation live - [Eventmie Docs](https://eventmie-docs.classiebit.com)

#### Live Preview - [Eventmie](https://eventmie.classiebit.com)

---

![Eventmie - Event planning reimagined with Laravel](https://eventmie-docs.classiebit.com/images/eventmie-docs-banner-1.jpg "Event planning reimagined with Laravel")

---

> **Here's a complete video tutorial guide for getting started quickly [Eventmie Academy](https://classiebit.com/academy/eventmie/getting-started) ✌️**

---

### Lite Version

**Eventmie Lite Version** is open-source, free to use. Lite version has got limited features & functionality.

+ [Live](https://eventmie.classiebit.com) - Visit lite version live.
+ [Github](https://github.com/classiebit/eventmie) - Give us a Star.
+ [Download](https://classiebit.com/eventmie) - Visit here to download.


### Pro Version

**Eventmie Pro Version** comes with **Commercial** license. Pro version is fully loaded with a lot of useful and exciting features.

+ [Live](https://eventmie-pro.classiebit.com) - Live preview available now.
+ [Purchase](https://classiebit.com/eventmie-pro) - Available for purchase now - Flat 50% Off (limited time offer)



### FullyLoaded Version

**EventmiePro FullyLoaded** comes with **Commercial** license. Eventmie Pro FullyLoaded is Advanced version of Eventmie Pro Loaded with Power pack features.

+ [Live](https://eventmie-pro-fullyloaded.classiebit.com) - Live preview available now.
+ [Purchase](https://classiebit.com/eventmie-pro-fullyloaded) - Available for purchase now - Flat 50% Off (limited time offer)

---

## Installation

Eventmie can be installed via composer. Easy... 🍻


## Prerequisites

* Laravel version 5.5 / 5.6 / 5.7 / 5.8 / 6.x / 7.x / 8.x
* Make sure to install Eventmie package on a **Fresh** or **Existing** Laravel application. 
* We also assume that you've setup the database.
* If you're running MySql version older than < 5.7 then disable strict mode in Laravel `config/database.php` `'strict' => false`


## Install

1. If installing Eventmie on an existing Laravel application and you already have Auth system then **skip this step**

    if installing Eventmie on **Fresh Laravel application** then run 

    **For Laravel 5.5 to 5.8**

    ```php
    php artisan make:auth

    php artisan migrate
    ```

    **For Laravel 6.x**

    ```php
    composer require laravel/ui --dev

    php artisan ui vue --auth

    npm install && npm run dev

    php artisan migrate
    ```

2. Install Eventmie via Composer

    ```php
    composer require classiebit/eventmie
    ```

3. Run Eventmie install command

    ```php
    php artisan eventmie:install
    ```


## Configurations

After installation, you'll see the Eventmie config `config/eventmie` file. You can make the following changes-

<br>

1. Route config - whether to run Eventmie as a base site e.g `example.com` or on a specific url e.g `example.com/myevents`

    ```php
    'route' => [
        'prefix'            => null, // for front-end
        'admin_prefix'      => 'admin', // for admin panel
    ],
    ```

2. RTL Languages - Eventmie detects RTL language from this list and changes site direction accordingly. You can add any other RTL language to the list.

    ```php
    'rtl_langs'        => [
        'ar', // arabic
        'fa', // persian
        'he', // hebrew
        'ms', // malay
        'ur', // urdu
        'ml' // malayalam
    ],
    ```

---

## Demo Accounts

Demo accounts have got `demo data` to easily showcase all the features of Eventmie.

1. We refresh the database every day.
2. While in demo mode, there are no restrictions except -

    - Deleting or Disabling user account.
    - Changing User email and password.
    - Deleting categories and events.
    - Modifying admin panel settings.


---

> **Password is same for all - `password`**

---

#### Customer Accounts

1. David lane         - `davidlane@mail.com`
2. Cora Woods         - `corawoods@mail.com`
3. Roman Pane         - `romanpane@mail.com`
4. Tara Young         - `tarayoung@mail.com`


#### Account having access to `Admin Panel`

1. Super-Admin (full access)    - `admin@admin.com`


---

#### Read the beautiful documentation here - [Eventmie Docs](https://eventmie-docs.classiebit.com)

---
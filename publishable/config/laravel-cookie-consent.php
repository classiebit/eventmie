<?php

/**
 * Cookie Consent Configuration
 *
 * This file contains all the configuration options for the cookie consent system.
 * It allows customization of the cookie banner appearance, behavior, and compliance settings.
 *
 * @package Config
 * @author Muhammad Rabiul
 * @license MIT
 */

return [

    /*
    |--------------------------------------------------------------------------
    | Cookie Consent Prefix
    |--------------------------------------------------------------------------
    | This setting determines whether the cookie consent banner should be displayed.
    | Set this value to 'true' to show the banner or 'false' to disable it.
    | You can control this via the .env file using APP_NAME.
    */
    'cookie_prefix' => env('APP_NAME', 'Eventmie'),

    /**
     * Enable or disable the cookie consent banner
     *
     * @default true
     * @env COOKIE_CONSENT_ENABLED
     */
    'enabled' => env('COOKIE_CONSENT_ENABLED', true),

    /**
     * Cookie lifetime in days
     *
     * Defines how long the consent cookie should persist in the user's browser.
     *
     * @default 365
     * @env COOKIE_CONSENT_LIFETIME
     */
    'cookie_lifetime' => env('COOKIE_CONSENT_LIFETIME', 365),

    /**
     * Rejection cookie lifetime in days
     *
     * Specifies how long the rejection cookie should persist when users decline cookies.
     *
     * @default 7
     * @env COOKIE_REJECT_LIFETIME
     */
    'reject_lifetime' => env('COOKIE_REJECT_LIFETIME', 7),

    /**
     * Consent modal layout style
     *
     * Determines the visual presentation of the consent modal.
     *
     * @default 'bar-inline'
     * @env COOKIE_CONSENT_MODAL_LAYOUT
     * @option box - Small floating box
     * @option box-inline - Small floating box positioned inline
     * @option box-wide - Larger floating box
     * @option cloud - Cloud-like floating consent box
     * @option cloud-inline - Compact cloud-style box
     * @option bar - Simple bar at top or bottom
     * @option bar-inline - Compact inline bar
     */
    'consent_modal_layout' => env('COOKIE_CONSENT_MODAL_LAYOUT', 'bar'),

    /**
     * Enable preferences modal
     *
     * Determines if users can access detailed cookie preferences.
     *
     * @default false
     * @env COOKIE_CONSENT_PREFERENCES_ENABLED
     */
    'preferences_modal_enabled' => env('COOKIE_CONSENT_PREFERENCES_ENABLED', true),

    /**
     * Preferences modal layout style
     *
     * Defines the visual presentation of the preferences modal.
     *
     * @default 'bar'
     * @env COOKIE_CONSENT_PREFERENCES_LAYOUT
     * @option bar - Bar-style modal
     * @option box - Popup-style box
     */
    'preferences_modal_layout' => env('COOKIE_CONSENT_PREFERENCES_LAYOUT', 'bar'),

    /**
     * Enable flip button animation
     *
     * Adds a flip animation effect to consent buttons.
     *
     * @default true
     * @env COOKIE_CONSENT_FLIP_BUTTON
     */
    'flip_button' => env('COOKIE_CONSENT_FLIP_BUTTON', true),

    /**
     * Disable page interaction until consent
     *
     * When enabled, users must interact with the cookie banner before accessing content.
     *
     * @default true
     * @env COOKIE_CONSENT_DISABLE_INTERACTION
     */
    'disable_page_interaction' => env('COOKIE_CONSENT_DISABLE_INTERACTION', true),

    /**
     * Color theme for the cookie banner
     *
     * @default 'default'
     * @env COOKIE_CONSENT_THEME
     * @option default - Standard theme
     * @option dark - Dark mode theme
     * @option light - Light mode theme
     * @option custom - Custom styles (requires additional CSS)
     */
    'theme' => env('COOKIE_CONSENT_THEME', 'dark'),

    /**
     * Cookie banner title text
     *
     * @default "Cookie Disclaimer"
     */
    'cookie_title' => "Cookie Disclaimer",

    /**
     * Cookie banner description text
     *
     * @default "This website uses cookies to enhance your browsing experience, analyze site traffic, and personalize content. By continuing to use this site, you consent to our use of cookies."
     */
    'cookie_description' => "This website uses cookies to enhance your browsing experience, analyze site traffic, and personalize content. By continuing to use this site, you consent to our use of cookies.",

    /**
     * Accept all cookies button text
     *
     * @default 'Accept all'
     */
    'cookie_accept_btn_text' => 'Accept all',

    /**
     * Reject all cookies button text
     *
     * @default 'Reject all'
     */
    'cookie_reject_btn_text' => 'Reject all',

    /**
     * Manage preferences button text
     *
     * @default 'Manage preferences'
     */
    'cookie_preferences_btn_text' => 'Manage preferences',

    /**
     * Save preferences button text
     *
     * @default 'Save preferences'
     */
    'cookie_preferences_save_text' => 'Save preferences',

    /**
     * Preferences modal title text
     *
     * @default 'Cookie Preferences'
     */
    'cookie_modal_title' => 'Cookie Preferences',

    /**
     * Preferences modal introduction text
     *
     * @default 'You can customize your cookie preferences below.'
     */
    'cookie_modal_intro' => 'You can customize your cookie preferences below.',

    /**
     * Cookie categories configuration
     *
     * Defines the different types of cookies users can manage.
     *
     * @category necessary - Essential cookies that cannot be disabled
     * @category analytics - Cookies used for tracking and analytics
     * @category marketing - Cookies used for advertising
     * @category preferences - Cookies for user preference storage
     */
    'cookie_categories' => [
        'necessary' => [
            'enabled' => true,
            'locked' => true,
            'title' => 'Essential Cookies',
            'description' => 'These cookies are essential for the website to function properly.',
        ],
        'analytics' => [
            'enabled' => env('COOKIE_CONSENT_ANALYTICS', false), // Disabled by default
            'locked' => false,
            'js_action' => 'loadGoogleAnalytics',
            'title' => 'Analytics Cookies',
            'description' => 'These cookies help us understand how visitors interact with our website. (Currently disabled - no analytics keys configured)',
        ],
        'marketing' => [
            'enabled' => env('COOKIE_CONSENT_MARKETING', false), // Disabled by default
            'locked' => false,
            'js_action' => 'loadFacebookPixel',
            'title' => 'Marketing Cookies',
            'description' => 'These cookies are used for advertising and tracking purposes. (Currently disabled - no marketing keys configured)',
        ],
        'preferences' => [
            'enabled' => env('COOKIE_CONSENT_PREFERENCES', true), // Enabled by default
            'locked' => false,
            'js_action' => 'loadPreferencesFunc',
            'title' => 'Preferences Cookies',
            'description' => 'These cookies allow the website to remember user preferences like language and theme.',
        ],
    ],

    /**
     * Privacy policy URL
     *
     * URL where users can find detailed information about cookie usage.
     *
     * @default null
     * @env COOKIE_CONSENT_PRIVACY_URL
     */
    'privacy_url' => env('COOKIE_CONSENT_PRIVACY_URL', '/pages/privacy'),

    /**
     * Terms of service URL
     *
     * URL where users can find the terms of service.
     *
     * @default null
     * @env COOKIE_CONSENT_TERMS_URL
     */
    'terms_url' => env('COOKIE_CONSENT_TERMS_URL', '/pages/terms'),

    /**
     * Custom CSS for styling
     *
     * Additional CSS to customize the appearance of the cookie banner.
     *
     * @default null
     */
    'custom_css' => null,

    /**
     * Custom JavaScript
     *
     * Additional JavaScript to enhance cookie consent functionality.
     *
     * @default null
     */
    'custom_js' => null,

    /**
     * Policy links configuration
     *
     * Links to legal documents displayed in the cookie banner.
     *
     * @item text - Display text for the link
     * @item link - URL to the policy document
     */
    'policy_links' => [
        [
            'text' => 'Privacy Policy',
            'link' => env('COOKIE_CONSENT_PRIVACY_URL', '/pages/privacy')
        ],
        [
            'text' => 'Terms and Conditions',
            'link' => env('COOKIE_CONSENT_TERMS_URL', '/pages/terms')
        ],
    ],

]; 
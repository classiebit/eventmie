<!-- Packages CSS -->
@Vite('vendor/classiebit/eventmie/resources/sass/vendor.scss')

<!-- Bootstrap RTL CSS only if langauge is RTL -->
@if (is_rtl())
<link rel="stylesheet" href="{{ eventmie_asset('css/bootstrap-rtl.min.css') }}">
@endif

<!-- New Themese Theme CSS -->
@Vite('vendor/classiebit/eventmie/resources/sass/theme.scss')

<!-- Custom CSS -->
<link rel="stylesheet" href="{{ eventmie_asset('css/theme-custom.css') }}">



{{-- Load third party plugins in seperate file (node modules) --}}
<script type="text/javascript" src="{{ eventmie_asset('js/manifest.js') }}"></script>
<script type="text/javascript" src="{{ eventmie_asset('js/vendor.js') }}"></script>

{{-- localization --}}
<script type="text/javascript" src="{{ route('eventmie.eventmie_lang') }}"></script>

{{-- Common Auth instance --}}
<script type="text/javascript" src="{{ eventmie_asset('js/auth.js') }}"></script>
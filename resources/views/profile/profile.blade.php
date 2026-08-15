@extends('eventmie::layouts.app')

@section('title')
    @lang('eventmie::em.profile')
@endsection

@section('content')
<section class="bg-light py-5 mt-8">
    <div class="container">
        <div class="row">
            <div class="col-xl-12 col-md-12 col-12">
                <div class="bg-gray-200 rounded-3 px-3 mb-2">
                    <ul class="nav nav-lb-tab text-center w-space">
                        <li class="nav-item">
                            <router-link class="nav-link" :to="{ name: 'personal-details' }">
                                @lang('eventmie::em.personal_details')
                                <i class="fas fa-exclamation-circle text-danger" v-if="!store.state.personal_details"></i>
                                <i class="fas fa-check-circle text-primary" v-else></i>
                            </router-link>
                        </li>
                        <li class="nav-item">
                            <router-link class="nav-link" :to="{ name: 'security' }">
                                @lang('eventmie::em.security')
                                <i class="fas fa-check-circle text-primary"></i>
                            </router-link>
                        </li>
                    </ul>
                </div>

                <div class="card border-0 shadow-sm">
                    <div class="card-body p-4">
                        <router-view>
                        </router-view>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>
@endsection

@section('javascript')
<script type="text/javascript">
    var user = {!! json_encode($user, JSON_UNESCAPED_SLASHES | JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_AMP) !!};
    var csrf_token = {!! json_encode(csrf_token(), JSON_UNESCAPED_SLASHES | JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_AMP) !!};

    // Get current storage disk from Laravel
    var storageDisk = {!! json_encode(getDisk(), JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_AMP) !!};

    // Properly set user avatar URL
    var avatarUrl = storageDisk === 's3' 
        ? {!! json_encode(getFile($user->avatar), JSON_UNESCAPED_SLASHES | JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_AMP) !!} 
        : `storage/${user.avatar}`;
</script>

@vite(['vendor/classiebit/eventmie/resources/js/profile/index.js']) 

@stop

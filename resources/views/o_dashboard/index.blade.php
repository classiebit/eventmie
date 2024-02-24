@extends('eventmie::layouts.app')

@section('content')
    @include('eventmie::o_dashboard.sidebar')
    <div id="db-wrapper">
        <div class="bg-light" id="page-content-for-mini">
            <section>
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12 py-1 mt-2">
                            <button type="button" id="nav-toggle" class="btn btn-sm bg-secondary rounded-circle"
                                onclick="clickToggle()">
                                <i class="fas fa-bars text-white"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
@endsection

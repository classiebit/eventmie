@extends('voyager::master')

@section('content')
    <div class="page-content custom-dashboard">
        
        @include('voyager::alerts')
        @include('voyager::dimmers')
    </div>
@stop
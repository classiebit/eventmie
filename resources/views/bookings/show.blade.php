@extends('eventmie::layouts.app')

@section('title')
    @lang('eventmie::em.booking_details')
@endsection

@section('content')
    <main>

        <section class="bg-light">

            <div class="container py-lg-5">

                <div class="row">
                    <div class="col-xl-6 col-lg-6 col-12">
                        <!-- Card -->
                        <div class="card border-0 shadow-sm">

                            <!-- Card body -->
                            <div class="card-body">
                                <div class="table-responsive">
                                    {{-- booking details --}}

                                    <h3 class="text-center bg-light p-3">@lang('eventmie::em.booking_info')</h3>
                                    <table class="table">
                                        <tr>
                                            <th>@lang('eventmie::em.order_id')</th>
                                            <td>{{ $booking['order_number'] }}</td>
                                        </tr>

                                        <tr>
                                            <th>@lang('eventmie::em.event_category')</th>
                                            <td>{{ $booking['event_category'] }}</td>
                                        </tr>

                                        <tr>
                                            <th>@lang('eventmie::em.event')</th>
                                            <td>{{ $booking['event_title'] }}</td>
                                        </tr>

                                        <tr>
                                            <th>@lang('eventmie::em.start_date')</th>
                                            <td>{{ userTimezone($booking['event_start_date'] . ' ' . $booking['event_start_time'], 'Y-m-d H:i:s', format_carbon_date(true)) }}
                                                {{ showTimezone() }}
                                            </td>
                                        </tr>

                                        <tr>
                                            <th>@lang('eventmie::em.end_date')</th>
                                            @if (userTimezone($booking['event_start_date'] . ' ' . $booking['event_start_time'], 'Y-m-d H:i:s', 'Y-m-d') <=
                                                userTimezone($booking['event_end_date'] . ' ' . $booking['event_end_time'], 'Y-m-d H:i:s', 'Y-m-d'))
                                                <td>{{ userTimezone($booking['event_end_date'] . ' ' . $booking['event_end_time'], 'Y-m-d H:i:s', format_carbon_date(true)) }}
                                                    {{ showTimezone() }}
                                                </td>
                                            @else
                                                <td>{{ userTimezone($booking['event_start_date'] . ' ' . $booking['event_start_time'], 'Y-m-d H:i:s', format_carbon_date(true)) }}
                                                    {{ showTimezone() }}
                                                </td>
                                            @endif
                                        </tr>

                                        <tr>
                                            <th>@lang('eventmie::em.start_time')</th>
                                            <td>
                                                {{ userTimezone($booking['event_start_date'] . ' ' . $booking['event_start_time'], 'Y-m-d H:i:s', format_carbon_date(false)) }}
                                                {{ showTimezone() }}
                                            </td>
                                        </tr>

                                        <tr>
                                            <th>@lang('eventmie::em.end_time')</th>
                                            <td>{{ userTimezone($booking['event_end_date'] . ' ' . $booking['event_end_time'], 'Y-m-d H:i:s', format_carbon_date(false)) }}
                                                {{ showTimezone() }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>@lang('eventmie::em.booking_date')</th>
                                            <td>{{ userTimezone($booking['created_at'], 'Y-m-d H:i:s', format_carbon_date(true)) }}
                                                {{ showTimezone() }}
                                            </td>
                                        </tr>

                                        <tr>
                                            <th>@lang('eventmie::em.booking_status')</th>
                                            <td><span
                                                    class="label label-success">{{ $booking['status'] == 0 ? 'Inactive' : 'Active' }}</span>
                                            </td>
                                        </tr>

                                
                                    </table>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-6 col-lg-6 col-12">
                        <!-- Card -->
                        <div class="card mb-4 border-0 shadow-sm">

                            <!-- Card body -->
                            <div class="card-body">
                                {{-- customer details --}}

                                <h3 class="text-center bg-light p-3">@lang('eventmie::em.customer_info')</h3>
                                <hr>
                                <table class="table table-hover">
                                    <tr>
                                        <th>@lang('eventmie::em.name')</th>
                                        <td>{{ $booking['customer_name'] }}</td>
                                    </tr>

                                    <tr>
                                        <th>@lang('eventmie::em.email')</th>
                                        <td>{{ $booking['customer_email'] }}</td>
                                    </tr>

                                </table>

                            </div>
                        </div>
                    </div>

                </div>


            </div>
        </section>



    </main>
@endsection

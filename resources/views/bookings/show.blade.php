@extends('eventmie::layouts.app')

@section('title')
    @lang('eventmie::em.booking') @lang('eventmie::em.details')
@endsection

@section('content')
<main>
    <div class="lgx-post-wrapper">
        <section>
            <div class="container">
                <div class="row">
                    
                    {{-- booking details --}}
                    <div class="col-md-6 table-responsive">
                        <h3>@lang('eventmie::em.booking') @lang('eventmie::em.info')</h3>
                        <table class="table table-striped table-hover">
                            <tr>
                                <th>@lang('eventmie::em.order') @lang('eventmie::em.id')</th>
                                <td>{{$booking['order_number']}}</td>
                            </tr>

                            <tr>
                                <th>@lang('eventmie::em.event') @lang('eventmie::em.category')</th>
                                <td>{{$booking['event_category']}}</td>
                            </tr>

                            <tr>
                                <th>@lang('eventmie::em.event')</th>
                                <td>{{$booking['event_title']}}</td>
                            </tr>

                            <tr>
                                <th>@lang('eventmie::em.total') @lang('eventmie::em.amount') @lang('eventmie::em.paid')</th>
                                <td>{{$booking['net_price']}}</td>
                            </tr>     
                            
                            <tr>
                                <th>@lang('eventmie::em.start') @lang('eventmie::em.date')</th>
                                <td>{{$booking['event_start_date']}}</td>
                            </tr>   

                            <tr>
                                <th>@lang('eventmie::em.end') @lang('eventmie::em.date')</th>
                                <td>{{$booking['event_end_date']}}</td>
                            </tr>   

                            <tr>
                                <th>@lang('eventmie::em.start') @lang('eventmie::em.time')</th>
                                <td>{{$booking['event_start_time']}}</td>
                            </tr>   

                            <tr>
                                <th>@lang('eventmie::em.end') @lang('eventmie::em.time')</th>
                                <td>{{$booking['event_end_time']}}</td>
                            </tr>   
                            <tr>
                                <th>@lang('eventmie::em.booking') @lang('eventmie::em.date')</th>
                                <td>{{ $booking['created_at'] }}</td>
                            </tr>   

                            <tr>
                                <th>@lang('eventmie::em.booking') @lang('eventmie::em.status')</th>
                                <td ><span class="label label-success">{{$booking['status'] == 0 ? 'Inactive' : 'Active'}}</span></td>
                            </tr>   

                        </table> 
                    </div>

                    {{-- customer details --}}
                    <div class="col-md-6 table-responsive">
                        <div class="row">
                            <div class="col-md-12">
                                <h3>@lang('eventmie::em.customer') @lang('eventmie::em.info')</h3>
                                <table class="table table-striped table-hover">
                                    <tr>
                                        <th>@lang('eventmie::em.name')</th>
                                        <td>{{$booking['customer_name']}}</td>
                                    </tr>

                                    <tr>
                                        <th>@lang('eventmie::em.email')</th>
                                        <td>{{$booking['customer_email']}}</td>
                                    </tr>

                                </table>
                            </div>
                        </div>
                        
                    </div>    
                    
                </div>    
            </div>
        </section>
    </div>
</main>
         
@endsection

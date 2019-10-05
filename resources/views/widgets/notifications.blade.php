<div class="panel widget center">
    <div class="dimmer"></div>
    <div class="panel-content">
        @if (isset($icon))<i class='{{ $icon }}'></i>@endif
        <h4>{!! $title !!}</h4>
        <p>{!! $text !!}</p>

        <div class="dropdown">
            <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                Notifications
                <span class="caret"></span>
            </button>
            <ul class="dropdown-menu dropdown-menu-center" aria-labelledby="dropdownMenu1">
                @foreach ($notifications as $notification) 
                <li>
                    <a href="{{ route('eventmie.notify_read', ['n_type' => $notification->n_type]) }}"> 
                        {{ $notification->total }}
                        {{ $notification->n_type }}
                    </a>
                </li>
                @endforeach
                <li role="separator" class="divider"></li>
            </ul>
        </div>
    </div>
</div>
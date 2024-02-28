@props(['url'])
<tr>
    <td class="header">
        <a href="{{ $url }}" style="display: inline-block;">
            @if (trim($slot) === 'Laravel')
                <img src="https://laravel.com/img/notification-logo.png" class="logo" alt="Laravel Logo">
            @else
                @if (config('app.env') === 'production')
                   <img src="{{config('app.url')}}/{{asset('assets/img/favicon.png')}}" class="logo" alt="Logo">
                @endif
                {{ $slot }}
            @endif
        </a>
    </td>
</tr>

<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Laravel')
<img src="https://laravel.com/img/notification-logo.png" class="logo" alt="Laravel Logo">
@else
<img src="{{ config('app.url') }}/images/logo-lang-ro.svg" alt="Un acoperiș" style="height: 40px">
{{--{{ $slot }}--}}
@endif
</a>
</td>
</tr>

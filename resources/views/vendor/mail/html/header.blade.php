<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Laravel')
<img src="{{ asset('img/icon.png') }}" class="logo" alt="Ahsan Logo">
@else
{{ $slot }}
@endif
</a>
</td>
</tr>

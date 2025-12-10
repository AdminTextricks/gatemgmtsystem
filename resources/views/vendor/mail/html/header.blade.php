@props(['url'])
<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Laravel')
Gate Management System
@else
{{ $slot }}
@endif
</a>
</td>
</tr>

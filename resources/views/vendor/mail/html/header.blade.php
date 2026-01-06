@props(['url'])

@php
    $brandName = config('branding.name', config('app.name', 'Laravel'));
@endphp

<tr>
    <td class="header" style="padding: 32px 0; text-align: center;">
        <a href="{{ $url }}" style="display: inline-flex; align-items: center; gap: 12px; color: #0b1220; font-size: 18px; font-weight: 600; text-decoration: none;">
            <span style="display: inline-flex; height: 36px; width: 36px; align-items: center; justify-content: center; border-radius: 999px; background: #0b1220; color: #ffffff;">
                {{ strtoupper(substr($brandName, 0, 1)) }}
            </span>
            <span>{{ $brandName }}</span>
        </a>
    </td>
</tr>

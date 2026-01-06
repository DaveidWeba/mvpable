@php
    $brandName = config('branding.name', config('app.name', 'Laravel'));
    $supportEmail = config('branding.support.email');
@endphp

<tr>
    <td class="footer" style="padding: 32px 0; text-align: center;">
        <p style="margin: 0; font-size: 12px; line-height: 1.6; color: #64748b;">
            {{ $brandName }}
            @if ($supportEmail)
                - <a href="mailto:{{ $supportEmail }}" style="color: #64748b; text-decoration: none;">{{ $supportEmail }}</a>
            @endif
        </p>
    </td>
</tr>

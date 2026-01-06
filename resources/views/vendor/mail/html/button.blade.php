@props(['url', 'color' => 'primary'])

<table align="center" width="100%" cellpadding="0" cellspacing="0" role="presentation">
    <tr>
        <td align="center">
            <table border="0" cellpadding="0" cellspacing="0" role="presentation">
                <tr>
                    <td>
                        <a href="{{ $url }}" style="display: inline-block; border-radius: 999px; background: #0b1220; color: #ffffff; font-size: 14px; font-weight: 600; line-height: 1; padding: 14px 24px; text-decoration: none;">
                            {{ $slot }}
                        </a>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>

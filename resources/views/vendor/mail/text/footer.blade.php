@php
    $brandName = config('branding.name', config('app.name', 'Laravel'));
    $supportEmail = config('branding.support.email');
@endphp

{{ $brandName }}@if ($supportEmail) - {{ $supportEmail }}@endif

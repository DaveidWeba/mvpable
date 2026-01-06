@php
    $brandName = config('branding.name', config('app.name', 'Laravel'));
@endphp

{{ $brandName }}


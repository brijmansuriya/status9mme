<div>
    @push('css')
    <link rel="stylesheet" href="{{ asset('web/css/social-media-share-buttons.css') }}">
    @endpush
    {!! Share::page(url()->current(), 'Check out this amazing post!')->facebook()->twitter()->linkedin()->whatsapp()->telegram()->reddit() !!}
</div>

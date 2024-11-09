@yield('css')
<meta charset="utf-8">
<meta content="width=device-width, initial-scale=1.0" name="viewport">

<!-- Time Meta Tag -->
<meta name="time" content="{{ now()->toDateTimeString() }}">
<!-- Logo Meta Tag -->
<meta property="og:image" content="{{ asset('web/img/status9mme-Logo.png') }}" />

@yield('meta')
<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-P553KKW1VX"></script>
<script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
        dataLayer.push(arguments);
    }
    gtag('js', new Date());

    gtag('config', 'G-P553KKW1VX');
</script>
<!-- Favicon -->
<link href="{{ asset('web/img/favicon.ico') }}" rel="icon">
<!-- Google Web Fonts -->
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">
<!-- Font Awesome -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.0/css/all.min.css" rel="stylesheet">
<!-- Libraries Stylesheet -->
<link href="{{ asset('web/lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">
<!-- Customized Bootstrap Stylesheet -->
<link href="{{ asset('web/css/style.css') }}" rel="stylesheet">
<meta name="p:domain_verify" content="b966a68636b5f65c2b6ac4926d1205cb" />
<style>
    .h-200 {
        height: 200px;
    }

    a {
        text-decoration: none !important;
    }

    a:hover {
        /* color: white; */
        text-decoration: none !important;
        cursor: pointer;
    }

    .logo {
        font-size: 34px;
        font-weight: 800;
    }
</style>

<!DOCTYPE html>
<html lang="en">

<head>
   @include('web.includes.head')
</head>

<body>
    @include('web.includes.topbar')
    @yield('content')
    @include('web.includes.footer')
    @include('web.includes.script')
</body>

</html>
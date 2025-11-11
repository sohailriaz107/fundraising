<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    {{-- Styles --}}
    <link rel="stylesheet" href="{{ asset('assets/admin/css/styles.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />

    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <title>@yield('title', 'Admin Dashboard')</title>
    <link rel="icon" href="{{ asset('assets/images/fav.png') }}" type="image/png">
</head>
<body class="sb-nav-fixed">

    {{-- Top Navbar --}}
    @include('layouts.admin.nav')

    <div id="layoutSidenav">
        {{-- Sidebar --}}
        <div >
            @include('layouts.admin.sidebar')
        </div>

        {{-- Content Area --}}
        <div id="layoutSidenav_content">
            <main class="p-3">
                @yield('content')
            </main>
            @include('layouts.admin.footer')
        </div>
    </div>

    {{-- Scripts --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        crossorigin="anonymous"></script>
    <script src="{{ asset('assets/admin/js/scripts.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js"
        crossorigin="anonymous"></script>
    <!-- <script src="{{ asset('assets/admin/js/chart-area-demo.js') }}"></script>
    <script src="{{ asset('assets/admin/js/chart-bar-demo.js') }}"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js"
        crossorigin="anonymous"></script>
    <script src="{{ asset('assets/admin/js/datatables-simple-demo.js') }}"></script>

</body>
</html>

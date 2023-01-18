<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Title -->
    <title>Dashboard | @yield('title')</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    @include('admin.layouts._inc.css')
</head>

<body class="has-sidebar has-fixed-sidebar-and-header">
<!-- Header -->
@include('admin.layouts._inc.header')
<!-- End Header -->

<main class="main">
    <!-- Sidebar Nav -->
    @include('admin.layouts._inc.menu')
    <!-- End Sidebar Nav -->
    <div class="content">
    @yield('content')

        <!-- Footer -->
        @include('admin.layouts._inc.footer')
        <!-- End Footer -->
    </div>
</main>


@include('admin.layouts._inc.script')
</body>
</html>

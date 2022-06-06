<!DOCTYPE html>
<html lang="en">

<head>
    @include('partial.head')
</head>

<body>

    @include('partial.sidebar')
    <div class="container">
        @yield('content')
    </div>
    @include('partial.script')
</body>

</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car Sales</title>
</head>
<body class="sb-nav-fixed">
    @include('layouts.partials.navbar')

    <div id="layoutSidenav">

        <div id="layoutSidenav_nav">
            @include('layouts.partials.sidebar')
        </div>

        <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <!-- @include('main') -->
                    </div>
                </main>
            </div>

        </div>

</body>
</html>
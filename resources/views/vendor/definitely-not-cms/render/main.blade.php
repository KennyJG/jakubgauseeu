<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CMS</title>
    <style>{!! $styles !!}</style>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
</head>
<body class="body">
    @yield('content')
</body>
<script>
    $(document).ready(function() {
        var height = $("#navbar").height();
        if (height > 0) {
            $("#content").css("margin-top", height);
        }
    });
</script>
</html
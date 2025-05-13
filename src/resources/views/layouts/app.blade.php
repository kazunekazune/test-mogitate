<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'mogitate')</title>
    <style>
        body {
            background: #f7f7f7;
            margin: 0;
            font-family: 'Segoe UI', 'Meiryo', sans-serif;
        }

        .header {
            background: #fff;
            border-bottom: 1px solid #eee;
            padding: 16px 32px;
            font-size: 1.5em;
            color: #f7b500;
            font-family: 'Arial Rounded MT Bold', Arial, sans-serif;
        }

        .container {
            padding: 0 16px;
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.03);
        }
    </style>
    @yield('head')
</head>

<body>
    <div class="header">
        mogitate
    </div>
    <div class="container">
        @yield('content')
    </div>
</body>

</html>
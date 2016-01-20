<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Untitled Page') - Sportschool</title>
    <link href='https://fonts.googleapis.com/css?family=Bangers' rel='stylesheet' type='text/css'>
    <link href="<?= elixir('css/all.css') ?>" rel="stylesheet" type="text/css">
</head>
<body>
<div class="container">
    <div class="row header">
        <h1>Sportschool</h1>
    </div>
    @include('_nav')
    @yield('content')
</div>
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="<?= elixir('js/all.js') ?>"></script>
@yield('scripts')
</body>
</html>
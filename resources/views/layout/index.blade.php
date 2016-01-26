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
<script type="text/javascript">
    var _paq = _paq || [];
    _paq.push(['trackPageView']);
    _paq.push(['enableLinkTracking']);
    (function() {
        var u="//stats.bcome.nl/";
        _paq.push(['setTrackerUrl', u+'s.php']);
        _paq.push(['setSiteId', 5]);
        var d=document, g=d.createElement('script'), s=d.getElementsByTagName('script')[0];
        g.type='text/javascript'; g.async=true; g.defer=true; g.src=u+'s.js'; s.parentNode.insertBefore(g,s);
    })();
</script>
<noscript><p><img src="//stats.bcome.nl/piwik.php?idsite=5" style="border:0;" alt="" /></p></noscript>
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="<?= elixir('js/all.js') ?>"></script>
@yield('scripts')
</body>
</html>
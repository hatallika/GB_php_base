<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?=$title?></title>
    <link rel="stylesheet" type="text/css" href="/css/style_gallery.css?<?=rand(1,22232)?>"/>
    <link rel="stylesheet" href="/css/style.css?<?=rand(1,22232)?>">
    <script type="text/javascript" src="/scripts/jquery-1.4.3.min.js"></script>
    <script type="text/javascript" src="/scripts/fancybox/jquery.mousewheel-3.0.4.pack.js"></script>
    <script type="text/javascript" src="/scripts/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
    <link rel="stylesheet" type="text/css" href="/scripts/fancybox/jquery.fancybox-1.3.4.css" media="screen" />
    <!--<script type="text/javascript">
        $(document).ready(function(){
            $("a.photo").fancybox({
                transitionIn: 'elastic',
                transitionOut: 'elastic',
                speedIn: 500,
                speedOut: 500,
                hideOnOverlayClick: false,
                titlePosition: 'over'
            });	}); </script> -->

</head>



<body>
<div id="main">
    <?=$menu?>
    <?=$content?>
</div>
</body>
</html>
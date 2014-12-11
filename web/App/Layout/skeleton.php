<html>
<head>
    <base href="http://<?php echo MFW_Config::getConfig('main')->base_href ?>">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SpapajMa - obedové menu vždy poruke</title>
    <link href='http://fonts.googleapis.com/css?family=Ubuntu:300&subset=latin,latin-ext' rel='stylesheet'
          type='text/css'>
    <?php echo $V->arrayToHtml($V->getResources('css'), '<link href="#0#" media="all" rel="stylesheet" type="text/css" />', false); ?>
    <?php echo $V->arrayToHtml($V->getResources('js'), '<script src="#0#" type="text/javascript"></script>', false); ?>
</head>
<body>

<!--[if lt IE 9]>
<script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
<![endif]-->

<div id="page_container">
    <div id="top_bar">
        <div id="header_container" class="containers">

            <!-- @header_content@ -->

        </div>
    </div>

    <div id="middle_bar">
        <div id="content_container" class="containers">

            <!-- @main_content@ -->

        </div>
    </div>

    <div id="bottom_bar">
        <div id="footer_container" class="containers">

            <!-- @footer_content@ -->

        </div>
    </div>
</div>

</body>
</html>
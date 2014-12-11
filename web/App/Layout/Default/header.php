<html>
<head>
    <base href="http://<?php echo MFW_Config::getConfig('main')->base_href ?>">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>SpapajMa - obedové menu vždy poruke</title>
    <link href='http://fonts.googleapis.com/css?family=Ubuntu:300&subset=latin,latin-ext' rel='stylesheet'
          type='text/css'>
    <?php echo $V->arrayToHtml($V->getResources('css'), '<link href="#0#" media="all" rel="stylesheet" type="text/css" />', false); ?>
    <?php echo $V->arrayToHtml($V->getResources('js'), '<script src="#0#" type="text/javascript"></script>', false); ?>
</head>
<body>

<div id="page_container">
    <div id="top_bar">
        <div id="header_container" class="containers">
            <form action="/login" method="post">
                <input type="text" name="login_name" class="text_field"/>
                <input type="password" name="password" class="text_field"/>
                <input type="submit" value="Prihlásiť" class="button">
            </form>
        </div>
    </div>

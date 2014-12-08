<h1><?php echo $V->titulok ?></h1>
<p><?php echo $V->clanok ?></p>
<p>LUDIA: <?php echo $V->arrayToHtml($V->ludia, '<p>Vek: #vek#, meno: #meno#</p>', true) ?></p>
<p>LUDIA non associative: <?php echo $V->arrayToHtml($V->ludia, '<p>Vek: #1#, meno: #0#</p>') ?></p>

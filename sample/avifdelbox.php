<?php

if (is_readable('vendor/autoload.php')) {
    require 'vendor/autoload.php';
} else {
    require_once 'IO/AVIF.php';
}

$options = getopt("f:t:d");

if ((isset($options['f']) === false) || (is_readable($options['f']) === false) || (isset($options['t']) === false)) {
    fprintf(STDERR, "Usage: php avifdelbox.php -f <avif_file> -t <typelist> [-d]\n");
    fprintf(STDERR, "ex) php avifdelbox.php -f test.avif -t iinf,iref\n");
    exit(1);
}

$filename = $options['f'];
$avifdata = file_get_contents($filename);
$removeTypeList = explode(",", $options['t']);

$opts = array();
if (isset($options['d'])) {
    $opts['debug'] = true;
}


$avif = new IO_AVIF();
try {
    $avif->parse($avifdata, $opts);
} catch (Exception $e) {
    echo "ERROR: avifdump: $filename:".PHP_EOL;
    echo $e->getMessage()." file:".$e->getFile()." line:".$e->getLine().PHP_EOL;
    echo $e->getTraceAsString().PHP_EOL;
    exit (1);
}

$avif->removeBoxByType($removeTypeList, $opts);
echo $avif->build($opts);

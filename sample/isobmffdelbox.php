<?php

if (is_readable('vendor/autoload.php')) {
    require 'vendor/autoload.php';
} else {
    require_once 'IO/ISOBMFF.php';
}

$options = getopt("f:t:d");

if ((isset($options['f']) === false) || (is_readable($options['f']) === false) || (isset($options['t']) === false)) {
    fprintf(STDERR, "Usage: php isobmffdelbox.php -f <isobmff_file> -t <typelist> [-d]\n");
    fprintf(STDERR, "ex) php isobmffdelbox.php -f test.heic -t iinf,iref\n");
    exit(1);
}

$filename = $options['f'];
$isobmffdata = file_get_contents($filename);
$removeTypeList = explode(",", $options['t']);

$opts = array();
if (isset($options['d'])) {
    $opts['debug'] = true;
}


$isobmff = new IO_ISOBMFF();
try {
    $isobmff->parse($isobmffdata, $opts);
} catch (Exception $e) {
    echo "ERROR: isobmffdump: $filename:".PHP_EOL;
    echo $e->getMessage()." file:".$e->getFile()." line:".$e->getLine().PHP_EOL;
    echo $e->getTraceAsString().PHP_EOL;
    exit (1);
}

$isobmff->removeBoxByType($removeTypeList, $opts);
echo $isobmff->build($opts);

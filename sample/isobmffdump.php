<?php

if (is_readable('vendor/autoload.php')) {
    require 'vendor/autoload.php';
} else {
    require_once 'IO/ISOBMFF.php';
}

$options = getopt("f:hvtdR");

if ((isset($options['f']) === false) || (($options['f'] !== "-") && is_readable($options['f']) === false)) {
    fprintf(STDERR, "Usage: php isobmffdump.php -f <isobmff_file> [-htvd]\n");
    fprintf(STDERR, "ex) php isobmffdump.php -f test.heic -t \n");
    exit(1);
}

$filename = $options['f'];
if ($filename === "-") {
    $filename = "php://stdin";
}
$isobmffdata = file_get_contents($filename);

$opts = array();

if (isset($options['h'])) {
    $opts['hexdump'] = true;
}
if (isset($options['t'])) {
    $opts['typeonly'] = true;
}
if (isset($options['v'])) {
    $opts['verbose'] = true;
}
if (isset($options['d'])) {
    $opts['debug'] = true;
}
if (isset($options['r'])) {
    $opts['restrict'] = true;
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

$isobmff->dump($opts);

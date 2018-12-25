<?php

if (is_readable('vendor/autoload.php')) {
    require 'vendor/autoload.php';
} else {
    require_once 'IO/AVIF.php';
}

$options = getopt("f:p:d");

if ((isset($options['f']) === false) || (is_readable($options['f']) === false) || (isset($options['p']) === false) || (is_readable($options['p']) === false) ) {
    fprintf(STDERR, "Usage: php avifaddicpp.php -f <avif_file> -p <iccp_profile> [-d]\n");
    fprintf(STDERR, "ex) php avifaddiccp.php -f test.avif -p sRGB.icc\n");
    exit(1);
}

$filename = $options['f'];
$avifdata = file_get_contents($filename);
$iccfilename = $options['p'];
$iccpdata = file_get_contents($iccfilename);

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

$avif->appendICCProfile($iccpdata);
echo $avif->build($opts);

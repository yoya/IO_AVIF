<?php

if (is_readable('vendor/autoload.php')) {
    require 'vendor/autoload.php';
} else {
    require_once 'IO/ISOBMFF.php';
}

$options = getopt("f:p:d");

if ((isset($options['f']) === false) || (is_readable($options['f']) === false) || (isset($options['p']) === false) || (is_readable($options['p']) === false) ) {
    fprintf(STDERR, "Usage: php isobmffaddicpp.php -f <isobmff_file> -p <iccp_profile> [-d]\n");
    fprintf(STDERR, "ex) php isobmffaddiccp.php -f test.heic -p sRGB.icc\n");
    exit(1);
}

$filename = $options['f'];
$isobmffdata = file_get_contents($filename);
$iccfilename = $options['p'];
$iccpdata = file_get_contents($iccfilename);

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

$isobmff->appendICCProfile($iccpdata);
echo $isobmff->build($opts);

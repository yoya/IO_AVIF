<?php

if (is_readable('vendor/autoload.php')) {
    require 'vendor/autoload.php';
} else {
    require_once 'IO/ISOBMFF.php';
}

$options = getopt("f:");

if (! isset($options['f'])) {
    fprintf(STDERR, "Usage: php isobmfftree.php -f <isobmff_file>\n");
    fprintf(STDERR, "ex) php isobmfftree.php -f input.heic\n");
    exit(1);
}


$filename = $options['f'];
if ($filename === "-") {
    $filename = "php://stdin";
}
$isobmffdata = file_get_contents($filename);
$opts = array();

$isobmff = new IO_ISOBMFF();

try {
    $isobmff->parse($isobmffdata, $opts);
} catch (Exception $e) {
    echo "ERROR: isobmfftree: $filename:".PHP_EOL;
    echo $e->getMessage()." file:".$e->getFile()." line:".$e->getLine().PHP_EOL;
    echo $e->getTraceAsString().PHP_EOL;
    exit (1);
}

$isobmff->tree();

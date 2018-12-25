<?php

if (is_readable('vendor/autoload.php')) {
    require 'vendor/autoload.php';
} else {
    require_once 'IO/AVIF.php';
}

$options = getopt("f:");

if (! isset($options['f'])) {
    fprintf(STDERR, "Usage: php aviftree.php -f <avif_file>\n");
    fprintf(STDERR, "ex) php aviftree.php -f input.avif\n");
    exit(1);
}


$filename = $options['f'];
if ($filename === "-") {
    $filename = "php://stdin";
}
$avifdata = file_get_contents($filename);
$opts = array();

$avif = new IO_AVIF();

try {
    $avif->parse($avifdata, $opts);
} catch (Exception $e) {
    echo "ERROR: aviftree: $filename:".PHP_EOL;
    echo $e->getMessage()." file:".$e->getFile()." line:".$e->getLine().PHP_EOL;
    echo $e->getTraceAsString().PHP_EOL;
    exit (1);
}

$avif->tree();

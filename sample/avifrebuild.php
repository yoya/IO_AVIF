<?php

if (is_readable('vendor/autoload.php')) {
    require 'vendor/autoload.php';
} else {
    require_once 'IO/AVIF.php';
}

$options = getopt("f:");

if ((isset($options['f']) === false) || (is_readable($options['f']) === false)) {
    fprintf(STDERR, "Usage: php avifrebuild.php -f <avif_file> [-h]\n");
    fprintf(STDERR, "ex) php avifrebuild.php -f test.avif\n");
    exit(1);
}

$filename = $options['f'];
$avifdata = file_get_contents($filename);

$avif = new IO_AVIF();
try {
    $avif->parse($avifdata);
} catch (Exception $e) {
    echo "ERROR: avifrebuild: $filename:".PHP_EOL;
    echo $e->getMessage()." file:".$e->getFile()." line:".$e->getLine().PHP_EOL;
    echo $e->getTraceAsString().PHP_EOL;
    exit (1);
}


echo $avif->build();

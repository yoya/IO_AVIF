<?php

if (is_readable('vendor/autoload.php')) {
    require 'vendor/autoload.php';
} else {
    require_once 'IO/ISOBMFF.php';
}

$options = getopt("f:");

if ((isset($options['f']) === false) || (is_readable($options['f']) === false)) {
    fprintf(STDERR, "Usage: php isobmffrebuild.php -f <isobmff_file> [-h]\n");
    fprintf(STDERR, "ex) php isobmffrebuild.php -f test.heic\n");
    exit(1);
}

$filename = $options['f'];
$isobmffdata = file_get_contents($filename);

$isobmff = new IO_ISOBMFF();
try {
    $isobmff->parse($isobmffdata);
} catch (Exception $e) {
    echo "ERROR: isobmffrebuild: $filename:".PHP_EOL;
    echo $e->getMessage()." file:".$e->getFile()." line:".$e->getLine().PHP_EOL;
    echo $e->getTraceAsString().PHP_EOL;
    exit (1);
}


echo $isobmff->build();

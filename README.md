IO_AVIF [![Travis Build Status](https://travis-ci.org/yoya/IO_AVIF.svg?branch=master)](https://travis-ci.org/yoya/IO_AVIF)
======

AVIF binary perser dumper, converter, powered by PHP.
bidirectional converter with AVIF

# install

```
% composer require yoya/io_avif
```

# require

- IO_Bit
 - https://github.com/yoya/IO_Bit
- IO_ISOBMFF
 - https://github.com/yoya/IO_ISOBMFF

## script (sample/*.php)

- avifdump.php

```
% php vendor/yoya/io_avif/sample/avifdump.php -f input.avif
|
type:ftyp(offset:0 len:32):File Type and compatibility
  major:avif minor:0  alt:mif1, avif, miaf, MA1B
|
type:meta(offset:32 len:304):Information about items
  version:0 flags:0
|-  type:hdlr(offset:44 len:33):Handler reference
      version:0 flags:0
      componentType:^@^@^@^@
      componentSubType:pict
      componentManufacturer:^@^@^@^@
      componentFlags:0
      componentFlagsMask:0
      componentName:^@
(omit...)
```

- aviftree.php

```
% php vendor/yoya/io_avif/sample/aviftree.php -f input.avif
Props:
[1]: ispe width:1280 height:720
[2]: colr subtype:nclx
[3]: av1C
[4]: pixi channels:8,8,8
Items:
[1]: pitm type:av01 ref:0 offset:408 length:57105
     [1?]ispe:1280,720 [2?]colr:nclx [3]av1C [4?]pixi:8,8,8
[2]: cdsc:1 type:Exif ref:0 offset:57513 length:124
```

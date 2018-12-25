IO_ISOBMFF
======

ISOBMFF binary perser dumper, converter, powered by PHP.
bidirectional converter with ISOBMFF

# install

```
% composer require yoya/io_isobmff
```

# require

- IO_Bit
 - https://github.com/yoya/IO_Bit
- IO_ICC
 - https://github.com/yoya/IO_ICC

## script (sample/*.php)

- isobmffdump.php

```
% php vendor/yoya/io_isobmff/sample/isobmffdump.php -f input.heic
type:ftyp(offset:0 len:24):File Type and Compatibility
  major:mif1 minor:0  alt:mif1, heic
type:mdat(offset:24 len:139682):Media Data
  _mdatId:557184717
  _offsetRelative:8
  _itemID:1
type:meta(offset:139706 len:328):Information about items
  version:0 flags:0
    type:hdlr(offset:139718 len:53):Handler reference
      version:0 flags:0
      componentType:
      componentSubType:pict
(omit...)
```

- isobmfftree.php

```
% php vendor/yoya/io_isobmff/sample/isobmfftree.php -f input.heic
Props:
[1]: colr subtype:prof
[2]: hvcC profile:3 level:90 chroma:1
[3]: ispe width:512 height:512
(omit...)
Items:
[1]: dimg from:49 type:hvc1 method:0 ref:0 offset:28986 length:13529
[2]: dimg from:49 type:hvc1 method:0 ref:0 offset:42515 length:20507
(omit...)
[48]: dimg from:49 type:hvc1 method:0 ref:0 offset:804455 length:14580
[49]: pitm type:grid method:1 ref:0 offset:0 length:8
[50]: thmb from:49 type:hvc1 method:0 ref:0 offset:3995 length:22809
[51]: cdsc from:49 type:Exif method:0 ref:0 offset:26804 length:2182
```

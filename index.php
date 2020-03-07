<?php

declare(strict_types=1);

error_reporting(E_ALL);
ini_set('display_errors', 'on');

require __DIR__ . '/vendor/autoload.php';

use Cache\FileCache;
use Cache\StaticCache;

(new StaticCache)->set('test1', null);
(new StaticCache)->set('test2', '2');
(new StaticCache)->set('test3', '3', 1);

var_dump(
    (new StaticCache)->get('test0'),
    (new StaticCache)->get('test1'),
    (new StaticCache)->get('test2'),
    (new StaticCache)->get('test3')
);

sleep(1);

var_dump(
    (new StaticCache)->get('test0'),
    (new StaticCache)->get('test1'),
    (new StaticCache)->get('test2'),
    (new StaticCache)->get('test3')
);

$fileCache = new FileCache(__DIR__ . '/data');

$fileCache->set('test5', null);
$fileCache->set('test6', '6');
$fileCache->set('test7', '7', 1);

var_dump(
    $fileCache->get('test4'),
    $fileCache->get('test5'),
    $fileCache->get('test6'),
    $fileCache->get('test7')
);

sleep(1);

var_dump(
    $fileCache->get('test4'),
    $fileCache->get('test5'),
    $fileCache->get('test6'),
    $fileCache->get('test7')
);

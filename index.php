<?php

declare(strict_types=1);

error_reporting(E_ALL);
ini_set('display_errors', 'on');
define('DATA_DIRECTORY', __DIR__ . DIRECTORY_SEPARATOR . 'data');

require __DIR__ . DIRECTORY_SEPARATOR . 'vendor' .
    DIRECTORY_SEPARATOR . 'autoload.php';

use Cache\Cache;
use Cache\FileCache;
use Cache\StaticCache;

try {
    (new StaticCache())->set('test1', null);
    (new StaticCache())->set('test2', '2');
    (new StaticCache())->set('test3', '3', 2);

    var_dump(
        (new StaticCache())->get('test0'),
        (new StaticCache())->get('test1'),
        (new StaticCache())->get('test2'),
        (new StaticCache())->get('test3')
    );

    sleep(1);

    var_dump(
        (new StaticCache())->get('test0'),
        (new StaticCache())->get('test1'),
        (new StaticCache())->get('test2'),
        (new StaticCache())->get('test3')
    );

    $fileCache = new FileCache(DATA_DIRECTORY);

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

    $cache = new Cache(DATA_DIRECTORY);

    echo 'Cache tests:', PHP_EOL;

    var_dump(
        $cache->get('test0'),
        $cache->get('test1'),
        $cache->get('test2'),
        $cache->get('test3'),
        $cache->get('test4'),
        $cache->get('test5'),
        $cache->get('test6'),
        $cache->get('test7'),
    );
} catch (Exception $exception) {
    echo $exception->getMessage(), PHP_EOL,
    $exception->getTraceAsString(), PHP_EOL;
}

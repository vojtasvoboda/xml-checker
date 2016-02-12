<?php

use Symfony\Component\Debug\Debug;
use Symfony\Component\ClassLoader\ClassLoader;

// class loader
$loader = new ClassLoader();
$loader->addPrefixes([
    '' => __DIR__ . '/../validators'
]);
$loader->register();

// bootstrap
Debug::enable();
<?php

use Symfony\Component\Yaml\Parser;

include_once 'vendor/autoload.php';
include_once 'bootstrap/app.php';

// read config
$yamlParser = new Parser();
$config = $yamlParser->parse(file_get_contents('config/config.yml'));

// settings
$feedUrl = $config['checker']['feedUrl'];
$maxItems = $config['checker']['maxItems'];
$validatorType = $config['checker']['type'];

// validator
$validatorName = ucfirst($validatorType) . 'Validator';
$validator = new $validatorName;

// crawle feed
$xml = new SimpleXMLElement(file_get_contents($feedUrl));

// iterate items
$index = 0;
$errors = [];
try {
    foreach($xml as $item) {
        $errors = array_merge($errors, $validator->validateItem($item));
        if ($index++ >= $maxItems) {
            break;
        }
    }

} catch(Exception $e) {
    dump($e);
}

// print errors
foreach($errors as $error) {
    echo $error . '<br />';
}

echo '<br />';
exit('Check done.');
<?php

define('ROOT', dirname(__FILE__));
require_once(ROOT . '/vendor/autoload.php');

$path = readline("path: ");
try {
    $dataMaker = new DataMaker($path);
    $data = $dataMaker->getAllFiles();

    $initSearch = new DuplicateSearch($data);
    $initSearch->selectProvider(new HashProvider());
    $duplicates = $initSearch->search();

    $pathToResult = getcwd() . DIRECTORY_SEPARATOR . 'duplicate.txt';
    if (file_exists($pathToResult)) {
        unlink($pathToResult);
    }

    $this->result = $pathToResult;

    foreach ($duplicates as $pathArr) {
        try {
            $pathToResult = getcwd() . DIRECTORY_SEPARATOR . 'duplicate.txt';
            if (file_exists($pathToResult)) {
                unlink($pathToResult);
            }
            file_put_contents($pathToResult, $pathArr . PHP_EOL, FILE_APPEND);
        } catch (\Exception $e) {
            throw new \Error('Cant write in to file ' . $this->result . '');
        }
    }
    print_r('check here: ' . $pathToResult . '');
} catch (\Exception $e) {
    print_r($e->getMessage());
}

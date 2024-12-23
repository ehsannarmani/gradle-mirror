<?php

error_reporting(E_ERROR);

require_once "functions.php";
require_once "config.php";

$requestUri = $_SERVER['REQUEST_URI'];
$scriptName = dirname($_SERVER['SCRIPT_NAME']);

$relativePath = $requestUri;

if ($scriptName != '/'){
    $relativePath = str_replace($scriptName, '', $requestUri);
}

$dependencyPath = ltrim($relativePath, '/');

$repositoriesNames = array_keys($config['repositories']);

$requestedRepositoryName = startsWithArrayItem($dependencyPath,$repositoriesNames);

if ($requestedRepositoryName){
    // filtered mirror (use specific repository)
    $dependencyPath = str_replace($requestedRepositoryName.'/','',$dependencyPath);
    doMirror($requestedRepositoryName,$dependencyPath);
}else{
    foreach (array_keys($config['repositories']) as $repository) {
        doMirror($repository,$dependencyPath);
    }
}
dependencyNotFound();





<?php

require_once "functions.php";
require_once "config.php";

$requestUri = $_SERVER['REQUEST_URI'];
$scriptName = dirname($_SERVER['SCRIPT_NAME']);

$relativePath = str_replace($scriptName, '', $requestUri);
$dependencyPath = ltrim($relativePath, '/');

foreach ($config['repositories'] as $repository) {
    $dependencyUrl = "$repository/$dependencyPath";
    $downloadedDependency = downloadDependency($dependencyUrl);
    if ($downloadedDependency){
        returnDependency($downloadedDependency);
        exit();
    }
}
dependencyNotFound();





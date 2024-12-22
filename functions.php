<?php
require_once "config.php";

function downloadDependency($url)
{
    global $config;

    $cacheFolderName = $config['cache_folder'];
    $cacheFolder = __DIR__ . "/" . $cacheFolderName;
    $fileName = basename($url);
    $dir = $cacheFolderName . "/" . $fileName;

    $cachedFilePath = $cacheFolder . '/' . $fileName;
    $headersPath = $cacheFolder . '/' . $fileName.'.headers';

    if (file_exists($dir)){
        $headers = file_get_contents($headersPath);
        return [
            'path'=>$dir,
            'headers'=>$headers
        ];
    }

    if (!is_dir($cacheFolder)) {
        mkdir($cacheFolder, 0777, true);
    }



    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_HEADER, true);

    $response = curl_exec($ch);
    $header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
    $headers = substr($response, 0, $header_size);
    $fileContents = substr($response, $header_size);

    if (curl_errno($ch)) {
        return null;
    }
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

    if ($httpCode < 200 || $httpCode > 299){
        echo "$httpCode for $url <br/>";
        return null;
    }

    curl_close($ch);

    if (file_put_contents($cachedFilePath, $fileContents) === false) {
        return null;
    }else{
        file_put_contents($headersPath,$headers);
    }

    return [
        'path'=>$cacheFolderName . "/" . $fileName,
        'headers'=>$headers
    ];
}

function returnDependency($dependency)
{
    global $config;

    $path = $dependency['path'];
    $headers = explode("\n",$dependency['headers']);
    if (file_exists($path)) {
        foreach ($headers as $header) {
            header($header);
        }
        ob_clean();
        flush();
        readfile($path);
        if (!$config['cache_dependencies']){
            unlink($path);
            unlink($path.".headers");
        }
        exit;
    } else {
        dependencyNotFound();
    }
}

function dependencyNotFound()
{
    http_response_code(404);
    echo "Dependency not found.";
}

function startsWithArrayItem($target,array $array)
{
    $result = false;
    foreach ($array as $item) {
        if (strpos($target,$item) === 0){
            $result = $item;
        }
    }
    return $result;
}

function doMirror($repository,$dependency)
{
    global $config;

    if (!trim($dependency)) exit();
    $repository = $config['repositories'][$repository];

    $dependencyUrl = "$repository/$dependency";
    $downloadedDependency = downloadDependency($dependencyUrl);
    if ($downloadedDependency){
        returnDependency($downloadedDependency);
        exit();
    }
}

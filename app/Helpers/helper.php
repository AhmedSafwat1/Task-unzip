<?php

use Illuminate\Support\Facades\File;

if (!function_exists('active_menu')) {
    function active_menu($routeNames)
    {

        $routeNames = (array) $routeNames;
        foreach ($routeNames as $routeName) {
            if (str_contains(Route::currentRouteName(), $routeName)) {
                return 'active';
            }
        }
        return  "";
    }
}

if (!function_exists('uploadResource')) {
    function uploadResource($resource, $folderName = "global")
    {

        $path =  $resource->store($folderName);
        return $path;
    }
}

if (!function_exists('deleteFolder')) {
    function deleteFolder($folder)
    {
        File::deleteDirectory(getFullPath($folder));
    }
}

if (!function_exists('deleteFolder')) {
    function deleteResource($resourcePath)
    {
        File::deleteDirectory(getFullPath($resourcePath));
    }
}


if (!function_exists('getFileName')) {
    function getFileName($resource)
    {
        $originalName = $resource->getClientOriginalName();
        return explode('.', $originalName)[0];
    }
}

if (!function_exists('createFolder')) {
    function createFolder($name)
    {
        $path = getFullPath($name);
        if (!File::exists($path)) {
            File::makeDirectory($path, 0755, true);
        }
    }
}

if (!function_exists('getFullPath')) {
    function getFullPath($resourcePath)
    {
        $currentDisk = config("filesystems.default");
        return config("filesystems.disks.$currentDisk.root") . "/" . $resourcePath;
    }
}

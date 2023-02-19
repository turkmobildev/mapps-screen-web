<?php

namespace modules;

use \lib\core\Module;

class FileUploadModule extends Module {
    public function APIFileUploadAction($options, $name) {
        $postBody = array();
        $headerArray = array();
        $options = $this->app->parseObject($options);

        if (empty($options->APIURL) || strpos($options->APIURL, 'http') !== 0) {
            trigger_error("Invalid API URL", E_USER_ERROR);
        }

        // Content-Type
        if (!empty($options->dataType)) {
            $headerArray = array_merge($headerArray, array('Content-Type:' . $options->dataType));
        }

        // Authorization
        if (isset($options->authorization) && $options->authorization == 'basic') {
            if (empty($options->userName) || empty($options->userPass)) {
                trigger_error("Username and password are required for basic authorization", E_USER_ERROR);
            }

            $key64 = base64_encode($options->userName . ":" . $options->userPass);
            $headerArray = array('Authorization: Basic ' . $key64);
        }

        // Headers
        if (!empty($options->headers)) {
            $setHeaderArray = array();
            foreach ($options->headers as $keyHead => $valueHead) {
                $setHeaderArray[] = $keyHead . ': ' . $valueHead;
            }
            $headerArray = array_merge($headerArray, $setHeaderArray);
        }

        // File Only
        if (isset($options->uploadMethod) && $options->uploadMethod == "fileOnly") {
            if (empty($options->path)) {
                trigger_error("File path is requred", E_USER_ERROR);
            }

            if (explode(':', $options->path)[0] == 'http' || explode(':', $options->path)[0] == 'https') {
                $postBody = file_get_contents($options->path);
            } else {
                $postBody = file_get_contents(realpath(str_replace('\extensions\server_connect\modules', '', __DIR__) . $options->path));
            }
        } else {
            // Files and Data
            if ($options->multipleFile == "no") {
                // Single/Individual Files
                if (empty($options->filesIndividual)) {
                    trigger_error("File list is required", E_USER_ERROR);
                }

                foreach ($options->filesIndividual as $keyFile => $valueFile) {
                    if (empty($keyFile) || empty($valueFile)) {
                        trigger_error("Invalid file list", E_USER_ERROR);
                    }

                    if (explode(':', $valueFile)[0] == 'http' || explode(':', $valueFile)[0] == 'https') {
                        $cFile = curl_file_create($valueFile);
                    } else {
                        $cFile = curl_file_create(realpath(str_replace('\extensions\server_connect\modules', '', __DIR__) . $valueFile));
                    }

                    $postBody[$keyFile] = $cFile;
                }
            } else {
                //Multiple files
                if (empty($options->fileNameForMultiple)) {
                    trigger_error("Invalid file name", E_USER_ERROR);
                }

                if (!empty($options->filesMultipleSource) && $options->filesMultipleSource == 'array') {
                    //Source: Array
                    if (!isset($options->filesMultipleArr)) {
                        trigger_error("No files in array", E_USER_ERROR);
                    }

                    $pathFound = 0;
                    $j = 1;

                    foreach ($options->filesMultipleArr as $fileObj) {
                        $path = $fileObj;

                        if (!empty($options->filesMultipleArrPath)) {
                            $path = $fileObj[$options->filesMultipleArrPath];
                        }

                        if (!isset($path) || empty($path)) {
                            continue;
                        }

                        $pathFound = 1;

                        if (explode(':', $path)[0] == 'http' || explode(':', $path)[0] == 'https') {
                            $cFile = curl_file_create($path);
                        } else {
                            $cFile = curl_file_create(realpath(str_replace('\extensions\server_connect\modules', '', __DIR__) . $path));
                        }

                        $postBody[$options->fileNameForMultiple . '[' . $j++ . ']'] = $cFile;
                    }

                    if ($pathFound == 0) {
                        trigger_error("Could not find files in array", E_USER_ERROR);
                    }
                } else {
                    //Source: Grid
                    if (empty($options->filesMultipleGrid)) {
                        trigger_error("Files list is required", E_USER_ERROR);
                    }

                    $j = 1;
                    foreach ($options->filesMultipleGrid as $fileObj) {
                        $path = $fileObj->value;

                        if (empty($path)) {
                            continue;
                        }

                        if (explode(':', $path)[0] == 'http' || explode(':', $path)[0] == 'https') {
                            $cFile = curl_file_create($path);
                        } else {
                            $cFile = curl_file_create(realpath(str_replace('\extensions\server_connect\modules', '', __DIR__) . $path));
                        }

                        $postBody[$options->fileNameForMultiple . '[' . $j++ . ']'] = $cFile;
                    }
                }
            }

            // Input data - POST body
            if (!empty($options->inputData)) {
                $postBody = array_merge($postBody, (array) $options->inputData);
            }
        }

        // Qurery data - GET params
        if (!empty($options->queryData)) {
            $query_string = "?";
            foreach ((array) $options->queryData as $key => $value) {
                $query_string .= $key . '=' . $value . "&";
            }
            $options->APIURL = $options->APIURL . substr($query_string, 0, -1);
        }

        // Call API
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $options->APIURL);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headerArray);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postBody);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $server_output = curl_exec($ch);
        if (curl_errno($ch)) {
            trigger_error("API Error: " . curl_error($ch), E_USER_ERROR);
        }
        curl_close($ch);
        return json_decode($server_output);
    }
}
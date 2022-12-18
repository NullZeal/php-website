<?php

function executePageInitializationFunctions() {
    session_start(); #Opening a session to share variables on all pages
    forceHttps(); #Making page https only
    addErrorHandling(); #Adding error handling
    addCachingPreventionHeaders(); #Adding page headers
    addContentTypeHeader(); #Adding page headers
}

function forceHttps() {
    if (!isset($_SERVER["HTTPS"]) || $_SERVER["HTTPS"] != "on") {
        header('Location: https://' . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]);
        exit();
    }
}

function addErrorHandling() {
    error_reporting(E_ALL);
    set_error_handler("manageError");
    set_exception_handler("manageException");
}

function addCachingPreventionHeaders() {
    header("Expires: Tue, 29, Nov 2024 13:00 GMT");
    header("Cache-Control: no-cache");
    header("Pragma: no-cache");
}

function addContentTypeHeader() {
    header('Content-type: text/html; charset=UTF-8');
}

function manageError($errorNumber, $errorString, $errorFile, $errorLineNumber) {
    if (DEBUGGING) {
        echo "An error occured on the line $errorLineNumber in the file $errorFile: "
        . "$errorString ($errorNumber) at time: " . date("Y/m/d/ h:i:sa");
    } else {
        echo "An error has occured! The error has been reported and the IT team will look into it shortly. Thank you for your patience! :)";
    }
    $errorString = "An error occured on the line $errorLineNumber in the file "
        . "$errorFile: $errorString ($errorNumber) at time: " . date("Y/m/d/ h:i:sa");
    $orderStringJson = json_encode($errorString);
    file_put_contents(FILE_TXT_ERRORS_ERRORS_LOG, $orderStringJson . PHP_EOL, FILE_APPEND);
    die();
}

function manageException($errorObject) {
    if (DEBUGGING) { 
        #detailled ERROR
        echo "An exception has occured on the line "
        . $errorObject->getLine()
        . " of the file "
        . $_SERVER['SCRIPT_NAME']
        . " : "
        . $errorObject->getMessage()
        . " (Error #"
        . $errorObject->getCode()
        . ")"
        . " at time "
        . date("Y/m/d/ h:i:sa");
    } else {
        #generic ERROR
        echo "An exception has occured! The exception has been reported and the IT team will look into it shortly. Thank you for your patience! :)";
    }
    $orderArray = Array(
        $errorObject->getMessage(),
        $errorObject->getCode(),
        date("Y/m/d/ h:i:sa"),
        $_SERVER['SCRIPT_NAME'],
        $errorObject->getLine(),
    );
    $orderArrayJson = json_encode($orderArray);
    #Put content of error in a file
    file_put_contents(FILE_TXT_ERRORS_EXCEPTIONS_LOG, $orderArrayJson . PHP_EOL, FILE_APPEND);
    die();
}
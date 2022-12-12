<?php

function executePageInitializationFunctions()
{
    #opening a session to share variables on all pages
    session_start();

    #Making page https only
    forceHttps();

    //Adding error handling
    addErrorHandling();

    //Adding page headers
    addCachingPreventionHeaders();
    addContentTypeHeader();
}

function forceHttps()
{
    if (!isset($_SERVER["HTTPS"]) || $_SERVER["HTTPS"] != "on") {
        header('Location: https://' . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]);
        exit();
    }
}

function addErrorHandling()
{
    error_reporting(E_ALL);
    set_error_handler("manageError");
    set_exception_handler("manageException");
}

function addCachingPreventionHeaders()
{
    header("Expires: Tue, 29, Nov 2024 13:00 GMT");
    header("Cache-Control: no-cache");
    header("Pragma: no-cache");
}
#This function adds a content header

function addContentTypeHeader()
{
    header('Content-type: text/html; charset=UTF-8');
}
#This function adds content handling functions to the page

function manageError($errorNumber, $errorString, $errorFile, $errorLineNumber)
{

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

function manageException($errorObject)
{
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

    file_put_contents(FILE_TXT_ERRORS_EXCEPTIONS_LOG, $orderArrayJson . PHP_EOL, FILE_APPEND);

    die();
}
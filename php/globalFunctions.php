<?php

//Creating a constant for folders
define("FOLDER_CSS", "css/");
define("FOLDER_PICTURES", "pictures/");
define("FOLDER_MAIN", "./");
define("FOLDER_TXT", "txt/");
define("FOLDER_TXT_ERRORS", FOLDER_TXT . "errors/");

//Creating a constant for files
define("FILE_CSS_INDEX", FOLDER_CSS . "index.css");
define("FILE_CSS_BUYING", FOLDER_CSS . "buying.css");
define("FILE_CSS_ORDERS", FOLDER_CSS . "orders.css");
define("FILE_CSS_GLOBAL", FOLDER_CSS . "global.css");

define("FILE_PHPPAGE_HOME", FOLDER_MAIN . "index.php");
define("FILE_PHPPAGE_BUYING", FOLDER_MAIN . "buying.php");
define("FILE_PHPPAGE_ORDERS", FOLDER_MAIN . "orders.php");

define("FILE_TXT_ORDERS", FOLDER_TXT. "orders.txt");
define("FILE_TXT_ERRORS_BUYINGPAGE_WRONGINPUT_LOG", 
    FOLDER_TXT . FOLDER_TXT_ERRORS . "buyingpage_wronginput_log.txt");


define("FILE_PICTURES_LOGO", FOLDER_PICTURES . "logo.png");

define("FILE_PICTURES_SERVER", FOLDER_PICTURES . "server.jpg");
define("FILE_PICTURES_ENCRYPTION", FOLDER_PICTURES . "encryption.jpg");
define("FILE_PICTURES_PROTOCOL", FOLDER_PICTURES . "protocol.jpg");
define("FILE_PICTURES_ADBLOCK", FOLDER_PICTURES . "adblock.jpg");
define("FILE_PICTURES_DISK", FOLDER_PICTURES . "disk.jpg");


//Creating a variable for the logo of the company
$pictureLogo = "pictures/logo.png";

//The function generatePageHead() will take both a title and a css argument, defined in their respective php pages, to ensure a dynamic approach. This function is created to generate the html boilerplates dynamically.

function openDoctypeTag(){
    ?><!DOCTYPE html><?php
}

function openHtmlTag(){
    ?>

<html lang="en"><?php
}

function generatePageHead($title, $cssFile)
{

?>  
    <head>
        <meta charset="UTF-8">
        <meta title="Home Page"><title><?php echo $title; ?></title>
<?php //Below I added  the global CSS file as a constant with the define in the top of the page to show that I can use constants to reference a file.  ?>
        <link rel="stylesheet" type="text/css" href="<?php echo FILE_CSS_GLOBAL; ?>">
<?php //Below I added the page specific css file last with the variable taken from the function parameter  ?>
        <link rel="stylesheet" type="text/css" href="<?php echo $cssFile; ?>">
    </head>
<?php
}

function openBodyTag(){
    ?>
    
    <body><?php
}

function closeBodyTag(){
    ?></body><?php
}

function closeHtmlTag(){
    ?>

</html><?php
}


function generateNavigationMenu()
{

    ?>
        
        <div class="navigation">
            <a href="<?php echo FILE_PHPPAGE_HOME?>">Home</a>
            <a href="<?php echo FILE_PHPPAGE_BUYING?>">Buying</a>
            <a href="<?php echo FILE_PHPPAGE_ORDERS?>">Orders</a>
        </div>

    <?php
}

function generatePageFooter()
{
    ?>    <footer>
            Copyright Julien Pontbriand (202135020) <?php echo date("Y") ?>
            
        </footer>    
    <?php
}

function generateLogo()
{

    ?>
    <img id="logo" src="<?php echo FILE_PICTURES_LOGO; ?>" alt="logo of Julien Pontbriand inc." />
    <?php
}

function addCachingPreventionHeaders(){
    header("Expires: Tue, 29, Nov 2024 13:00 GMT");
    header("Cache-Control: no-cache");
    header("Pragma: no-cache");
}

function addContentTypeHeader(){
    header('Content-type: text/html; charset=UTF-8');
}










function addErrorHandling(){
    error_reporting(E_ALL);
    set_error_handler("manageError");
    set_exception_handler("manageException");
}

#CONSTANTS
define("DEBUGGING", true);

function manageError($errorNumber, $errorString, $errorFile, $errorLineNumber){
    echo "an error occured on the line $errorNumber in the file $errorFile: " 
            . "errorString ($errorNumber)";
    #save detailed error in the file
    die();

}

function manageException($errorObject)
{
    if(DEBUGGING){
        #detailled ERROR
     echo "An exception occured on the line "
    . $errorObject->getLine() 
    . " of the file "
    . $errorObject->getMessage() 
    . "(" 
    . $errorObject->getCode()
    . ")";
    }
    
    else {
        echo "An error has occured!";
    }
    
    #save detailed error in the file
    #file_put_contents() 
    #ADD DATE TO THE LOGS
    
    die();
}
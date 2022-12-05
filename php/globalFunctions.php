<?php
#-------------------------------------------------------------------
#Revision History
#
#DEVELOPER                      DATE             COMMENTS
#Julien Pontbriand (2135020)    Oct. 7, 2022     File creation. Added constants for 2 folders. Added constant for some files. Added variable for a file's path. Added a function to generate page headers in other files. Added a function to generate page footers. Added a function to generate a logo.
#
#Julien Pontbriand (2135020)    Oct. 22, 2022    Refactored the constants for the folders and files. Added functions to open and close some HTML tags. Added a function to generate the navigation panel. 
#
#Julien Pontbriand (2135020)    Oct. 23, 2022    Added functions to manage errors on pages. Minor refactoring.
#
#Julien Pontbriand (2135020)    Oct. 29, 2022    Removed logo variable. Refactored error functions. Added constant for download button. Minor code refactoring.
#
#Julien Pontbriand (2135020)    Oct. 29, 2022    Added more code comments to the file. Indendation has been reviewed. Fixed the logo generation function to be non case-sensititve
#
#Julien Pontbriand (2135020)    Nov. 29, 2022    Added the forcehttps function. 
#-------------------------------------------------------------------

#CONSTANTS - PLEASE PUT TO FALSE IF NOT DEBUGGING!

const myConnection = 'php/connection.php';
require_once myConnection;

define("DEBUGGING", false);

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
define("FILE_TXT_CHEATSHEET", FOLDER_TXT. "cheatsheet.txt");
define("FILE_TXT_ERRORS_BUYINGPAGE_WRONGINPUT_LOG", 
    FOLDER_TXT_ERRORS . "buyingpage_wronginput_log.txt");
define("FILE_TXT_ERRORS_ERRORS_LOG", 
    FOLDER_TXT_ERRORS . "error_logs.txt");
define("FILE_TXT_ERRORS_EXCEPTIONS_LOG", 
    FOLDER_TXT_ERRORS . "exceptions_logs.txt");

define("FILE_PICTURES_LOGO", FOLDER_PICTURES . "logo.png");

define("FILE_PICTURES_SERVER", FOLDER_PICTURES . "server.jpg");
define("FILE_PICTURES_ENCRYPTION", FOLDER_PICTURES . "encryption.jpg");
define("FILE_PICTURES_PROTOCOL", FOLDER_PICTURES . "protocol.jpg");
define("FILE_PICTURES_ADBLOCK", FOLDER_PICTURES . "adblock.jpg");
define("FILE_PICTURES_DISK", FOLDER_PICTURES . "disk.jpg");



#generates the doctype tag
function openDoctypeTag(){
    ?><!DOCTYPE html><?php
}

#generates the html tag
function openHtmlTag(){
    ?>

<html lang="en"><?php
}

#closes html tag
function closeHtmlTag(){
    ?>

</html><?php
}

#generates the body tag
function openBodyTag(){
    ?>
    
    <body id="<?php 
    
        
            if (isset($_GET["action"]) && strtolower($_GET["action"] == "print")) 
            {
                echo "bodyPrint";
            }
            else {
                echo "";
            }
    
    ?>"><?php
}

function closeBodyTag(){
    ?></body><?php
}

#The function generatePageHead() will take both a title and a css argument, 
#defined in their respective php pages, to ensure a dynamic approach. 
function generatePageHead($title, $cssFile)
{

?>  
    <head>
        <meta charset="UTF-8">
        <meta title="Home Page"><title><?php echo $title; ?></title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
<?php //Below I added  the global CSS file as a constant with the define in the top of the page to show that I can use constants to reference a file.  ?>
        <link rel="stylesheet" type="text/css" href="<?php echo FILE_CSS_GLOBAL; ?>">
<?php //Below I added the page specific css file last with the variable taken from the function parameter  ?>
        <link rel="stylesheet" type="text/css" href="<?php echo $cssFile; ?>">
    </head>
<?php
}

#This function generates the navigation menu
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

#This function generates the footer menu
function generatePageFooter()
{
    ?>    <footer>
            Copyright Julien Pontbriand (202135020) <?php echo date("Y") ?>
            
        </footer>    
    <?php
}

#This function generates a logo image
function generateLogo()
{

    ?>    <img id="<?php 
    
            if (isset($_GET["action"]) && strtolower($_GET["action"]) == "print") 
            {
                echo "logoPrint";
            }
            else {
                echo "logo";
            }
    ?>" src="<?php echo FILE_PICTURES_LOGO; ?>" alt="logo of Julien Pontbriand inc." />
    <?php
}

#This function adds caching headers
function addCachingPreventionHeaders(){
    header("Expires: Tue, 29, Nov 2024 13:00 GMT");
    header("Cache-Control: no-cache");
    header("Pragma: no-cache");
}

#This function adds a content header
function addContentTypeHeader(){
    header('Content-type: text/html; charset=UTF-8');
}

#This function adds content handling functions to the page
function addErrorHandling(){
    error_reporting(E_ALL);
    set_error_handler("manageError");
    set_exception_handler("manageException");
}

#This function manages errors catched by the global error_reporting mechanism
#It reacts according to a debug setting and registers errors into a log ffile
function manageError($errorNumber, $errorString, $errorFile, $errorLineNumber){
    
     if (DEBUGGING) {
    
         echo "An error occured on the line $errorLineNumber in the file $errorFile: " 
     . "$errorString ($errorNumber) at time: " . date("Y/m/d/ h:i:sa");}
    
    else {
        echo "An error has occured! The error has been reported and the IT team will look into it shortly. Thank you for your patience! :)";
    }
    
    $errorString = "An error occured on the line $errorLineNumber in the file "
        . "$errorFile: $errorString ($errorNumber) at time: " . date("Y/m/d/ h:i:sa");
    
    $orderStringJson = json_encode($errorString);
        
    file_put_contents(FILE_TXT_ERRORS_ERRORS_LOG, $orderStringJson . PHP_EOL, FILE_APPEND);

    die();
}

#This function manages exceptions catched by the global error_reporting mechanism
#It reacts according to a debug setting and registers exceptions into a log file
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
    }
    else {
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

function forceHttps()
{
    if( ! isset($_SERVER["HTTPS"]) || $_SERVER["HTTPS"] != "on")
    {
        header('Location: https://' . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]);
        exit();
    }
}

function generateRedStar() # This generates a red star character
{
    echo "<span id='red'>*</span>";
}

function generateLoginForm()
{
    if( ! isset($_POST["login"]))
    
    {
        
    ?>
        <div class="loginform">
            <form method="post">
                <label for="username">Username: </label>
                <input id="username" type="text" name="username" placeholder="Username"></input>
                <label for="password">Username: </label>
                <input id="password" type="text" name="password" placeholder="Password"></input>
                <button type="submit" name="login">Login</button>
            </form>
        </div>

    <?php        
        
    }
    else
    {
        $username = htmlspecialchars($_POST["username"]);
        $password = htmlspecialchars($_POST["password"]);
        
        $hashedPasswordFromForm = password_hash($password, PASSWORD_DEFAULT);
        
        $hashedPasswordFromDb = "";
        
        $SQLquery = "CALL procedure_get_password_from_username(:username)";
   
        $row = $connection->prepare($SQLquery);
    
        $row->bindParam(":username", $username, PDO::PARAM_STR);
        
        if($row->execute())
        {
            $hashedPasswordFromDb = $row->fetch();
        }
        
        if(password_verify($hashedPasswordFromForm, $hashedPasswordFromDb))
        {
            echo "Password Validation OK";
        }
    }
}

function openSession(){
    session_start();
}
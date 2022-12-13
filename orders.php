<?php
#-------------------------------------------------------------------
#Revision History
#
#DEVELOPER                      DATE             COMMENTS
#Julien Pontbriand (2135020)    Oct. 7, 2022     File creation. Was quick to do.
#
#Julien Pontbriand (2135020)    Oct. 22, 2022    Added a link to the global functions page. Added function calls to generate the page headers. Created a title for the page (with the wrong name). Added a function to generate this page's unique html, as a copy / paste of my own index page. Called functions to generate the page.
#
#Julien Pontbriand (2135020)    Oct. 23, 2022    Refactored the page almost completely.  9h long session. Added a function to generate the rows of the table. Refactorted the function to display this page's html.
#
#Julien Pontbriand (2135020)    Oct. 29, 2022    Added error handling. Minor code refactoring
#
#Julien Pontbriand (2135020)    Oct. 30, 2022    Added more comments to the code. Indendation refactoring (especially for the table). 
#                                                The page source looks way cleaner now. Fixed the color of the columns always being added
#
#Julien Pontbriand (2135020)    Nov. 29, 2022    Added the forcehttps function.
#-------------------------------------------------------------------

const INIT = 'php/business/init.php';
require_once INIT;
require_once FILE_UI_ORDERS;
require_once FILE_CLASSES_ORDER;
require_once FILE_CLASSES_ORDERS;

executePageInitializationFunctions();

$pageTitle = "Orders Page";
$errorMessage = "";

if (! isset($_POST["searchedDate"]) && ! isset($_POST["orderToDelete"])) 
{
    generatePageTop($pageTitle, FILE_CSS_ORDERS, true);
    generateLoginLogout();
    generateLogo();

    attemptSearchFormGeneration($errorMessage);

    generateOrdersTable();

    generateErrorMessageDiv($errorMessage);
    generatePageBottom();
}
elseif (isset($_POST["orderToDelete"]) )
{
    $newOrder = new Order();
    $newOrder->setId($_POST["orderToDelete"]);
    $newOrder->delete();
    attemptOrdersTableGeneration($errorMessage);
}
else
{
    attemptOrdersTableGeneration($errorMessage);
}


########################################################################
# PAGE-SPECIFIC FUNCTIONS BELOW
########################################################################

function attemptSearchFormGeneration(&$errorMessage)
{
    if (!isUserConnected()) 
    {
        $errorMessage = LOGGIN_ERROR_MESSAGE;
        return null;
    }
    else 
    {
        generateSearchForm();
    }
}

function attemptOrdersTableGeneration($errorMessage)
{
    $ordersObject = new Orders(
            
        $_SESSION["connectedUser"],
        isset($_POST["searchedDate"]) ? $_POST["searchedDate"] : ""
        );
        
    $ordersArray = $ordersObject->items;
    generateOrdersPage($ordersArray, $errorMessage);
}


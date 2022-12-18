<?php
#-------------------------------------------------------------------
#Revision History
#
#DEVELOPER                      DATE             COMMENTS
#Julien Pontbriand (2135020)    Oct. 7, 2022     File creation. Was quick to do.
#Julien Pontbriand (2135020)    Oct. 22, 2022    Added a link to the global functions page. 
#                                                Added function calls to generate the page headers. 
#                                                Created a title for the page (with the wrong name). 
#                                                Added a function to generate this page's unique html, as a copy / paste of my own index page. 
#                                                Called functions to generate the page.
#
#Julien Pontbriand (2135020)    Oct. 23, 2022    Refactored the page almost completely. 
#                                                Added a function to generate the rows of the table. 
#                                                Refactorted the function to display this page's html.
#
#Julien Pontbriand (2135020)    Oct. 29, 2022    Added error handling. Minor code refactoring
#Julien Pontbriand (2135020)    Oct. 30, 2022    Added more comments to the code. Indendation refactoring (especially for the table). 
#                                                The page source looks way cleaner now. 
#                                                Fixed the color of the columns always being added
#
#Julien Pontbriand (2135020)    Nov. 29, 2022    Added the forcehttps function.
#Julien Pontbriand (2135020)    Dec. 1, 2022    Added session loading function
#Julien Pontbriand (2135020)    Dec. 5, 2022    Page now loads some required functions from the init file
#Julien Pontbriand (2135020)    Dec. 6, 2022    Merged all initilization functions to 1 function
#Julien Pontbriand (2135020)    Dec. 7, 2022    Added disconnected user login prevention
#                                               Moved cheat sheet to home page
#
#Julien Pontbriand (2135020)    Dec. 8, 2022    Code refactoring
#Julien Pontbriand (2135020)    Dec. 9, 2022    Code refactoring
#Julien Pontbriand (2135020)    Dec. 12, 2022    Added ajax to the page for the generation of the orders table
#Julien Pontbriand (2135020)    Dec. 17, 2022    Made the page generation section contain only functions
#Julien Pontbriand (2135020)    Dec. 18, 2022    Refactored to have brackets inline
#-------------------------------------------------------------------

########################################################################
# PAGE-CONFIGURATION 
########################################################################

const INIT = 'php/business/init.php';

require_once INIT;
require_once FILE_UI_ORDERS;
require_once FILE_CLASSES_ORDER;
require_once FILE_CLASSES_ORDERS;

$pageTitle = "Orders";
$loginErrorMessage = "";

executePageInitializationFunctions();
checkForDeleteOrderRequest() ? fullfillOrderDeletionRequest() : null;
checkForSearchRequest() ? drawOrdersTableInTableContainer() : null;

########################################################################
# PAGE-GENERATION
########################################################################

generatePageTop($pageTitle, FILE_CSS_ORDERS, true);
generateLoginLogout();
generateLogo();
generateOrdersPageLogic($loginErrorMessage);
generateOrderTableContainer();
generateErrorMessageDiv($loginErrorMessage);
generatePageBottom();

########################################################################
# PAGE-SPECIFIC FUNCTIONS BELOW
########################################################################

function generateOrdersPageLogic(&$loginErrorMessage) {
    if (!isUserConnected()) {
        $loginErrorMessage = LOGIN_ERROR_NO_USER_CONNECTED;
        return null;
    }
    generateSearchForm();
}

function checkForDeleteOrderRequest() {
    return isset($_POST["orderToDelete"]);
}

function checkForSearchRequest() {
    return isset($_POST["searchedDate"]);
}

function fullfillOrderDeletionRequest() {
    $orderToDelete = new Order();
    $orderToDelete->setId($_POST["orderToDelete"]);
    $orderToDelete->delete();
    drawOrdersTableInTableContainer();
    die;
}

function drawOrdersTableInTableContainer() {
    #Check if there's a specific date. If it is the case, generate orders page accordingly
    $ordersObject = new Orders($_SESSION["connectedUser"], isset($_POST["searchedDate"]) ? $_POST["searchedDate"] : "");
    generateOrdersPage($ordersObject->items);
    die;
}
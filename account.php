<?php

const INIT  = 'php/init.php';
require_once INIT;

executePageInitializationFunctions();

$pageTitle = "Account Page";
$errorMessage = "";

generatePageTop($pageTitle, FILE_CSS_ORDERS);
generateLoginLogout($connection);
generateAccountPage($errorMessage);
generateErrorMessageDiv($errorMessage);
generatePageBottom();

########################################################################
# PAGE-SPECIFIC FUNCTIONS BELOW
########################################################################

function generateAccountPage(&$errorMessage)
{
    if (!isUserConnected()) 
    {
        $errorMessage = LOGGIN_ERROR_MESSAGE;
        return null;
    }
}
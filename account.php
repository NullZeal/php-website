<?php
#-------------------------------------------------------------------
#Revision History
#
#DEVELOPER                      DATE             COMMENTS
#Julien Pontbriand (2135020)    Dec. 8, 2022     Page creation
#Julien Pontbriand (2135020)    Dec. 12, 2022     Added a constructor for the parent to get the connection from
#Julien Pontbriand (2135020)    Dec. 17, 2022     Code refactoring                                    
#-------------------------------------------------------------------

########################################################################
# PAGE-CONFIGURATION
########################################################################

const INIT = 'php/business/init.php';

require_once INIT;
require_once FILE_UI_ACCOUNT;
require_once FILE_CLASSES_CUSTOMER;

$pageTitle = "Account";
$loginErrorMessage = "";
$successMessage = "";
$errorMessageTable = array(
    "firstname"     => "",
    "lastname"      => "",
    "address"       => "",
    "city"          => "",
    "province"      => "",
    "postalcode"    => "",
    "username"      => "",
    "user_password" => "",
    "picture"       => "",
);

executePageInitializationFunctions();

########################################################################
# PAGE-GENERATION
########################################################################

generatePageTop($pageTitle, FILE_CSS_ACCOUNT, false);
generateAccountPage($errorMessage, $errorMessageTable, $successMessage);
generateLoginLogout();
generateLogo();
generateAccountForm($errorMessageTable, $successMessage);
generateErrorMessageDiv($errorMessage);
generatePageBottom();

########################################################################
# PAGE-SPECIFIC FUNCTIONS
########################################################################

function generateAccountPage(&$loginErrorMessage, &$errorMessageTable, &$successMessage)
{
    
    if (!isUserConnected()) {
        $loginErrorMessage = LOGIN_ERROR_NO_USER_CONNECTED;
        return null;
    }
    
    if (! isset($_POST["update"])) {
        return null;
    } 
    
    $firstname = htmlspecialchars($_POST["firstname"]);
    $lastname = htmlspecialchars($_POST["lastname"]);
    $address = htmlspecialchars($_POST["address"]);
    $city = htmlspecialchars($_POST["city"]);
    $province = htmlspecialchars($_POST["province"]);
    $postalcode = htmlspecialchars($_POST["postalcode"]);
    $username = htmlspecialchars($_POST["username"]);
    $user_password = htmlspecialchars($_POST["user_password"]);
    $picture = "";

    if ($_FILES["picture"]["error"] == UPLOAD_ERR_OK && is_uploaded_file($_FILES["picture"]["tmp_name"])) {
        $picture = file_get_contents($_FILES["picture"]["tmp_name"]);
    }
    
    $newCustomer = new Customer();

    $errorMessageTable["firstname"] = $newCustomer->setFirstname($firstname) 
        ? $newCustomer->setFirstname($firstname)    : "";
    $errorMessageTable["lastname"] = $newCustomer->setLastname($lastname)
        ? $newCustomer->setLastname($lastname)      : "";
    $errorMessageTable["address"] = $newCustomer->setAddress($address) 
        ? $newCustomer->setAddress($address)        : "";
    $errorMessageTable["city"] = $newCustomer->setCity($city)
        ? $newCustomer->setCity($city)              : "";
    $errorMessageTable["province"] = $newCustomer->setProvince($province)
        ? $newCustomer->setProvince($province)      : "";
    $errorMessageTable["postalcode"] = $newCustomer->setPostalcode($postalcode)
        ? $newCustomer->setPostalcode($postalcode)  : "";
    $errorMessageTable["username"] = $newCustomer->setUsername($username)
        ? $newCustomer->setUsername($username)      : "";
    
    //checking if username is a duplicate)
    if ($newCustomer->isUsernameDuplicate()) {
        #This time it's ok to be a duplicate only if it's the customer's previous username
        $currenCustomer = new Customer();
        $currenCustomer->load($_SESSION["connectedUser"]);
        if($currenCustomer->getUsername() != $username){
            $errorMessageTable["username"] = "Username already registered";
        }
    }
    
    $errorMessageTable["user_password"] = $newCustomer->setUser_password($user_password)
        ? $newCustomer->setUser_password($user_password)    : "";
    $errorMessageTable["picture"] = $newCustomer->setPicture($picture)
        ? $newCustomer->setPicture($picture)                : "";
    
    if (checkForErrorsInArray($errorMessageTable)) {
        return null;
    }
    
    $hashedPassword = password_hash($user_password, PASSWORD_DEFAULT);
    $newCustomer->setUser_password($hashedPassword);
    $newCustomer->setId($_SESSION["connectedUser"]); 
    
    $newCustomer->update();
    $successMessage = "Update completed successfully!";
}

function checkForErrorsInArray($errorMessageTable) {
    foreach ($errorMessageTable as $value) {
        if (!empty($value)) {
            return true;
        }
    }
    return false;
}

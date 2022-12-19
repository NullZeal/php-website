<?php
#-------------------------------------------------------------------
#Revision History
#
#DEVELOPER                      DATE             COMMENTS
#Julien Pontbriand (2135020)    Dec. 1, 2022     File creation
#Julien Pontbriand (2135020)    Dec. 3, 2022     Added page logic and UI generation
#Julien Pontbriand (2135020)    Dec. 4, 2022     Completed the register.
#                                                Entries are now validated
#                                                Now checks for username duplicates
#                                                Pictures can now be loaded successfully
#                                                
#Julien Pontbriand (2135020)    Dec. 5, 2022     Global functions are now loaded from the INIT file
#Julien Pontbriand (2135020)    Dec. 6, 2022     Merged initialization functions
#                                                Some minor refactoring
#                                                
#Julien Pontbriand (2135020)    Dec. 7, 2022     Merged pagetop and pagebottom functions
#Julien Pontbriand (2135020)    Dec. 8, 2022     Split the function to generate the register form
#                                                Code refactoring
#                                                
#Julien Pontbriand (2135020)    Dec. 12, 2022     Moved the UI part of the page to another file
##Julien Pontbriand (2135020)    Dec. 18, 2022     Code refactoring                                               
#-------------------------------------------------------------------

########################################################################
# PAGE-CONFIGURATION
########################################################################

const INIT = 'php/business/init.php';

require_once INIT;
require_once FILE_UI_REGISTER;
require_once FILE_CLASSES_CUSTOMER;

$pageTitle = "Register";
$successMessage = "";

#Contains errors for all fields of the register form
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
    #For bigger images : please set the [mysqld] max_allowed_packet setting to a higher limit in /etc/my.cnf
    #https://stackoverflow.com/questions/7942154/mysql-error-2006-mysql-server-has-gone-away#9479681
);

executePageInitializationFunctions();

########################################################################
# PAGE-GENERATION
########################################################################

generatePageTop($pageTitle, FILE_CSS_REGISTER, false);
generateLogo();
attemptToRegisterCustomer($errorMessageTable, $successMessage);
generateRegisterForm($errorMessageTable, isset($successMessage) ? $successMessage : "");
generatePageBottom();

########################################################################
# PAGE-SPECIFIC FUNCTIONS
########################################################################

function attemptToRegisterCustomer(&$errorMessageTable, &$successMessage) {
    #Checks if there has been an attempt to register. If Not, exits
    if (! isset($_POST["register"])) {
        return null;
    }
    #Fetch all customer inputs
    $firstname = htmlspecialchars($_POST["firstname"]);
    $lastname = htmlspecialchars($_POST["lastname"]);
    $address = htmlspecialchars($_POST["address"]);
    $city = htmlspecialchars($_POST["city"]);
    $province = htmlspecialchars($_POST["province"]);
    $postalcode = htmlspecialchars($_POST["postalcode"]);
    $username = htmlspecialchars($_POST["username"]);
    $user_password = htmlspecialchars($_POST["user_password"]);
    $picture = "";
    
    #Attempt to fetch the picture input
    if ($_FILES["picture"]["error"] == UPLOAD_ERR_OK && is_uploaded_file($_FILES["picture"]["tmp_name"])) {
        $picture = file_get_contents($_FILES["picture"]["tmp_name"]);
    } 
    
    $newCustomer = new Customer();

    #Fill the error message table with possible errors
    #Also attempts to load the newCustomer object with customer inputs
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
    
    //checking if username is a duplicate ;)
    if ($newCustomer->isUsernameDuplicate()) {
        $errorMessageTable["username"] = "This username is already registered";
    }
    
    $errorMessageTable["user_password"] = $newCustomer->setUser_password($user_password)
        ? $newCustomer->setUser_password($user_password)    : "";
    $errorMessageTable["picture"] = $newCustomer->setPicture($picture)
        ? $newCustomer->setPicture($picture)                : "";
    
    #Check for errors
    if (checkForErrorsInArray($errorMessageTable)) {
        return null;
    }
    
    $hashedPassword = password_hash($user_password, PASSWORD_DEFAULT);
    $newCustomer->setUser_password($hashedPassword);
    #Insert a new user
    $newCustomer->save();
    $successMessage = "Registration completed successfully!";
    $_POST = [];
}

function checkForErrorsInArray($errorMessageTable) {
    #Checks for errors in the error table
    foreach ($errorMessageTable as $value) {
        if (!empty($value)) {
            return true;
        }
    }
    return false;
}
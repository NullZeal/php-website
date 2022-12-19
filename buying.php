<?php
#-------------------------------------------------------------------
#Revision History
#
#DEVELOPER                      DATE             COMMENTS
#Julien Pontbriand (2135020)    Oct. 7, 2022     File creation. Was quick to do.
#Julien Pontbriand (2135020)    Oct. 22, 2022    Added a link to the global functions page. 
#                                                Added function calls to generate the page headers. 
#                                                Created a title for the page. Added a function to generate this page's form. 
#                                                Added validations to the form inputs according to the requirements. 6h:30 long session.
#
#Julien Pontbriand (2135020)    Oct. 23, 2022    Added constants to define the validation requirements. 
#                                                Added comments to explain how I used a regex function. 
#                                                Added more validation content. Added a function that records entries on error. 
#                                                Added a class to contain const values (investigated this possibility). 
#                                                Validated proper HTML source code generation. 9h long session.
#                                                
#Julien Pontbriand (2135020)    Oct. 29, 2022    Added error handling. Minor refactoring.
#Julien Pontbriand (2135020)    Oct. 30, 2022    Added more comments to the code. Final indentation control.
#Julien Pontbriand (2135020)    Nov. 29, 2022    Amounts will now always display 2 digits.
#Julien Pontbriand (2135020)    Nov. 29, 2022    Added the forcehttps function.
#                                                Money values will now always register with 2 decimals.
#                                                
#Julien Pontbriand (2135020)    Dec. 1, 2022    Added a function to open sessions
#Julien Pontbriand (2135020)    Dec. 5, 2022    Changed global functions loader to the init file
#Julien Pontbriand (2135020)    Dec. 6, 2022    Merged all initilizing functions. Added a function to generate the login/logout UI
#Julien Pontbriand (2135020)    Dec. 7, 2022    Added a function to prevent [age generation without a connected customer.
#                                               Added an error message to help customer understand.    
#                                               
#Julien Pontbriand (2135020)    Dec. 8, 2022    Added code to make the buying page functional. Added error display
#Julien Pontbriand (2135020)    Dec. 9, 2022    Added calculations for subtotal, tax and total
#Julien Pontbriand (2135020)    Dec. 12, 2022    Moved UI functions to another page
#                                                Removed all database related calls 
#                                                
#Julien Pontbriand (2135020)    Dec. 17, 2022    Refactored code to make it cleaner
#                                                Added a comment section    
#Julien Pontbriand (2135020)    Dec. 18, 2022    Minor refactoring. 
#                                                Added logo generation function
#                                                                                         
#-------------------------------------------------------------------

########################################################################
# PAGE-CONFIGURATION 
########################################################################

const INIT = 'php/business/init.php';

require_once INIT;
require_once FILE_UI_BUYING;
require_once FILE_CLASSES_PRODUCT;
require_once FILE_CLASSES_PRODUCTS;
require_once FILE_CLASSES_ORDER;

$pageTitle = "Buying";
$errMsgArray = array(
    "comments"          => "",
    "quantity"          => "",
    "loginErrorMessage" => "",
);

executePageInitializationFunctions();

########################################################################
# PAGE-GENERATION
########################################################################

insertOrderToCustomer($errMsgArray);
generatePageTop($pageTitle, FILE_CSS_BUYING, false);
generateLoginLogout();
generateLogo();
generateBuyingPage($errMsgArray);
generateErrorMessageDiv($errMsgArray["loginErrorMessage"]);
generatePageBottom();

########################################################################
# PAGE-SPECIFIC FUNCTIONS
########################################################################

function insertOrderToCustomer(&$errMsgArray)
{
    #Check if a purchase has been submitted and if a customer is connected
    if (isset($_POST["purchaseSubmitted"]) && isset($_SESSION["connectedUser"])) {
        $comments = htmlspecialchars($_POST["comments"]);
        $quantity = htmlspecialchars($_POST["quantity"]);
        $price = Product::getProductPrice($_POST["product"]);
        $order = new Order();
        $errMsgArray["comments"] = $order->setComments($comments);
        $errMsgArray["quantity"] = $order->setQuantity($quantity);
        #Check if there are errors in the customer inputs
        if (
            $errMsgArray["comments"] == "" 
            && $errMsgArray["quantity"] == "" 
            && $price != -1
        ) {
            #Add an order to connected customer
            $order->setId_customer($_SESSION["connectedUser"]);
            $order->setId_product($_POST["product"]);
            $order->setProductPrice($price);
            $order->setSubtotal();
            $order->setTaxAmount();
            $order->setTotal();
            $order->save();
            header("Location: " . FILE_PAGE_ORDERS);
        }
    }
}
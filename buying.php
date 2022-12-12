<?php
#-------------------------------------------------------------------
#Revision History
#
#DEVELOPER                      DATE             COMMENTS
#Julien Pontbriand (2135020)    Oct. 7, 2022     File creation. Was quick to do.
#
#Julien Pontbriand (2135020)    Oct. 22, 2022    Added a link to the global functions page. Added function calls to generate the page headers. Created a title for the page. Added a function to generate this page's form. Added validations to the form inputs according to the requirements. 6h:30 long session.
#
#Julien Pontbriand (2135020)    Oct. 23, 2022    Added constants to define the validation requirements. Added comments to explain how I used a regex function. Added more validation content. Added a function that records entries on error. Added a class to contain const values (investigated this possibility). Validated proper HTML source code generation. 9h long session. #
#Julien Pontbriand (2135020)    Oct. 29, 2022    Added error handling. Minor refactoring.
#
#Julien Pontbriand (2135020)    Oct. 30, 2022    Added more comments to the code. Final indentation control.
#
#Julien Pontbriand (2135020)    Nov. 29, 2022    Amounts will now always display 2 digits.
#
#Julien Pontbriand (2135020)    Nov. 29, 2022    Added the forcehttps function.
#                                                Money values will now always register with 2 decimals.
#-------------------------------------------------------------------
#Importing global functions from the relative path given in $globalFunctions

const INIT = 'php/business/init.php';
require_once INIT;

require_once FILE_UI_BUYING;
require_once FILE_CLASSES_PRODUCTS;

executePageInitializationFunctions();

$pageTitle = "Buying Page";

$errorMessageArray = array(
    "login" => "",
    "comments" => "",
    "quantity" => ""
);

insertOrderToCustomer($errorMessageArray, $connection);
generatePageTop($pageTitle, FILE_CSS_BUYING);
generateLoginLogout($connection);
generateBuyingPage($errorMessageArray);
generateErrorMessageDiv($errorMessageArray["login"]);
generatePageBottom();

########################################################################
# PAGE-SPECIFIC FUNCTIONS BELOW
########################################################################

function insertOrderToCustomer(&$errorMessageArray, $connection)
{
    if (isset($_POST["buy"]) && isset($_SESSION["connectedUser"])) 
    {
        $comments = htmlspecialchars($_POST["comments"]);
        $quantity = htmlspecialchars($_POST["quantity"]);
        $price = getProductPrice($_POST["product"], $connection) 
            ? getProductPrice($_POST["product"], $connection) : -1;
        $order = new order();
        $errorMessageArray["comments"] = $order->setComments($comments);
        $errorMessageArray["quantity"] = $order->setQuantity($quantity);
        if
        (
            $errorMessageArray["comments"] == ""
            && $errorMessageArray["quantity"] == ""
            && $price != -1
        )
        {
            $order->setId_customer($_SESSION["connectedUser"]);
            $order->setId_product($_POST["product"]);
            $order->setProductPrice($price);
            $order->setSubtotal();
            $order->setTaxAmount();
            $order->setTotal();
            $order->save($connection);
            
            header("Location: " . FILE_PAGE_ORDERS);
        }
    }
}

function getProductPrice($productId, $connection)
{
    $SQLquery = Database2135020_Procedures_Products::SELECT_ONE
        . "(:id)";
    $rows = $connection->prepare($SQLquery);
    $rows->bindParam(":id", $productId, PDO::PARAM_STR);
    
    if ($rows->execute()) 
    {
        while ($row = $rows->fetch()) {
            if ($row["id"] == $productId) {
                return $row["price"];
            }
        }
    }
    return false;
}



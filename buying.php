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

const INIT = 'php/init.php';

require_once INIT;
require_once FILE_PRODUCTS;

executePageInitializationFunctions();

$pageTitle = "Buying Page";
$errorMessage = "";

generatePageTop($pageTitle, FILE_CSS_BUYING);
generateLoginLogout($connection);
generateBuyingPage($errorMessage);
generateErrorMessage($errorMessage);
generatePageBottom();

########################################################################
# PAGE-SPECIFIC FUNCTIONS BELOW
########################################################################

function insertOrderToCustomer()
{
    if (isset($_POST["buyingPage"])) {

        $productId = ($_POST["firstName"]);
        $comments = htmlspecialchars($_POST["buyingComments"]);
        $quantity = $_POST["buyingQuantity"];

        $order = new order();
    }
}

function generateBuyingPage(&$errorMessage)
{
    if (!isUserConnected()) {
        $errorMessage = LOGGIN_ERROR_MESSAGE;
        return null;
    } else {$errorMessage = "";}
    
    ?>  
        <div class="formSection">
            <?php generateLogo() ?>
            <span id="required">* = required</span>
            <form action="buying.php" method="POST" id="buyingForm">
                <label for="products"><?php generateRedStar(); ?>Product:</label>
                <select name="product" id="product">
                    <?php 
                        $products = new Products(); 
                        foreach ($products->items as $product){?>
                            <option value="<?php echo $product->getId() ?>">
                                <?php echo $product->getPcode() 
                                    . "-" 
                                    . $product->getPdescription()
                                    . " ("
                                    . $product->getPrice()
                                    . "$)"
                                ?>
                            </option><?php }
                    ?>
                </select>
                <br>
                <label><?php generateRedStar(); ?>Comments:</label>
                <input
                    type="text"
                    name="comments"
                    placeholder="Type your comments here!"
                    size="30"
                    maxlength="200">
                <br>
                <label><?php generateRedStar(); ?>Quantity:</label>
                <input 
                    type="text" 
                    name="quantity" 
                    placeholder="Input quantity here!"
                    size="30"
                    maxlength="20">
                <br>
                <button id="buyButton" type="submit" name="buy">Buy</button>
            </form>
        </div>
    <?php
}


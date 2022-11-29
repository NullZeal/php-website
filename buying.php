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

$globalFunctions = 'php/globalFunctions.php';
require_once $globalFunctions;

#Making page https only
forceHttps();

//Adding error handling
addErrorHandling();
#To enter DEBUG mode, set DEBUGGING to true in the globalFunctions.php file
#Test it with :
#   Trigger_error("custom error", E_USER_ERROR); #generate error
#   Throw new Exception("custom exception"); #generate exception

//Adding a page headers
addCachingPreventionHeaders();
addContentTypeHeader();

//Creating a title variable for this page
$pageTitle = "Buying Page";

#User input content for all the fields of the form
$productCode = "";
$firstName = "";
$lastName = "";
$city = "";
$comments = "";
$price = "";
$quantity = "";

#Validation content for all the fields
$validationProductCode = "";
$validationFirstName = "";
$validationLastName = "";
$validationCity = "";
$validationComments = "";
$validationPrice = "";
$validationQuantity = "";

$errorsOccured = false; #boolean value to check for errors
$orderConfirmation = ""; #possible message to confirm a successful order

$errorsArray = [];

#Defining validation constants

define("MAX_LENGTH_PRODUCTCODE", 25);
define("IMPERATIVE_LETTERS_IN_PRODUCTCODE", "prd");

define("MAX_LENGTH_FIRSTNAME", 20);
define("MAX_LENGTH_LASTNAME", 20);
define("MAX_LENGTH_CITY", 30);
define("MAX_LENGTH_COMMENTS", 200);

define("MIN_VALUE_PRICE", 0);
define("MAX_VALUE_PRICE", 10000);
define("MIN_VALUE_QUANTITY", 1);
define("MAX_VALUE_QUANTITY", 99);

define("TAX_LOCAL_TAXES_IN_PERCENTAGE", 16.1);

function isCurrency($number)
{
    // function taken from 
    // https://stackoverflow.com/questions/4982291/how-to-check-if-an-entered-value-is-currency
    // Here I understand that:
    #It starts with ^
    #It accepts 0 or 1 - character with -? 
    #It then accepts 1 or more of any of the chars inside the range [0-9] with : +
    ##It then creates a non capturing group with : (?:
    #Inside the group it takes a . with : \. (escape)
    #Then it takes 1 or 2 of any chars inside the range [0-9]
    #Then it lets us know this group of chars can happen 0 or 1 time with the : ?
    #I allow negative numbers so that I could create another verification
    #to be more precise about the error problem
    return preg_match("/^-?[0-9]+(?:\.[0-9]{1,2})?$/", $number);
}

function isAnInt($number)
{
    #This function validates if the given arg is = to 1 or or more of any chars
    # in range 0-9 (int only string)
    return preg_match("/^[0-9]+$/", $number);
}

function pushErrorWithTimeToArray(&$array, $errorValueToSend, $fieldFromClass, $errorType)
{
    #here I did a function that can add error content to an array (using reference with &)
    #I wanted to try to register work with arrays as well as with strings to
    # put data inside of documents. 
    $stringToPush = $fieldFromClass
        . "-ERROR. / TYPED VALUE = "
        . $errorValueToSend
        . " / ERROR TYPE = "
        . $errorType
        . " / DATE = "
        . date("Y/m/d h:i:sa")
        . PHP_EOL; #I learned online that this is the same thing as /r/n
    array_push($array, $stringToPush);
}

abstract class Fields
{

    #Here I first used an enum, but then I read this :
    #https://stackoverflow.com/questions/70235747/php-enums-tostring-magic-method
    #and it seemed proper to use an abstract class instead to hold const values.
    #I use these fields in the validation process below


    public const ProductCode = 'Product Code';
    public const FirstName = 'First Name';
    public const LastName = 'Last Name';
    public const City = 'City';
    public const Comments = 'Comments';
    public const Price = 'Price';
    public const Quantity = 'Quantity';

}

if (isset($_POST["buyingPage"])) {
    
    #Here I will test all the validation requirements.
    #All form inputs are included in separate if-elseif chains
    #The htmlspecialchars protects against injection

    $productCode = htmlspecialchars($_POST["productCode"]);
    $firstName = htmlspecialchars($_POST["firstName"]);
    $lastName = htmlspecialchars($_POST["lastName"]);
    $city = htmlspecialchars($_POST["city"]);
    $comments = htmlspecialchars($_POST["comments"]);
    $price = htmlspecialchars($_POST["price"]);
    $quantity = htmlspecialchars($_POST["quantity"]);

    if (empty($productCode)) {
        $validationProductCode = "The product code cannot be empty";
        $errorsOccured = true;
        pushErrorWithTimeToArray(
            $errorsArray,
            $productCode,
            Fields::ProductCode,
            $validationProductCode);
    } elseif (mb_strlen($productCode) > MAX_LENGTH_PRODUCTCODE) {
        $validationProductCode = "The product code cannot be over 25 characters";
        $errorsOccured = true;
        pushErrorWithTimeToArray(
            $errorsArray,
            $productCode,
            Fields::ProductCode,
            $validationProductCode);
    } elseif (!is_numeric(mb_stripos($productCode, IMPERATIVE_LETTERS_IN_PRODUCTCODE))) {
        $validationProductCode = "Product code must contain the letters PRD";
        $errorsOccured = true;
        pushErrorWithTimeToArray(
            $errorsArray,
            $productCode,
            Fields::ProductCode,
            $validationProductCode);
    }

    if (empty($firstName)) {
        $validationFirstName = "The first name cannot be empty";
        $errorsOccured = true;
        pushErrorWithTimeToArray(
            $errorsArray,
            $firstName,
            Fields::FirstName,
            $validationFirstName);
    } elseif (mb_strlen($firstName) > MAX_LENGTH_FIRSTNAME) {
        $validationFirstName = "The first name cannot be over 20 characters";
        $errorsOccured = true;
        pushErrorWithTimeToArray(
            $errorsArray,
            $firstName,
            Fields::FirstName,
            $validationFirstName);
    }

    if (empty($lastName)) {
        $validationLastName = "The last name cannot be empty";
        $errorsOccured = true;
        pushErrorWithTimeToArray(
            $errorsArray,
            $lastName,
            Fields::LastName,
            $validationLastName);
    } elseif (mb_strlen($lastName) > MAX_LENGTH_LASTNAME) {
        $validationLastName = "The last name cannot be over 20 characters";
        $errorsOccured = true;
        pushErrorWithTimeToArray(
            $errorsArray,
            $lastName,
            Fields::LastName,
            $validationLastName);
    }

    if (empty($city)) {
        $validationCity = "The city name cannot be empty";
        $errorsOccured = true;
        pushErrorWithTimeToArray(
            $errorsArray,
            $city,
            Fields::City,
            $validationCity);
    } elseif (mb_strlen($city) > MAX_LENGTH_CITY) {
        $validationCity = "The city name cannot be over 30 characters";
        $errorsOccured = true;
        pushErrorWithTimeToArray(
            $errorsArray,
            $city,
            Fields::City,
            $validationCity);
    }

    if (mb_strlen($comments) > MAX_LENGTH_COMMENTS) {
        $validationComments = "The comment section cannot contain more than 200 characters";
        $errorsOccured = true;
        pushErrorWithTimeToArray(
            $errorsArray,
            $comments,
            Fields::Comments,
            $validationComments);
    }

    if (!isCurrency($price)) {
        $validationPrice = "The price must be a numeric, currency-like value";
        $errorsOccured = true;
        pushErrorWithTimeToArray(
            $errorsArray,
            $price,
            Fields::Price,
            $validationPrice);
    } elseif ((float) $price < MIN_VALUE_PRICE) {
        $validationPrice = "The price cannot be a negative value";
        $errorsOccured = true;
        pushErrorWithTimeToArray(
            $errorsArray,
            $price,
            Fields::Price,
            $validationPrice);
    } elseif ($price > MAX_VALUE_PRICE) {
        $validationPrice = "The price cannot be a over 10k";
        $errorsOccured = true;
        pushErrorWithTimeToArray($errorsArray,
            $price,
            Fields::Price,
            $validationPrice);
    }

    if (!is_numeric($quantity)) {
        $validationQuantity = "The quantity must be a numeric value";
        $errorsOccured = true;
        pushErrorWithTimeToArray(
            $errorsArray,
            $quantity,
            Fields::Quantity,
            $validationPrice);
    } elseif (!filter_var((float) $quantity, FILTER_VALIDATE_INT)) {
        $validationQuantity = "The quantity must be an integer value (round number) over 0";
        $errorsOccured = true;
        pushErrorWithTimeToArray(
            $errorsArray,
            $quantity,
            Fields::Quantity,
            $validationQuantity);
    } elseif ((int) $quantity < MIN_VALUE_QUANTITY) {
        $validationQuantity = "The quantity cannot be a under 1";
        $errorsOccured = true;
        pushErrorWithTimeToArray(
            $errorsArray,
            $quantity,
            Fields::Quantity,
            $validationQuantity);
    } elseif ((int) $quantity > MAX_VALUE_QUANTITY) {
        $validationQuantity = "The quantity cannot be a over 99";
        $errorsOccured = true;
        pushErrorWithTimeToArray(
            $errorsArray,
            $quantity,
            Fields::Quantity,
            $validationQuantity);
    }

    foreach ($errorsArray as $error) {
        #Here we ALWAYS register all user errors inside of a file.
        #This is additionnal project content that was not in the requirements
        #It helped me understand how to make this work.
        file_put_contents(FILE_TXT_ERRORS_BUYINGPAGE_WRONGINPUT_LOG, $error, FILE_APPEND);
    }

    #If no errors occured, we accept the order and save it to the orders.txt file
    if ($errorsOccured == false) {
        $orderConfirmation = "Order submitted successfully!";

        $subtotal = (float) $quantity * (float) $price;
        $taxAmount = round($subtotal * (TAX_LOCAL_TAXES_IN_PERCENTAGE / 100), 2);
        $total = round(($subtotal + $taxAmount), 2);
        
        $orderArray = array(
            $productCode,
            $firstName,
            $lastName,
            $city,
            $comments,
            number_format($price, 2),
            $quantity,
            number_format($subtotal, 2),
            number_format($taxAmount, 2),
            number_format($total, 2));
        
        $orderArrayJson = json_encode($orderArray);
        
        file_put_contents(FILE_TXT_ORDERS, $orderArrayJson . PHP_EOL, FILE_APPEND);

        $productCode = "";
        $firstName = "";
        $lastName = "";
        $city = "";
        $comments = "";
        $price = "";
        $quantity = "";
    }
}

function generateRedStar() # This generates a red star character
{
    echo "<span id='red'>*</span>";
}

function generateBuyingPage( 

    #this function generates most of the html specific content for this page
    
    $productCode,
    $firstName,
    $lastName,
    $city,
    $comments,
    $price,
    $quantity,
    $validationProductCode,
    $validationFirstName,
    $validationLastName,
    $validationCity,
    $validationComments,
    $valiationPrice,
    $validationQuantity,
    $orderConfirmation,
    $errorsOccured)
{

    $errorsOccured = false;

    ?>

        <div class="formSection">
        <?php generateLogo() ?>
        <span id="required">* = required</span>
            <p class="confirmation"><?php echo $orderConfirmation ?></p>

            <form action="buying.php" method="POST" id="buyingForm">
                <p>
                    <label>Product code:<?php generateRedStar(); ?></label>
                    <input type="text" 
                           name="productCode"
                           value="<?php echo $productCode ?>"
                           placeholder="Must include letters PRD"
                           size="35"
                           maxlength="25">
                    <span style="color:red"><?php echo $validationProductCode; ?></span>
                </p>

                <p>
                    <label>Customer first name:<?php generateRedStar(); ?></label>
                    <input
                        type="text"
                        name="firstName"
                        value="<?php echo $firstName ?>"
                        placeholder="FirstName"
                        size="30"
                        maxlength="20">
                    <span style="color:red"><?php echo $validationFirstName; ?></span>
                </p>

                <p>
                    <label>Customer last name:<?php generateRedStar(); ?></label>
                    <input 
                        type="text" 
                        name="lastName" 
                        value="<?php echo $lastName ?>"
                        placeholder="LastName"
                        size="30"
                        maxlength="20">
                    <span style="color:red"><?php echo $validationLastName; ?></span>
                </p>

                <p>
                    <label>Customer city:<?php generateRedStar(); ?></label>
                    <input 
                        type="text"
                        name="city" 
                        value="<?php echo $city ?>"
                        placeholder="City"
                        size="40"
                        maxlength="30">
                    <span style="color:red"><?php echo $validationCity; ?></span>
                </p>

                <p>
                    <label>Comments: </label>
                    <textarea name="comments"
                              placeholder="Maximum 200 chars allowed"
                              value="<?php echo $comments ?>"
                              rows="7"
                              cols="50"
                              maxlength="200"></textarea>
                    <span style="color:red"><?php echo $validationComments; ?></span>
                </p>

                <p>
                    <label>Price:<?php generateRedStar(); ?></label>
                    <input 
                        type="text" 
                        name="price" 
                        value="<?php echo $price ?>"
                        placeholder="0-10000, currency-like (ex 10.10 or 10.1 or 10)"
                        size="50"
                        maxlength="15">
                    <span style="color:red"><?php echo $valiationPrice; ?></span>
                </p>

                <p>
                    <label>Quantity:<?php generateRedStar(); ?></label>
                    <input 
                        type="text"
                        name="quantity"
                        value="<?php echo $quantity ?>"
                        placeholder="Between 1 and 99">
                    <span style="color:red"><?php echo $validationQuantity; ?></span>
                </p>

                <input 
                    type = "submit" 
                    value="Order now!" 
                    name="buyingPage"
                    id="submitButton"/>
            </form>
        </div>
    <?php
}
#Generating the page by calling all the necessary functions
openDoctypeTag();
openHtmlTag();
generatePageHead($pageTitle, FILE_CSS_BUYING);
openBodyTag();

generateNavigationMenu();

generateBuyingPage(
    $productCode,
    $firstName,
    $lastName,
    $city,
    $comments,
    $price,
    $quantity,
    $validationProductCode,
    $validationFirstName,
    $validationLastName,
    $validationCity,
    $validationComments,
    $validationPrice,
    $validationQuantity,
    $orderConfirmation,
    $errorsOccured
);

generatePageFooter();

closeBodyTag();
closeHtmlTag();
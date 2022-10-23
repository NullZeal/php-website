<?php
//Importing global functions from the relative path given in $globalFunctions
$globalFunctions = 'php/globalFunctions.php';
require_once $globalFunctions;

//Adding a page headers
addCachingPreventionHeaders();
addContentTypeHeader();

//Creating a title variable for this page
$pageTitle = "Buying Page";

#User input content for all the fields
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

$errorsOccured = false;
$orderConfirmation = "";



// function taken from 
// https://stackoverflow.com/questions/4982291/how-to-check-if-an-entered-value-is-currency

function isCurrency($number)
{
  return preg_match("/^-?[0-9]+(?:\.[0-9]{1,2})?$/", $number);
}

function isAnInt($number)
{
  return preg_match("/^[0-9]+$/", $number);
}

if (isset($_POST["buyingPage"])) {

    $productCode = htmlspecialchars($_POST["productCode"]);
    $firstName = htmlspecialchars($_POST["firstName"]);
    $lastName = htmlspecialchars($_POST["lastName"]);
    $city = htmlspecialchars($_POST["city"]);
    $comments = htmlspecialchars($_POST["comments"]);
    $price = htmlspecialchars($_POST["price"]);
    $quantity = htmlspecialchars($_POST["quantity"]);
    
    if($productCode == ""){
        $validationProductCode = "The product code cannot be empty";
        $errorsOccured = true;
    }
    elseif (mb_strlen($productCode) > 25){
        $validationProductCode = "The product code cannot be over 25 characters";
        $errorsOccured = true;
    }
    elseif (stristr($productCode, "prd") == false) {
        $validationProductCode = "Product code must contain the letters PRD";
        $errorsOccured = true;
    }

    if ($firstName == ""){
        $validationFirstName = "The first name cannot be empty";
        $errorsOccured = true;
    }
    elseif(mb_strlen($firstName) > 20){
        $validationFirstName = "The first name cannot be over 20 characters";
        $errorsOccured = true;
    }
    
    if ($lastName == ""){
        $validationLastName = "The last name cannot be empty";
        $errorsOccured = true;
    }
    elseif(mb_strlen($lastName) > 20){
        $validationLastName = "The last name cannot be over 20 characters";
        $errorsOccured = true;
    }
    
    if ($city == ""){
        $validationCity = "The city name cannot be empty";
            $errorsOccured = true;
    }
    elseif(mb_strlen($city) > 30){
        $validationCity = "The city name cannot be over 30 characters";
        $errorsOccured = true;
    }
    
    if (mb_strlen($comments) > 200){
        $validationComments = "The comment section cannot contain more than 200 characters";
        $errorsOccured = true;
    }
    
    if(!isCurrency($price)){
        $validationPrice = "The price must be a numeric, currency-like value";
        $errorsOccured = true;
    }
    elseif ((float)$price < 0) {
        $validationPrice = "The price cannot be a negative value";
        $errorsOccured = true;
    }
    elseif($price > 10000){
        $validationPrice = "The price cannot be a over 10k";
        $errorsOccured = true;
    }
 
    if(!is_numeric($quantity)){
        $validationQuantity = "The quantity must be a numeric value";
        $errorsOccured = true;
    }
    elseif(!filter_var((float)$quantity, FILTER_VALIDATE_INT)){
        $validationQuantity = "The quantity must be an integer value";
        $errorsOccured = true;
    }
    elseif ((int)$quantity < 1) {
        $validationQuantity = "The quantity cannot be a under 1";
        $errorsOccured = true;
    }
    elseif ((int)$quantity > 99) {
        $validationQuantity = "The quantity cannot be a over 99";
        $errorsOccured = true;
    }


    #if no errors occured 
    if ($errorsOccured == false) {
        $orderConfirmation = "Your order was complete!";
        $productCode = "";
        $firstName = "";
        $lastName = "";
        $city = "";
        $comments = "";
        $price = "";
        $quantity = "";
    }
    
    $subtotal = (int)$quantity * (float)$price;
    
}

function generateRedStar()
{
    echo "<span id='red'>*</span>";
}

function generateBuyingPage($productCode,
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

        <form action="buying.php" method="POST" id="buyingForm">
            <p>
                <label>Product code: <?php generateRedStar(); ?></label>
                <input type="text" 
                       name="productCode"
                       value="<?php echo $productCode ?>"
                       placeholder="Must include letters PRD"
                       size="35"
                       maxlength="25">
                <span style="color:red"><?php echo $validationProductCode; ?></span>
            </p>

            <p>
                <label>Customer first name: <?php generateRedStar(); ?></label>
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
                <label>Customer last name: <?php generateRedStar(); ?></label>
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
                <label>Customer city: <?php generateRedStar(); ?></label>
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
                <label>Price: <?php generateRedStar(); ?></label>
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
                <label>Quantity: <?php generateRedStar(); ?></label>
                <input 
                    type="text"
                    name="quantity"
                    value="<?php echo $quantity ?>"
                    placeholder="Between 1 and 99">
                <span style="color:red"><?php echo $validationQuantity; ?></span>
            </p>

            <input type = "submit" value="Order" name="buyingPage"/>
        </form>
        
        <p class="confirmation"><?php echo $orderConfirmation?></p>

        <?php
    }
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
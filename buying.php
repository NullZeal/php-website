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
$price = 0;
$quantity = 0;

#Validation content for all the fields
$validationProductCode = "";
$validationFirstName = "";
$validationLastName = "";
$validationCity = "";
$validationComments = "";
$valiationPrice = 0;
$validationQuantity = 0;

$errorsOccured = false;
$orderConfirmation = "";


if (isset($_POST["buyingPage"])) {

    $productCode = htmlspecialchars($_POST["productCode"]) ;
    $firstName = htmlspecialchars($_POST["firstName"]);
    $lastName = htmlspecialchars($_POST["lastName"]);
    $city = htmlspecialchars($_POST["city"]) ;
    $comments = htmlspecialchars($_POST["comments"]);
    $price = htmlspecialchars($_POST["price"]);
    $quantity = htmlspecialchars($_POST["quantity"]);
    
    switch ($productCode){
        case "":
            $validationProductCode = "The product code cannot be empty";
            $errorsOccured = true;
            break;
        case strlen($productCode) > 25:
            $validationProductCode = "The product code cannot be over 25 characters";
            $errorsOccured = true;
            break;
        case stristr($productCode,"prd") == false:
            $validationProductCode = "Product code must contain the letters PRD";
            $errorsOccured = true;
            break;
        default:
    }
    
    switch ($firstName){
        case "":
            $validationProductCode = "The first name cannot be empty";
            $errorsOccured = true;
            break;
        case strlen($firstName) > 20:
            $validationFirstName = "The first name cannot be over 20 characters";
            $errorsOccured = true;
            break;
        default:
    }

    switch ($lastName){
        case "":
            $validationProductCode = "The last name cannot be empty";
            $errorsOccured = true;
            break;
        case strlen($lastName) > 20:
            $validationLastName = "The last name cannot be over 20 characters";
            $errorsOccured = true;
            break;
        default:
    }
    
    switch ($city){
        case "":
            $validationProductCode = "The city name cannot be empty";
            $errorsOccured = true;
            break;
        case strlen($city) > 20:
            $validationCity = "The city name cannot be over 30 characters";
            $errorsOccured = true;
            break;
        default:
    }
    
    
    
    #if no errors occured 
    if($errorsOccured == false){
        $orderConfirmation = "Your order was complete!";
        $productCode = "" ;
        $firstName = "";
        $lastName = "";
        $city = "" ;
        $comments = "";
        $price = "";
        $quantity = "";
    }
   
}

function generateRedStar(){
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
    $validationLastName ,
    $validationCity,
    $validationComments,
    $valiationPrice ,
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
                               value="<?php echo $productCode?>"
                               placeholder="Input your product code here!">
                        
                        <span style="color:red"><?php echo $validationProductCode; ?></span>
                    </p>

                    <p>
                        <label>Customer first name: <?php generateRedStar(); ?></label>
                        <input  type="text" name="firstName" value="<?php echo $firstName?>">
                        <span style="color:red"><?php echo $validationErrorModel; ?></span>
                    </p>

                    <p>
                        <label>Customer last name: <?php generateRedStar(); ?></label>
                        <input  type="text" name="lastName" value="<?php echo $lastName?>">
                        <span style="color:red"><?php echo $validationErrorYear; ?></span>
                    </p>
                    
                    <p>
                        <label>Customer city: <?php generateRedStar(); ?></label>
                        <input  type="text" name="city" value="<?php echo $city?>">
                        <span style="color:red"><?php echo $validationErrorYear; ?></span>
                    </p>
                    
                    <p>
                        <label>Comments: </label>
                        <textarea name="comments" 
                                  value="<?php echo $comments?>" 
                                  rows="10" 
                                  cols="50"
                                  maxlength="200">
                                  
                        </textarea>
                        <span style="color:red"><?php echo $validationErrorYear; ?></span>
                    </p>
                    
                    <p>
                        <label>Price: <?php generateRedStar(); ?></label>
                        <input  type="text" name="price" value="<?php echo $price?>">
                        <span style="color:red"><?php echo $validationErrorMake; ?></span>
                    </p>
                    
                    <p>
                        <label>Quantity: <?php generateRedStar(); ?></label>
                        <input  type="text" name="quantity" value="<?php echo $quantity?>">
                        <span style="color:red"><?php echo $validationErrorMake; ?></span>
                    </p>

                    <input type = "submit" value="Order" name="buyingPage"/>
            </form>

    <?php echo $orderConfirmation;
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
    $validationLastName ,
    $validationCity,
    $validationComments,
    $valiationPrice ,
    $validationQuantity,
    
    $orderConfirmation,
    $errorsOccured
    );


generatePageFooter();

closeBodyTag();
closeHtmlTag();


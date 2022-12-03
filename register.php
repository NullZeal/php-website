<?php
$globalFunctions = 'php/globalFunctions.php';
$customer = 'php/class/customer.php';
require_once $globalFunctions;
require_once $customer;

#opening a session to share variables on all pages
openSession();

#Making page https only
forceHttps();

//Adding error handling
addErrorHandling();
#To enter DEBUG mode, set DEBUGGING to true in the globalFunctions.php file
#Test it with :
#   Trigger_error("custom error", E_USER_ERROR); #generate error
#   Throw new Exception("custom exception"); #generate exception
//Adding page headers
addCachingPreventionHeaders();
addContentTypeHeader();

//Creating a title variable for this page
$pageTitle = "Register";

//this will look a bit like the buying page with validations and a submission
//if validations work, we will add a user to the db wit the procedure customers insert one

function generateRegisterForm($errorMessageTable)
{

    ?>

    <div class="loginform">
        <form method="post" enctype="multipart/form-data>
            <label for="firstname">First name: </label>
            <input id="firstname" type="text" name="firstname" placeholder="Firstname"></input>
            <span class="formErrorSpan"><?php echo $errorMessageTable["firstname"]; ?></span>
            
            <br>
            
            <label for="lastname">Last name: </label>
            <input id="lastname" type="text" name="lastname" placeholder="Lastname"></input>
            <span class="formErrorSpan"><?php echo $errorMessageTable["lastname"]; ?></span>
            
            <br>
            
            <label for="address">Address: </label>
            <input id="address" type="text" name="address" placeholder="Address"></input>
            <span class="formErrorSpan"><?php echo $errorMessageTable["address"]; ?></span>
            
            <br>
            
            <label for="city">City: </label>
            <input id="city" type="text" name="city" placeholder="City"></input>
            <span class="formErrorSpan"><?php echo $errorMessageTable["city"]; ?></span>
            
            <br>
            
            <label for="province">Province: </label>
            <input id="province" type="text" name="province" placeholder="Province"></input>
            <span class="formErrorSpan"><?php echo $errorMessageTable["province"]; ?></span>
            
            <br>
            
            <label for="postalcode">Postal code: </label>
            <input id="postalcode" type="text" name="postalcode" placeholder="Postalcode"></input> 
            <span class="formErrorSpan"><?php echo $errorMessageTable["postalcode"]; ?></span>
            
            <br>
            
            <label for="username">Username: </label>
            <input id="username" type="text" name="username" placeholder="Username"></input>
            <span class="formErrorSpan"><?php echo $errorMessageTable["username"]; ?></span>
            
            <br>
            
            <label for="user_password">Password: </label>
            <input id="user_password" type="text" name="user_password" placeholder="Password"></input>
            <span class="formErrorSpan"><?php echo $errorMessageTable["user_password"]; ?></span>
            
            <br>
            
            <label for="picture">Picture: </label>
            <input id="picture" type="file" name="picture" placeholder="picture"></input>
            <span class="formErrorSpan"><?php echo $errorMessageTable["picture"]; ?></span>
            <br>
            
            <button type="submit" name="register">Register</button>
            
        </form>
    </div>
    <?php
}

$errorMessageTable = array(
            "firstname" => "",
            "lastname" => "",
            "address" => "",
            "city" => "",
            "province" => "",
            "postalcode" => "",
            "username" => "",
            "user_password" => "",
            "picture" => ""
        );

function insertNewUser(&$someArray)
{
    if ( isset($_POST["register"]))
    {   
        $firstname = htmlspecialchars($_POST["firstname"]);
        $lastname = htmlspecialchars($_POST["lastname"]);
        $address = htmlspecialchars($_POST["address"]);
        $city = htmlspecialchars($_POST["city"]);
        $province = htmlspecialchars($_POST["province"]);
        $postalcode = htmlspecialchars($_POST["postalcode"]);
        $username = htmlspecialchars($_POST["username"]);
        $user_password = htmlspecialchars($_POST["user_password"]);
        $picture = htmlspecialchars($_POST["picture"]);

        $newCustomer = new customer();
        
        $someArray["firstname"] = $newCustomer->setFirstname($firstname) == true
            ? $newCustomer->setFirstname($firstname) : "";
        $someArray["lastname"] = $newCustomer->setLastname($lastname) == true
            ? $newCustomer->setLastname($lastname) : "";
        $someArray["address"] = $newCustomer->setAddress($address) == true
            ? $newCustomer->setAddress($address) : "";
        $someArray["city"] = $newCustomer->setCity($city) == true 
            ? $newCustomer->setCity($city) : "";
        $someArray["province"] = $newCustomer->setProvince($province) == true 
            ? $newCustomer->setProvince($province) : "";
        $someArray["postalcode"] = $newCustomer->setPostalcode($postalcode) == true 
            ? $newCustomer->setPostalcode($postalcode) : "";
        $someArray["username"] = $newCustomer->setUsername($username) == true 
            ? $newCustomer->setUsername($username) : "";
        $someArray["user_password"] = $newCustomer->setUser_password($user_password) == true 
            ? $newCustomer->setUser_password($user_password) : "";
        $someArray["picture"] = $newCustomer->setPicture($picture) == true 
            ? $newCustomer->setPicture($picture) : "";
        
        $canInsertNewCustomer = true;
        
        foreach ($someArray as $value){
            if($value != ""){
                $canInsertNewCustomer = false;
            }
        }
        
        if($canInsertNewCustomer)
        {
            echo"YAYYYY";
        }
    }
}

generateRegisterForm($errorMessageTable);

echo "wololo";
insertNewUser($errorMessageTable);

<?php
#For bigger images : please set the [mysqld] max_allowed_packet setting to a higher limit in /etc/my.cnf
#https://stackoverflow.com/questions/7942154/mysql-error-2006-mysql-server-has-gone-away#9479681

const INIT  = 'php/init.php';
require_once INIT;

require_once FILE_CLASSES_CUSTOMER;

#See function details for more info
executePageInitializationFunctions();

//Creating a title variable for this page
$pageTitle = "Register";

$errorMessageTable = array(
    "firstname" => "",
    "lastname" => "",
    "address" => "",
    "city" => "",
    "province" => "",
    "postalcode" => "",
    "username" => "",
    "user_password" => "",
    "picture" => "",
);

$successMessage = "";

generatePageTop($pageTitle, FILE_CSS_REGISTER);
generateLogo();

registerCustomer($errorMessageTable, $successMessage);
generateRegisterForm($errorMessageTable, isset($successMessage) ? $successMessage : "");

generatePageBottom();

########################################################################
# PAGE-SPECIFIC FUNCTIONS BELOW
########################################################################



function generateRegisterForm($errorMessageTable, $successMessage)
{
    ?>
        <div class="registerPage">
        <span id="required">* = required</span>
        <form id="registerForm" method="post" enctype="multipart/form-data">
            <p id="successMessage"><?php echo $successMessage ?></p>
            <?php  
            
                $text = "text";
                $password = "password";
                
                generateRegisterField("firstname", "First Name:", "My first name", $errorMessageTable, $text);
                generateRegisterField("lastname", "Last Name:", "My last name", $errorMessageTable, $text);
                generateRegisterField("address", "Address:", "My address", $errorMessageTable, $text);
                generateRegisterField("city", "City:", "My city", $errorMessageTable, $text);
                generateRegisterField("province", "Province:", "My province", $errorMessageTable, $text);
                generateRegisterField("postalcode", "Postal code:", "My postal code", $errorMessageTable, $text);
                generateRegisterField("username", "Username:", "My username", $errorMessageTable, $text);
                generateRegisterField("user_password", "Password:", "My password", $errorMessageTable, $password);
            ?>
            
            <label for="picture">Picture: </label>
            <input id="picture" type="file" name="picture" placeholder="picture" accept="image/png, image/jpeg">
                <?php echo generateRedStar() ?>
            
            <span class="formErrorSpan"><?php echo $errorMessageTable["picture"]; ?></span>

            <br>

            <button id="submitButton" type="submit" name="register">Register</button>
            
        </form>
    </div>
    <?php
}

function generateRegisterField($fieldName, $label, $placeholder, $errorMessageTable, $type){
    ?>
        <label for="<?php echo $fieldName?>"><?php echo $label?> </label>
        <input id="<?php echo $fieldName?>" 
               type="<?php echo $type ?>" name="<?php echo $fieldName?>" 
               placeholder="<?php echo $placeholder?>" 
               value="<?php echo isset($_POST[$fieldName]) 
                    ? filter_input(INPUT_POST, $fieldName) : "" ?>">
        <?php echo generateRedStar() ?>
        <span class="formErrorSpan"><?php echo $errorMessageTable[$fieldName]; ?></span>
        <br>
    <?php
}

function registerCustomer(&$errorMessageTable, &$successMessage){
    
    if (! isset($_POST["register"]))
    {
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

    if ($_FILES["picture"]["error"] == UPLOAD_ERR_OK && is_uploaded_file($_FILES["picture"]["tmp_name"])) 
    {
        $picture = file_get_contents($_FILES["picture"]["tmp_name"]);
    } 
    
    $newCustomer = new Customer();

    $errorMessageTable["firstname"] = $newCustomer->setFirstname($firstname) 
        ? $newCustomer->setFirstname($firstname) : "";
    $errorMessageTable["lastname"] = $newCustomer->setLastname($lastname)
        ? $newCustomer->setLastname($lastname) : "";
    $errorMessageTable["address"] = $newCustomer->setAddress($address) 
        ? $newCustomer->setAddress($address) : "";
    $errorMessageTable["city"] = $newCustomer->setCity($city)
        ? $newCustomer->setCity($city) : "";
    $errorMessageTable["province"] = $newCustomer->setProvince($province)
        ? $newCustomer->setProvince($province) : "";
    $errorMessageTable["postalcode"] = $newCustomer->setPostalcode($postalcode)
        ? $newCustomer->setPostalcode($postalcode) : "";
    $errorMessageTable["username"] = $newCustomer->setUsername($username)
        ? $newCustomer->setUsername($username) : "";
    
    //checking if username is a duplicate ;)
    if ($newCustomer->isUsernameDuplicate())
    {
        $errorMessageTable["username"] = "This username is already registered";
    }
    
    $errorMessageTable["user_password"] = $newCustomer->setUser_password($user_password)
        ? $newCustomer->setUser_password($user_password) : "";
    $errorMessageTable["picture"] = $newCustomer->setPicture($picture)
        ? $newCustomer->setPicture($picture) : "";
    
    if (checkForErrorsInArray($errorMessageTable)) {
        return null;
    }
    
    $hashedPassword = password_hash($user_password, PASSWORD_DEFAULT);
    $newCustomer->setUser_password($hashedPassword);
    $newCustomer->save();
    $successMessage = "Registration completed successfully!";
    $_POST = [];
    
}

function checkForErrorsInArray($errorMessageTable)
{
    foreach ($errorMessageTable as $value) {
        if (!empty($value)) {
            return true;
        }
    }
    return false;
}
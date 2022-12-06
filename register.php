<?php
#For bigger images : please set the [mysqld] max_allowed_packet setting to a higher limit in /etc/my.cnf
#https://stackoverflow.com/questions/7942154/mysql-error-2006-mysql-server-has-gone-away#9479681


 

const INIT  = 'php/init.php';
require_once INIT;
require_once CUSTOMER;



#opening a session to share variables on all pages
openSession();

#Making page https only
forceHttps();

//Adding error handling
addErrorHandling();

//Adding page headers
addCachingPreventionHeaders();
addContentTypeHeader();

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

if (isset($_POST["register"])) {

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

    $newCustomer = new customer();
    $canInsertNewCustomer = true;

    $errorMessageTable["firstname"] = $newCustomer->setFirstname($firstname) == true ? $newCustomer->setFirstname($firstname) : "";
    $errorMessageTable["lastname"] = $newCustomer->setLastname($lastname) == true ? $newCustomer->setLastname($lastname) : "";
    $errorMessageTable["address"] = $newCustomer->setAddress($address) == true ? $newCustomer->setAddress($address) : "";
    $errorMessageTable["city"] = $newCustomer->setCity($city) == true ? $newCustomer->setCity($city) : "";
    $errorMessageTable["province"] = $newCustomer->setProvince($province) == true ? $newCustomer->setProvince($province) : "";
    $errorMessageTable["postalcode"] = $newCustomer->setPostalcode($postalcode) == true ? $newCustomer->setPostalcode($postalcode) : "";
    $errorMessageTable["username"] = $newCustomer->setUsername($username) == true ? $newCustomer->setUsername($username) : "";
    $errorMessageTable["user_password"] = $newCustomer->setUser_password($user_password) == true ? $newCustomer->setUser_password($user_password) : "";
    $errorMessageTable["picture"] = $newCustomer->setPicture($picture) == true ? $newCustomer->setPicture($picture) : "";

    if (checkForErrorsInArray($errorMessageTable)) {
        $canInsertNewCustomer = false;
    }

    $SQLquery = "CALL procedure_get_password_from_username(:username)";
    $rows = $connection->prepare($SQLquery);
    $rows->bindParam(":username", $username, PDO::PARAM_STR);

    if ($rows->execute()) {
        while ($row = $rows->fetch()) {
            if ($row["username"] == $username && !empty($row["username"])) {
                $errorMessageTable["username"] = "Username already exists";
                $canInsertNewCustomer = false;
            }
        }
    }

    $rows->closeCursor();

    if ($canInsertNewCustomer) {
        $SQLquery = "CALL procedure_customers_insert_one("
            . ":firstname,"
            . ":lastname,"
            . ":address,"
            . ":city,"
            . ":province,"
            . ":postalcode,"
            . ":username,"
            . ":user_password,"
            . ":picture )";

        $hashedPassword = password_hash($user_password, PASSWORD_DEFAULT);

        $rows = $connection->prepare($SQLquery);

        $rows->bindParam(":firstname", $firstname, PDO::PARAM_STR);
        $rows->bindParam(":lastname", $lastname, PDO::PARAM_STR);
        $rows->bindParam(":address", $address, PDO::PARAM_STR);
        $rows->bindParam(":city", $city, PDO::PARAM_STR);
        $rows->bindParam(":province", $province, PDO::PARAM_STR);
        $rows->bindParam(":postalcode", $postalcode, PDO::PARAM_STR);
        $rows->bindParam(":username", $username, PDO::PARAM_STR);
        $rows->bindParam(":user_password", $hashedPassword, PDO::PARAM_STR);
        $rows->bindParam(":picture", $picture);

        if ($rows->execute()) {
            echo $rows->rowCount() . " customer was added successfully!";
            $_POST = array();
        }
    }
}

generateRegisterForm($errorMessageTable);

################################################################################
#                              Functions
################################################################################

function checkForErrorsInArray($errorMessageTable)
{
    foreach ($errorMessageTable as $value) {
        if (!empty($value)) {
            return true;
        }
    }
    return false;
}




function generateRegisterForm($errorMessageTable)
{

    ?>
    <div class="registerPage">
        <form method="post" enctype="multipart/form-data">

            <label for="firstname">First name: </label>

            <input id="firstname" type="text" name="firstname" placeholder="Firstname" 
                   value="<?php echo isset($_POST["lastname"]) ? filter_input(INPUT_POST, 'firstname') : "" ?>"></input>
            <span class="formErrorSpan"><?php echo $errorMessageTable["firstname"]; ?></span>

            <br>

            <label for="lastname">Last name: </label>

            <input id="lastname" type="text" name="lastname" placeholder="Lastname" 
                   value="<?php echo isset($_POST["lastname"]) ? filter_input(INPUT_POST, 'lastname') : "" ?>"></input>
            <span class="formErrorSpan"><?php echo $errorMessageTable["lastname"]; ?></span>

            <br>

            <label for="address">Address: </label>
            <input id="address" type="text" name="address" placeholder="Address"
                   value="<?php echo isset($_POST["address"]) ? filter_input(INPUT_POST, 'address') : "" ?>"></input>
            <span class="formErrorSpan"><?php echo $errorMessageTable["address"]; ?></span>

            <br>

            <label for="city">City: </label>
            <input id="city" type="text" name="city" placeholder="City"
                   value="<?php echo isset($_POST["city"]) ? filter_input(INPUT_POST, 'city') : "" ?>"></input>
            <span class="formErrorSpan"><?php echo $errorMessageTable["city"]; ?></span>

            <br>

            <label for="province">Province: </label>
            <input id="province" type="text" name="province" placeholder="Province"
                   value="<?php echo isset($_POST["province"]) ? filter_input(INPUT_POST, 'province') : "" ?>"></input>
            <span class="formErrorSpan"><?php echo $errorMessageTable["province"]; ?></span>

            <br>

            <label for="postalcode">Postal code: </label>
            <input id="postalcode" type="text" name="postalcode" placeholder="Postalcode"
                   value="<?php echo isset($_POST["postalcode"]) ? filter_input(INPUT_POST, 'postalcode') : "" ?>"></input>
            <span class="formErrorSpan"><?php echo $errorMessageTable["postalcode"]; ?></span>

            <br>

            <label for="username">Username: </label>
            <input id="username" type="text" name="username" placeholder="Username"
                   value="<?php echo isset($_POST["username"]) ? filter_input(INPUT_POST, 'username') : "" ?>"></input>
            <span class="formErrorSpan"><?php echo $errorMessageTable["username"]; ?></span>

            <br>

            <label for="user_password">Password: </label>
            <input id="user_password" type="password" name="user_password" placeholder="Password"
                   value="<?php echo isset($_POST["user_password"]) ? filter_input(INPUT_POST, 'user_password') : "" ?>"></input>
            <span class="formErrorSpan"><?php echo $errorMessageTable["user_password"]; ?></span>

            <br>

            <label for="picture">Picture: </label>
            <input id="picture" type="file" name="picture" placeholder="picture" accept="image/png, image/jpeg"></input>
            <span class="formErrorSpan"><?php echo $errorMessageTable["picture"]; ?></span>

            <br>

            <button id="submitButton" type="submit" name="register">Register</button>
        </form>
    </div>
    <?php
}

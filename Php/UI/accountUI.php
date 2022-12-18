<?php

function generateAccountForm($errorMessageTable, $successMessage) {
    if (!isUserConnected()) {
        return null;
    }
    
    $currentCustomer = new Customer();
    $currentCustomer->load($_SESSION["connectedUser"]);
    
    ?>
        <div class="AccountPage">
            <span id="required">* = required</span>
            <form id="registerForm" method="post" enctype="multipart/form-data">
                <p id="successMessage"><?php echo $successMessage ?></p>
                <?php
                    $textType = "text";
                    $passwordType = "password";
                    $fileType = "file";
                    $empty = "";
                    $pictureAccept = "image/png, image/jpeg";
                    
                    generateRegisterField("firstname", "First Name:", "My first name", $errorMessageTable, $textType, $empty, $currentCustomer);
                    generateRegisterField("lastname", "Last Name:", "My last name", $errorMessageTable, $textType, $empty, $currentCustomer);
                    generateRegisterField("address", "Address:", "My address", $errorMessageTable, $textType, $empty, $currentCustomer);
                    generateRegisterField("city", "City:", "My city", $errorMessageTable, $textType, $empty, $currentCustomer);
                    generateRegisterField("province", "Province:", "My province", $errorMessageTable, $textType, $empty, $currentCustomer);
                    generateRegisterField("postalcode", "Postal code:", "My postal code", $errorMessageTable, $textType, $empty, $currentCustomer);
                    generateRegisterField("username", "Username:", "My username", $errorMessageTable, $textType, $empty, $currentCustomer);
                    generateRegisterField("user_password", "Password:", "My password", $errorMessageTable, $passwordType, $empty, $currentCustomer);
                    generateRegisterField("picture", "Picture:", "My picture", $errorMessageTable, $fileType, $pictureAccept, $currentCustomer);
                ?>
                
                
                <button id="submitButton" type="submit" name="update">Update Info</button>
            </form>
        </div>
    <?php
}

function generateRegisterField($fieldName, $label, $placeholder, $errorMessageTable, $type, $accept, $currentCustomer){
    $imageSource = "";
    ?>
        <label for="<?php echo $fieldName?>"><?php echo $label?> </label>
        <input id="<?php echo $fieldName?>" 
               type="<?php echo $type ?>"
               
               name="<?php echo $fieldName?>" 
               placeholder="<?php echo $placeholder?>" 
               accept="<?php echo $accept?>"
               value="<?php 
                            if(isset($_POST["update"])){
                                if(isset($_POST[$fieldName]) && $_POST[$fieldName] != "password"){
                                    echo $_POST[$fieldName];
                                }
                                $formImage = base64_encode($currentCustomer->getPicture());
                            } else {
                                switch ($fieldName){
                                case "firstname":
                                    echo $currentCustomer->getFirstname();
                                    break;
                                case "lastname":
                                    echo $currentCustomer->getLastname();
                                    break;
                                case "address":
                                    echo $currentCustomer->getAddress();
                                    break;
                                case "city":
                                    echo $currentCustomer->getCity();
                                    break;
                                case "province":
                                    echo $currentCustomer->getProvince();
                                    break;
                                case "postalcode":
                                    echo $currentCustomer->getPostalcode();
                                    break;
                                case "username":
                                    echo $currentCustomer->getUsername();
                                    break;
                                default:
                                    echo "";
                                    break;
                                }
                            }
                      ?>">
    <?php 
        echo generateRedStar();
        ?>  <span class="formErrorSpan"><?php echo $errorMessageTable[$fieldName] ?></span>
            <br>
        <?php
}
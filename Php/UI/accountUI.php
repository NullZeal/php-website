<?php

function generateAccountForm($errorMessageTable, $successMessage)
{
    
    if (!isUserConnected()) 
    {
        return null;
    }
    
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
<?php

$globalFunctions = 'php/globalFunctions.php';
require_once $globalFunctions;

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

function generateRegisterForm()

{
    ?>
        
        <form></form>
        <label>



    <?php
    
}
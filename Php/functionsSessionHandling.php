<?php

function generateLoginLogout($connection)
{
    if (isset($_SESSION["connectedUser"])) {

        if (!isset($_POST["logout"])) {

            $currentCustomer = new Customer();
            $currentCustomer->load($_SESSION["connectedUser"], $connection);
            
            generateLogout(
                $currentCustomer->getFirstname(),
                $currentCustomer->getLastname(),
                $currentCustomer->getPicture());
        } else {

            $_SESSION = [];
            $_POST = [];
            $errorMessage = "";

            generateLoginForm($errorMessage, FILE_PAGE_REGISTER);
        }
        return null;
    }

    if (!isset($_POST["login"])) {
        $errorMessage = "";
        generateLoginForm($errorMessage, FILE_PAGE_REGISTER);
        return null;
    }

    if ($_POST["username"] == "" || $_POST["password"] == "") {

        $errorMessage = "Invalid credentials";
        generateLoginForm($errorMessage, FILE_PAGE_REGISTER);
        return null;
    }

#At this point there is content in both username and password posts
#ready to be validated

    $username = htmlspecialchars($_POST["username"]);
    $password = htmlspecialchars($_POST["password"]);
    
    $customerValidationToken = validateUserCredentials($username, $password, $connection);

    if ($customerValidationToken) {

        $validatedUser = new Customer();
        
        $validatedUser->load($customerValidationToken, $connection);
        
        $_SESSION["connectedUser"] = $validatedUser->getId();

        generateLogout(
            $validatedUser->getFirstname(),
            $validatedUser->getLastname(),
            $validatedUser->getPicture());
        
    } else {
        $errorMessage = "Invalid credentials";
        generateLoginForm($errorMessage, FILE_PAGE_REGISTER);
    }
}

function generateLogout($firstname, $lastname, $picture)
{
    generateLogoutForm($firstname, $lastname, $picture);
}

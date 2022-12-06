<?php

function generateLoginLogout($connection)
{
    if (isset($_SESSION["connectedUser"])) {

        if (!isset($_POST["logout"])) {

            generateLogout($_SESSION["connectedUser"]);
            
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

if (validateUserCredentials($username, $password, $connection)) {

    $validatedUser = new customer();
    $validatedUser->load($username, $connection);
    $_SESSION["connectedUser"] = $validatedUser;
    
    #setcookie("connectedUser", $_COOKIE[loggedUser], time() + 60 * 10);

    echo $validatedUser->getId();

    generateLogout($validatedUser);
} else {
    $errorMessage = "Invalid credentials";
    generateLoginForm($errorMessage, FILE_PAGE_REGISTER);
}
}

function generateLogout()
{
    generateLogoutForm(FILE_PAGE_REGISTER);
}
// base64_encode($screenshot)
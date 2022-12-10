<?php

require_once FILE_CLASSES_CUSTOMER;

$errorMessage = "Invalid credentials";

function generateLoginLogout()
{
    //Setting up the 2 possible login error messages
    global $errorMessage;
    $emptyString = "";
    
    //Checking if a customer is logged in
    if (isUserConnected()) 
    {
        //Checking if the customer's has no intention to log out
        if (!isset($_POST["logout"])) 
        {
            $currentCustomer = new Customer();
            $currentCustomer->load($_SESSION["connectedUser"]);
            
            generateLogoutForm(
                $currentCustomer->getFirstname(),
                $currentCustomer->getLastname(),
                $currentCustomer->getPicture());
        } 
        //Checking if the customer wants to log out
        else 
        {
            //Disconnecting the user
            $_SESSION = [];
            $_POST = [];
            
            generateLoginForm($emptyString, FILE_PAGE_REGISTER);
        }
        return null;
    }
    //At this point we know that no customers are logged in
    
    //Checking if the customer has 
    //  not yet tried to log in
    //  username is empty
    //  password is empty
    
    if (! isset($_POST["login"]))
    {
        //Pushing back the user login WITHOUT an error message
        generateLoginForm($emptyString, FILE_PAGE_REGISTER);
        return null;
    }
    
    if ($_POST["username"] == "" || $_POST["password"] == "" )
    {
        //Pushing back the user login WITH an error message
        generateLoginForm($errorMessage, FILE_PAGE_REGISTER);
        return null;
    }
    
    #At this point we know that a user tried to log in and has filled the form
    

    $username = htmlspecialchars($_POST["username"]);
    $password = htmlspecialchars($_POST["password"]);
    
    $newCustomer = new Customer();
    
    $newCustomer->setUsername($username);
    $newCustomer->setUser_password($password);
    
    #We will try to validate his credentials (and get his id at the same time)
    if ($newCustomer->validateCredentials())
    {
        $newCustomer->load($newCustomer->getId());
        
        //On success, we add a session cookie that contains only the id of the customer
        $_SESSION["connectedUser"] = $newCustomer->getId();
        
        generateLogoutForm(
            $newCustomer->getFirstname(),
            $newCustomer->getLastname(),
            $newCustomer->getPicture());
        
    } 
    //On failed validation, we reload the login with an error message
    else 
    {
        generateLoginForm($errorMessage, FILE_PAGE_REGISTER);
    }
}   

function isUserConnected()
{
    return isset($_SESSION["connectedUser"]) ? true : false;
}
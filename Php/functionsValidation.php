<?php
#-------------------------------------------------------------------
#Revision History
# 
#DEVELOPER                      DATE             COMMENTS
#Julien Pontbriand (2135020)    Oct. 7, 2022     File creation. Added constants for 2 folders. Added constant for some files. Added variable for a file's path. Added a function to generate page headers in other files. Added a function to generate page footers. Added a function to generate a logo.
#
#Julien Pontbriand (2135020)    Oct. 22, 2022    Refactored the constants for the folders and files. Added functions to open and close some HTML tags. Added a function to generate the navigation panel. 
#
#Julien Pontbriand (2135020)    Oct. 23, 2022    Added functions to manage errors on pages. Minor refactoring.
#
#Julien Pontbriand (2135020)    Oct. 29, 2022    Removed logo variable. Refactored error functions. Added constant for download button. Minor code refactoring.
#
#Julien Pontbriand (2135020)    Oct. 29, 2022    Added more code comments to the file. Indendation has been reviewed. Fixed the logo generation function to be non case-sensititve
#
#Julien Pontbriand (2135020)    Nov. 29, 2022    Added the forcehttps function. 
#-------------------------------------------------------------------

require_once CUSTOMER;

function validateUserCredentials($username, $password, $connection)
{
    $SQLquery = Database2135020_Procedures_Customers::GET_USERNAME_PASSWORD . "(:username)";
    $rows = $connection->prepare($SQLquery);
    $rows->bindParam(":username", $username, PDO::PARAM_STR);

    if ($rows->execute()) {
        while ($row = $rows->fetch()) {
            if ($row["username"] == $username) {
                return password_verify($password, $row["user_password"]);
            }
        }
    }
    return false;
}
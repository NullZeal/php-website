<?php
//The name of the following variables start as 'css' to facilitate finding 
//their references in the page php files
$cssIndex = "css/index.css";
$cssBuying = "css/buying.css";
$cssOrders = "css/orders.csss";
$cssReset = "css/reset.css";

define("FOLDER_CSS", "css/");
define("FILE_RESET_CSS", FOLDER_CSS . "reset.css");

//The function pageTop() function will take both a title and a css argument, defined in their respective php pages, to ensure a dynamic approach. This function is created to generate the html boilerplates dynamically.
function pageTop($title, $cssFile){
    ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta title="Home Page">
        <title><?php echo $title; ?></title>
        <link rel="stylesheet" type="text/css" href="<?php echo $cssFile; ?>">
        <?php 
        // Below I added the reset file as a constant define in the page top to show that I ca           n also use constants to reference a file
        ?> 
        <link rel="stylesheet" type="text/css" href="<?php echo FILE_RESET_CSS; ?>">
    </head>


<?php
}
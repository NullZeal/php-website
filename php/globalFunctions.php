<?php
//The name of the following variables start as 'css' to facilitate finding their references in the page php files
$cssHomePage = "css/index.css";
$cssBuying = "css/buying.css";
$cssOrders = "css/orders.csss";
$cssReset = "css/reset.css";

//Creating a constant for the css folder and some css files
define("FOLDER_CSS", "css/");
define("FILE_RESET_CSS", FOLDER_CSS . "reset.css");
define("FILE_GLOBAL_CSS", FOLDER_CSS . "global.css");

//Creating a variable for the logo of the company
$pictureLogo = "pictures/logo.png";

//The function generatePageHead() will take both a title and a css argument, defined in their respective php pages, to ensure a dynamic approach. This function is created to generate the html boilerplates dynamically.
function generatePageHead($title, $cssFile) {
    ?>
    <!DOCTYPE html>
    <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta title="Home Page">
            <title><?php echo $title; ?></title>

            <?php //Below I added the reset and global files as a constant with the define in the top of the page to show that I can also use constants to reference a file.?> 
            <link rel="stylesheet" type="text/css" href="
                  <?php echo FILE_RESET_CSS; ?>">
            <link rel="stylesheet" type="text/css" href="
                  <?php echo FILE_GLOBAL_CSS; ?>">

            <?php //Below I added the page specific css file last with the variable taken from the function parameter?> 
            <link rel="stylesheet" type="text/css" href="
                  <?php echo $cssFile; ?>">
        </head>

        <?php
    }

    function generatePageFooter() {
        ?>
        <footer>
            Copyright Julien Pontbriand (202135020) 2022.        
        </footer>
    </html>
    <?php
}

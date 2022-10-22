<?php
//The name of the following variables start as 'css' to facilitate finding their references in the page php files
$cssHomePage = "css/index.css";
$cssBuying = "css/buying.css";
$cssOrders = "css/orders.csss";
$cssReset = "css/reset.css";

//Creating a constant for olders
define("FOLDER_CSS", "css/");
define("FOLDER_PICTURES", "pictures/");

//Creating a constant for iles
define("FILE_CSS_RESET", FOLDER_CSS . "reset.css");
define("FILE_CSS_GLOBAL", FOLDER_CSS . "global.css");
define("FILE_PICTURES_LOGO", FOLDER_PICTURES . "logo.png");

//Creating a variable for the logo of the company
$pictureLogo = "pictures/logo.png";

//The function generatePageHead() will take both a title and a css argument, defined in their respective php pages, to ensure a dynamic approach. This function is created to generate the html boilerplates dynamically.
function generatePageHead($title, $cssFile)
{

    ?><!DOCTYPE html>
                <html lang="en">
                    <head>
                        <meta charset="UTF-8">
                        <meta title="Home Page">
                        <title><?php echo $title; ?></title>
            <?php //Below I added the reset and global files as a constant with the define in the top of the page to show that I can also use constants to reference a file.  ?> 
                        <link rel="stylesheet" type="text/css" href="<?php echo FILE_CSS_RESET; ?>">
                        <link rel="stylesheet" type="text/css" href="<?php echo FILE_CSS_GLOBAL; ?>">
            <?php //Below I added the page specific css file last with the variable taken from the function parameter  ?> 
                        <link rel="stylesheet" type="text/css" href="<?php echo $cssFile; ?>">
                    </head>
                  <?php
              }

              function generatePageFooter()
{
    ?>
            <footer>
            Copyright Julien Pontbriand (202135020) 2022.        
            </footer>
        </html>
    <?php
}

function generateNavigationMenu()
{
    
}

function generateLogo()
{

    ?>
    <img id="logo" src="<?php echo FILE_PICTURES_LOGO; ?>" alt="logo of Julien Pontbriand inc." />
    <?php
}

function generateIndexPage()
{

    ?>
    <body>
        <div>
            <?php generateLogo(); ?>
            <h1>Pontbriand inc.</h1>
            <h2>Privacy at it's best. Because everybody has something to hide. And that's perfectly fine.</h2>
            <p>At Pontbriand inc., we believe in a free and secure Internet.
                We offer the world open source technologies tocompete agains't the products offered by companies that do not respect your rights.</p>

        </div>
        <section>

        </section>

    </body>
    <?php
}


function addCachingPreventionHeaders(){
    header("Expires: Tue, 29, Nov 1994 13:00 GMT");
    header("Cache-Control: no-cache");
    header("Pragma: no-cache");
}

function addContentTypeHeader(){
    header('Content-type: text/html; charset=UTF-8');
}
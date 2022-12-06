<?php

function generatePageHead($title, $cssFile)
{

    ?>  
    <head>
        <meta charset="UTF-8">
        <meta title="Home Page"><title><?php echo $title; ?></title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php //Below I added  the global CSS file as a constant with the define in the top of the page to show that I can use constants to reference a file.   ?>
        <link rel="stylesheet" type="text/css" href="<?php echo FILE_CSS_GLOBAL; ?>">
    <?php //Below I added the page specific css file last with the variable taken from the function parameter  ?>
        <link rel="stylesheet" type="text/css" href="<?php echo $cssFile; ?>">
    </head>
    <?php
}
#This function generates the navigation menu

function generateNavigationMenu()
{

    ?>

    <div class="navigation">
        <a href="<?php echo FILE_PAGE_INDEX ?>">Home</a>
        <a href="<?php echo FILE_PAGE_BUYING ?>">Buying</a>
        <a href="<?php echo FILE_PAGE_ORDERS ?>">Orders</a>
        <a href="<?php echo FILE_PAGE_REGISTER ?>">Register</a>
    </div>

    <?php
}
#This function generates the footer menu

function generatePageFooter()
{

    ?>    <footer>
        Copyright Julien Pontbriand (202135020) <?php echo date("Y") ?>

    </footer>    
    <?php
}

function openDoctypeTag()
{

    ?><!DOCTYPE html><?php
    }

    function openHtmlTag()
    {

        ?><html lang="en"><?php
        }

        function closeHtmlTag()
        {

            ?></html><?php
}
#generates the doctype tag
#generates the html tag
#closes html tag
#generates the body tag

function openBodyTag()
{

    ?>

    <body id="<?php
    if (isset($_GET["action"]) && strtolower($_GET["action"] == "print")) {
        echo "bodyPrint";
    } else {
        echo "";
    }

    ?>"><?php
}

function closeBodyTag()
{

    ?></body><?php
}
#The function generatePageHead() will take both a title and a css argument, 
#defined in their respective php pages, to ensure a dynamic approach. 


#This function generates a logo image

function generateLogo()
{

    ?><img id="<?php
    if (isset($_GET["action"]) && strtolower($_GET["action"]) == "print") {
        echo "logoPrint";
    } else {
        echo "logo";
    }

    ?>" src="<?php echo FILE_MEDIA_IMAGE_LOGO; ?>" alt="logo of Julien Pontbriand inc." />
    <?php
}
#This function adds caching headers


# This generates a red star character

function generateRedStar()
{
    echo "<span class='red'>*</span>";
}

function generateLoginForm($errorMessage, $registerUrl)
{

    ?>

    <div>
        <form id="loginForm" method="post">
            
            <button id="loginButton" type="submit" name="login">Login</button>
            <label for="username">Username: </label>
            <input id="username" type="text" 
                   name="username" placeholder="Username"></input>

            <label for="password">Password: </label>
            <input id="password" type="text" 
                   name="password" placeholder="Password"></input>
            <span class="formLoginSpan"><?php echo $errorMessage; ?></span>
            

        </form>
    </div>
    <?php
}

function generateLogoutForm($registerUrl)
{

    ?>

    <div>
        <form id="logoutForm" method="post">
            
            <img id="customerImage" src="<?php  ?>">
            <label for="customerImage"></label>

            <button type="submit" name="logout">Logout</button>

        </form>
    </div>
    <?php
}
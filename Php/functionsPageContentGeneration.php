<?php

function generatePageTop($title, $cssFile)
{
    openDoctypeTag();
    openHtmlTag();
    generateHead($title, $cssFile);
    openBodyTag();
    generateNavigationMenu();
}

function generatePageBottom()
{
    generatePageFooter();
    closeBodyTag();
    closeHtmlTag();
}

function openDoctypeTag()
{
    ?><!DOCTYPE html><?php
}

function openHtmlTag()
{
    ?><html lang="en"><?php
}

function generateHead($title, $cssFile)
{
    ?>  
        <head>
            <meta charset="UTF-8">
            <meta title="Home Page"><title><?php echo $title; ?></title>
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="stylesheet" type="text/css" href="<?php echo FILE_CSS_GLOBAL; ?>">
            <link rel="stylesheet" type="text/css" href="<?php echo $cssFile; ?>">
        </head>
    <?php
}

function generateNavigationMenu()
{
    ?>
        <div class="navigation">
            <a href="<?php echo FILE_PAGE_INDEX ?>">Home</a>
            <a href="<?php echo FILE_PAGE_BUYING ?>">Buying</a>
            <a href="<?php echo FILE_PAGE_ORDERS ?>">Orders</a>
        </div>

    <?php
}
function generatePageFooter()
{
    ?>
        <footer>Copyright Julien Pontbriand (202135020) <?php echo date("Y") ?></footer>
    <?php
}

function closeHtmlTag()
{
    ?></html><?php
}

function openBodyTag()
{
    ?>
        <body id="<?php 
                        if (isset($_GET["action"]) 
                            && strtolower($_GET["action"] == "print")) 
                            {
                                echo "bodyPrint";
                            } else 
                            {
                                echo "";
                            }?>">
    <?php
}

function closeBodyTag()
{
    ?></body><?php
}

function generateLogo()
{
    ?><img id="<?php
        if (isset($_GET["action"]) && strtolower($_GET["action"]) == "print") {
            echo "logoPrint";
        } else {
            echo "logo";
        }

        ?>" src="<?php echo FILE_MEDIA_IMAGE_LOGO; ?>"
            alt="logo of Julien Pontbriand inc." 
        />
    <?php
}

function generateRedStar()
{
        echo "<span class='red'>*</span>";
}

function generateLoginForm($errorMessage, $registerUrl)
{
    ?>

    <div>
        <form id="loginForm" method="post">

            <label for="username">Username: </label>
            <input id="username" type="text" 
                   name="username" placeholder="Username">

            <label for="password">Password: </label>
            <input id="password" type="password" 
                   name="password" placeholder="Password">
            
            <button id="loginButton" type="submit" name="login">Login</button>
            
            <span class="formLoginSpan"><?php echo $errorMessage; ?> - <a href="<?php echo FILE_PAGE_REGISTER ?>">Register</a></span>
            
            <br>
        </form>
    </div>
    <?php
}

function generateLogoutForm($firstname, $lastname, $picture)
{
    ?>
    <div>
        <form id="logoutForm" method="post">
            <img 
                class="profilePicture" 
                id="customerImage" 
                src="data:image;base64,<?php echo base64_encode($picture) ?>">
            
            <h4 
                class="welcome">Welcome <?php echo $firstname . " " . $lastname . "!" ?>
            </h4>
            
            <label for="customerImage"></label>

            <button id="btnLogout" type="submit" name="logout">Logout</button>
        </form>
    </div>
    <?php
}

function generateErrorMessage($errorMessage)
{
    ?>
    <div id="pageLoginErrorMessage"><?php echo $errorMessage ?> </div>
    <?php
}
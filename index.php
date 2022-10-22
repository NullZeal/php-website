<?php
//Importing global functions from the relative path given in $globalFunctions
$globalFunctions = 'php/globalFunctions.php';
require_once $globalFunctions;

//Adding a page headers
addCachingPreventionHeaders();
addContentTypeHeader();

//Creating a title variable for this page
$pageTitle = "Home Page";

function generateIndexPage()
{
    ?>

        <div class="companyDescription">
            <?php generateLogo() ?>
            <h1>
                ShinyBridge VPN
            </h1>
            <h2>
                Privacy at it's best.<br><br>Because everybody has something to hide. And that's perfectly fine.<br>
            </h2>
            <p>
                ShinyBridge VPN believes in a free and secure Internet.
                We offer the world open source technologies to compete with products offered by companies that do not respect your rights.
            </p>

        </div>

    <?php
}

openDoctypeTag();
openHtmlTag();
generatePageHead($pageTitle, FILE_CSS_INDEX);
openBodyTag();

generateNavigationMenu();
generateIndexPage();
generatePageFooter();

closeBodyTag();
closeHtmlTag();


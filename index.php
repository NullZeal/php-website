<?php
#-------------------------------------------------------------------
#Revision History
#
#DEVELOPER                      DATE             COMMENTS
#Julien Pontbriand (2135020)    Oct. 7, 2022     File creation. Added a link to the global functions file. Added a title. Added a function call to generate the HTML head. Added a function call to generate the Home page. Added a function call to generate the footer. 5h long code session.
#
#Julien Pontbriand (2135020)    Oct. 22, 2022    Added function calls to generathe page headers. Added the necessary functions and variables to generate a random image out of 5 preselected image on the home page. The function to generate the page-specific HTML sections of this file has been moved back inside of it.
#
#Julien Pontbriand (2135020)    Oct. 29, 2022    Added error handling. Minor refactoring.
#
#Julien Pontbriand (2135020)    Oct. 30, 2022    Final refactoring before midterm release : indent control. Added more comments to the file.
#
#Julien Pontbriand (2135020)    Nov. 29, 2022    Added the forcehttps function.
#-------------------------------------------------------------------

#Importing global functions from the relative path given in $globalFunctions
$globalFunctions = 'php/globalFunctions.php';
require_once $globalFunctions;

#opening a session to share variables on all pages
openSession();

#Making page https only
forceHttps();

//Adding error handling
addErrorHandling();
#To enter DEBUG mode, set DEBUGGING to true in the globalFunctions.php file
#Test it with :
#   Trigger_error("custom error", E_USER_ERROR); #generate error
#   Throw new Exception("custom exception"); #generate exception
//Adding page headers
addCachingPreventionHeaders();
addContentTypeHeader();

//Creating a title variable for this page
$pageTitle = "Home Page";

//This array will be used to select 1 out of 5 images
$productsArray = array(
    FILE_PICTURES_ADBLOCK,
    FILE_PICTURES_DISK,
    FILE_PICTURES_ENCRYPTION,
    FILE_PICTURES_PROTOCOL,
    FILE_PICTURES_SERVER);

//This function generates the html content for the Home Page
//By the way, ShinyBridge is a gag, because my name is Pontbriand :)
function generateIndexPage($productsArray)
{

    ?>

            <div class="companyDescription">
            <?php generateLogo() ?>
            <h1>ShinyBridge VPN</h1>
                <h2>
                    Privacy at it's best.<br><br>Because everybody has something
                    to hide. And that's perfectly fine.<br>
                </h2>
                <p>
                    ShinyBridge VPN believes in a free and secure Internet. We 
                    offer the world open source technologies to compete with 
                    products offered by companies that do not respect your 
                    rights.
                </p>
                <?php generateImageSection($productsArray); ?></div>
    <?php
}

//This function generates the section of the home page that has an image generator
function generateImageSection($productsArray)
{
    $randomNumber = random_int(0, 4); #index 0 to 4 means 5 items possible
    $productDescription = "";
    $imageClass = "products";

    switch ($randomNumber) {
        case 0:
            $productDescription = "integrated, VPN-level ad protection (5$/M)";
            break;
        case 1:
            $productDescription = "full disk encryption VPN servers (5$/M)";
            break;
        case 2:
            $productDescription = "encrypted traffic with AES-256 (10$/M)";
            $imageClass = "superProduct";
            break;
        case 3:
            $productDescription = "trusted protocols such as OpenVPN, IKEv2, and WireGuard (5$/M)";
            break;
        case 4:
            $productDescription = "servers located outside of the 5 eyes juridiction (5$/M)";
            break;
        default :
            echo "";
    }

    ?>

                <section>
                    <p class="title">We offer <?php echo $productDescription ?></p>

                    <a href="https://www.mozilla.org/en-US/products/vpn/">
                        <img class="<?php echo $imageClass ?>"
                            loading="lazy" 
                            src="<?php echo $productsArray[$randomNumber] ?>" 
                            alt="An image representing <?php echo $productDescription ?>"/>
                    </a>
                </section><?php
}
// ###Now generating the actual page###
// The next 4 functions generate the html for everything that's before the body
openDoctypeTag();
openHtmlTag();
generatePageHead($pageTitle, FILE_CSS_INDEX);
openBodyTag();

//The next 2 functions generate the core of the body
generateNavigationMenu();
generateIndexPage($productsArray);

//The next 3 functions generate the footer and the end of the html content
generatePageFooter();
closeBodyTag();
closeHtmlTag();

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
const INIT = 'php/init.php';
require_once INIT;

#See function details for more info
executePageInitializationFunctions();

$productsArray = array(
    FILE_MEDIA_IMAGE_ADBLOCK,
    FILE_MEDIA_IMAGE_DISK,
    FILE_MEDIA_IMAGE_ENCRYPTION,
    FILE_MEDIA_IMAGE_PROTOCOL,
    FILE_MEDIA_IMAGE_SERVER);

$pageTitle = "Home Page";

generatePageTop($pageTitle, FILE_CSS_INDEX);
generateLoginLogout($connection);
generateIndexPage($productsArray);
generatePageBottom();

########################################################################
# PAGE-SPECIFIC FUNCTIONS BELOW
########################################################################

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

    <a id="downloadButtonContainer" 
       href="Txt/cheat-sheet.html" 
       download="CheatSheet.html">

        <button id="btnDownload">Download the CheatSheet!</button>
    </a>
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
<?php
//Importing global functions from the relative path given in $globalFunctions
$globalFunctions = 'php/globalFunctions.php';
require_once $globalFunctions;

//Adding a page headers
addCachingPreventionHeaders();
addContentTypeHeader();

//Creating a title variable for this page
$pageTitle = "Home Page";

$productsArray = array(
    FILE_PICTURES_ADBLOCK,
    FILE_PICTURES_DISK,
    FILE_PICTURES_ENCRYPTION,
    FILE_PICTURES_PROTOCOL,
    FILE_PICTURES_SERVER);

function generateImageSection($productsArray){
    
    $randomNumber = random_int(0,4);
    $productDescription = "";
    $imageClass = "products";
    
    switch ($randomNumber) {
        case 0:
            $productDescription = "integrated, VPN-level ad protection";
            break;
        case 1:
            $productDescription = "full disk encryption VPN servers";
            break;
        case 2:
            $productDescription = "encrypted traffic with AES-256";
            $imageClass = "superProduct";
            break;
        case 3:
            $productDescription = "trusted protocols such as OpenVPN, IKEv2, and WireGuard";
            break;
        case 4:
            $productDescription = "servers located outside of the 5 eyes juridiction";
            break;
        default :
            echo "";
}
    
    ?>

            <section>
                <p class="title">We offer <?php echo $productDescription ?></p>
            
                <a href="https://www.mozilla.org/en-US/products/vpn/">
                    <img class="<?php echo $imageClass ?>" loading="lazy" src="<?php echo $productsArray[$randomNumber]?>" alt="An image representing <?php echo $productDescription ?>"/>
                </a>
            </section><?php
}

function generateIndexPage($productsArray)
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
            <?php generateImageSection($productsArray);?>

        </div>

    <?php
}

openDoctypeTag();
openHtmlTag();
generatePageHead($pageTitle, FILE_CSS_INDEX);
openBodyTag();

generateNavigationMenu();
generateIndexPage($productsArray);
generatePageFooter();

closeBodyTag();
closeHtmlTag();


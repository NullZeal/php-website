<?php

function generateIndexPage($productsArray)
{
    ?>
    <div class="companyDescription"><?php generateLogo() ?>
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
        
         <iframe id="videoEncryption" 
                 src="https://player.vimeo.com/video/368740653" 
                 title="Encryption"></iframe> 

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
<?php
#-------------------------------------------------------------------
#Revision History
#
#DEVELOPER                      DATE             COMMENTS
#Julien Pontbriand (2135020)    Oct. 7, 2022     File creation. Was quick to do.
#
#Julien Pontbriand (2135020)    Oct. 22, 2022    Added a link to the global functions page. Added function calls to generate the page headers. Created a title for the page (with the wrong name). Added a function to generate this page's unique html, as a copy / paste of my own index page. Called functions to generate the page.
#
#Julien Pontbriand (2135020)    Oct. 23, 2022    Refactored the page almost completely.  9h long session. Added a function to generate the rows of the table. Refactorted the function to display this page's html.
#
#Julien Pontbriand (2135020)    Oct. 29, 2022    Added error handling. Minor code refactoring
#
#Julien Pontbriand (2135020)    Oct. 30, 2022    Added more comments to the code. Indendation refactoring (especially for the table). 
#                                                The page source looks way cleaner now. Fixed the color of the columns always being added
#
#Julien Pontbriand (2135020)    Nov. 29, 2022    Added the forcehttps function.
#-------------------------------------------------------------------

//Importing global functions from the relative path given in $globalFunctions
const INIT  = 'php/init.php';
require_once INIT;

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

//Adding a page headers
addCachingPreventionHeaders();
addContentTypeHeader();

//Creating a title variable for this page
$pageTitle = "Orders Page";

function generateOrderRows() #This function generates the table rows (tr)
{
        $ordersFileHandle = fopen(FILE_TXT_ORDERS, "r");

        while (!feof($ordersFileHandle)) {
            $orderArray = (array)json_decode(fgets($ordersFileHandle));
            
            ?>  
                
                    <tr><?php 
            
            foreach ($orderArray as $order => $value) { ?><td id="<?php 
                if($order == 7 && isset($_GET["action"]) && strtolower($_GET["action"]) == "color"){
                            if($value < 100){
                                echo "tdRedColor";
                            }
                            elseif($value < 999.991){
                                echo "tdOrangeColor";
                            }
                            elseif($value >= 1000){
                                echo "tdGreenColor";
                            }
                }?>"><?php 
                
                if($order == 5 || $order == 7 || $order == 8 || $order == 9){
                            echo $value . "$";
                        }
                        else{ 
                            echo $value; 
                        }?> </td><?php 
                        
            }?></tr><?php
        }
}

function generateOrdersPage() 
{
    #this function generates most of the page specific html content, 
    #such as the table taht containts the rows generated by the previous
    #function
     if (file_exists(FILE_TXT_ORDERS)){
         ?>
        <div class="ordersTable">
            <?php generateLogo() ?>
            <table>
                    <tr>
                        <th>
                            Product<br>ID
                        </th>

                        <th>
                            First<br>Name
                        </th>

                        <th>
                            Last<br>Name
                        </th>

                        <th>
                            City
                        </th>

                        <th>
                            Comments
                        </th>

                        <th>
                            Price
                        </th>

                        <th>
                            Quantity
                        </th>

                        <th>
                            Subtotal
                        </th>

                        <th>
                            Taxes
                        </th>

                        <th>
                            Grand<br>Total
                        </th>
                    </tr><?php generateOrderRows(); ?>
                
            </table>
            
            <a id="downloadButtonContainer" href="Txt/cheatsheet.html" download="CheatSheet.html">
                <button id="btnDownload">Download the CheatSheet!</button>
            </a>

        </div>

        <?php
    } else{
        ?> <p id="noOrdersFound">No orders found!</p>
        <?php
    }
}

#These function calls will generate the page
openDoctypeTag();
openHtmlTag();
generatePageHead($pageTitle, FILE_CSS_ORDERS);
openBodyTag();

generateNavigationMenu();
generateOrdersPage();
generatePageFooter();

closeBodyTag();
closeHtmlTag();


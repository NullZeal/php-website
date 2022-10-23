<?php
//Importing global functions from the relative path given in $globalFunctions
$globalFunctions = 'php/globalFunctions.php';
require_once $globalFunctions;

//Adding a page headers
addCachingPreventionHeaders();
addContentTypeHeader();

//Creating a title variable for this page
$pageTitle = "Orders Page";

function generateOrderRows()
{
        $ordersFileHandle = fopen(FILE_TXT_ORDERS, "r");

        while (!feof($ordersFileHandle)) {
            $orderArray = (array)json_decode(fgets($ordersFileHandle));
            ?>
            <tr>
                    <?php 
                        foreach ($orderArray as $order => $value) { ?>
                        <td>
                        <?php 
                        if($order == 5 || $order == 7 || $order == 8 || $order == 9){
                            echo $value . "$";
                        }
                        else{ 
                            echo $value; 
                     }
                    ?>
                    </td><?php }
                ?>
            </tr>
            <?php
        }
}

function generateOrdersPage()
{
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
                </tr>
            <?php generateOrderRows(); ?>
            </table>

        </div>

        <?php
    } else{
        ?> <p id="noOrdersFound">No orders found!</p>
        <?php
    }
}
openDoctypeTag();
openHtmlTag();
generatePageHead($pageTitle, FILE_CSS_ORDERS);
openBodyTag();

generateNavigationMenu();
generateOrdersPage();
generatePageFooter();

closeBodyTag();
closeHtmlTag();


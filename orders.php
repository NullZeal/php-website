<?php
//Importing global functions from the relative path given in $globalFunctions
$globalFunctions = 'php/globalFunctions.php';
require_once $globalFunctions;

//Adding a page headers
addCachingPreventionHeaders();
addContentTypeHeader();

//Creating a title variable for this page
$pageTitle = "Orders Page";

function generateOrderRows(){
    
    if(file_exists(FILE_JSON_ORDERS)){
        
        $ordersFile = file_get_contents(FILE_JSON_ORDERS);
        $orders = json_decode($ordersFile, true);
        var_dump($orders);
        
        foreach($orders as $order){ ?>
                <tr>
                    <td>
                    <?php echo $order[0] ?>
                    </td>
                    
                    <td>
                        First Name
                    </td>
                    
                    <td>
                        Last Name
                    </td>
                    
                    <td>
                        City
                    </td>
                       
                    <td>
                        Comments
                    </td>
                    
                    <td>
                        Price
                    </td>
                    
                    <td>
                        Quantity
                    </td>
                    
                    <td>
                        Subtotal
                    </td>
                    
                    <td>
                        Taxes
                    </td>
                    
                    <td>
                        Grand Total
                    </td>
                </tr>
                <?php
        }
        
        
    }
    else{
        
        
    }

    

}

function generateOrdersPage()
{
    ?>

        <div class="ordersTable">
        <?php generateLogo() ?>
            <table>
                <tr>
                    <th>
                        Product ID
                    </th>
                    
                    <th>
                        First Name
                    </th>
                    
                    <th>
                        Last Name
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
                        Grand Total
                    </th>
                </tr>
                <?php generateOrderRows();?>
                
            </table>

        </div>

    <?php
}

openDoctypeTag();
openHtmlTag();
generatePageHead($pageTitle, FILE_CSS_BUYING);
openBodyTag();

generateNavigationMenu();
generateOrdersPage();
generatePageFooter();

closeBodyTag();
closeHtmlTag();


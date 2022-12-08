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

const INIT  = 'php/init.php';
require_once INIT;

executePageInitializationFunctions();

$pageTitle = "Orders Page";

generatePageTop($pageTitle, FILE_CSS_ORDERS);

generateLoginLogout($connection);
generateOrdersPage($errorMessage);
generateErrorMessage($errorMessage);

generatePageBottom();

########################################################################
# PAGE-SPECIFIC FUNCTIONS BELOW
########################################################################

function generateOrderRows() #This function generates the table rows (tr)
{
    
}
 
function generateOrdersPage(&$errorMessage) 
{
    if (!isUserConnected()) {
        $errorMessage = LOGGIN_ERROR_MESSAGE;
        return null;
    }
     if (file_exists(FILE_TXT_ORDERS)){
         ?>
        <div class="ordersTable">
            <?php generateLogo() ?>
            <table>
                    <tr>
                        <th>Product<br>ID</th>
                        <th>First<br>Name</th>
                        <th>Last<br>Name</th>
                        <th>City</th>
                        <th>Comments</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Subtotal</th>
                        <th>Taxes</th>
                        <th>Grand<br>Total</th>
                    </tr>
                    <?php generateOrderRows(); ?>
            </table>
        </div>
        <?php
    }
    else
    {
        ?> <p id="noOrdersFound">No orders found!</p>
        <?php
    }
}
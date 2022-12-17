<?php

function generateBuyingPage(&$errorMessageArray)
{
    if (!isUserConnected()) 
    {
        $errorMessageArray["loginErrorMessage"] = LOGIN_ERROR_NO_USER_CONNECTED;
        return null;
    } 
    else 
    {
        $errorMessageArray["loginErrorMessage"] = "";
    }?>  
        <div class="formSection"><?php generateLogo() ?>
            <span id="required">* = required</span>
            <form action="buying.php" method="POST" id="buyingForm">
                <label for="products"><?php generateRedStar(); ?>Product:</label>
                <select name="product" id="product">
                <?php 
                    $products = new Products();
                    $arrayOfProducts = $products->items;
                    foreach ($arrayOfProducts as $product){
                        ?>
                            <option value="<?php echo $product->getId() ?>">
                                <?php echo $product->getPcode() 
                                    . "-" 
                                    . $product->getPdescription()
                                    . " ("
                                    . $product->getPrice()
                                    . "$)"
                                ?>
                            </option>
                        <?php }
                ?>
                </select>
                <br>
                <label>-Comments:</label>
                <textarea
                    id="comments"
                    name="comments"
                    placeholder="Type your comments here!"
                    rows="4" 
                    cols="70"
                    maxlength="200"></textarea>
                <label for="comments"><?php 
                    echo $errorMessageArray["comments"]; ?></label>
                <br>
                <label><?php generateRedStar(); ?>Quantity:</label>
                <input 
                    id="quantity"
                    type="text" 
                    name="quantity"
                    placeholder="Input quantity here!"
                    size="30"
                    maxlength="20">
                <label for="quantity"><?php 
                    echo $errorMessageArray["quantity"]; ?></label>
                <br>
                <button id="buyButton" type="submit" name="purchaseSubmitted">Buy</button>
            </form>
        </div>
    <?php
}

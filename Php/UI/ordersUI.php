<?php

function generateSearchForm() {
    ?>
        <div id="timePicker">
            <label for="datetime">Display orders equal to or newer than selected time:</label>
            <input id="dateTime" type="datetime-local" />
            <button name="searchForm" onclick="searchOrders();">Search</button>
        </div>
    <?php
}

function generateOrdersPage($ordersArray) {
    ?>
        <div class="ordersTable">
            <table>
                    <tr>
                        <th>Delete</th>
                        <th>Date</th>
                        <th>Product<br>ID</th>
                        <th>City</th>
                        <th>Comments</th>
                        <th>Qty</th>
                        <th>Price</th>
                        <th>Subtotal</th>
                        <th>Taxes</th>
                        <th>Total</th>
                    </tr>
                    <?php generateOrderRows($ordersArray); ?>
            </table>
        </div>
    <?php
}
        
function generateOrderRows($ordersArray) {
    foreach ($ordersArray as $orderRowId => $orderRowArray){
        generateOrderRow($orderRowId, $orderRowArray);
    }
}

function generateOrderRow($orderRowId, $orderRowArray) {
    #This function generates the table rows (tr)
    ?>
        <tr>
            <td><Button id="deleteButton" onclick="deleteOrder(<?php echo "'" . $orderRowId . "'" ?>)">Delete me</Button></td>
            <td><?php echo $orderRowArray["orderCreated"] ?></td>
            <td><?php echo $orderRowArray["productCode"] ?></td>
            <td><?php echo $orderRowArray["city"] ?></td>
            <td><?php echo $orderRowArray["comments"] ?></td>
            <td><?php echo $orderRowArray["quantity"] ?></td>
            <td><?php echo $orderRowArray["product_price"] ?>$</td>
            <td><?php echo $orderRowArray["subtotal"] ?>$</td>
            <td><?php echo $orderRowArray["tax_amount"] ?>$</td>
            <td><?php echo $orderRowArray["total"] ?>$</td>
            
        </tr>
    <?php
}

function generateOrderTableContainer() {
    ?>
        <div id="ordersTable">
    <?php
}
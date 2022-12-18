<?php
#-------------------------------------------------------------------
#Revision History
#
#DEVELOPER                      DATE             COMMENTS
#Julien Pontbriand (2135020)    Nov. 29, 2022     File creation.
#
#-------------------------------------------------------------------
require_once FILE_CLASSES_ORDERS;
require_once FILE_CLASSES_COLLECTION;

class Orders extends Collection {
    public function __construct($customerId, $datetime_filter) {
        parent::__construct();
        
        $SQLquery = Database2135020_Procedures_Orders::SELECT_ALL_WITH_OPTIONAL_FILTERS 
            . "(:customerId, :datetime_filter)";
        
        $rows = $this->getConnection()->prepare($SQLquery);
        $rows->bindParam(":customerId", $customerId, PDO::PARAM_STR);
        $rows->bindParam(":datetime_filter", $datetime_filter, PDO::PARAM_STR);
        
        if($rows->execute()) {
            while($row = $rows->fetch()) {
                $orderFromFilteredView = array(
                    "orderCreated"  => $row["orderCreated"],
                    "productCode"   => $row["productCode"],
                    "firstname"     => $row["firstname"],
                    "lastname"      => $row["lastname"],
                    "city"          => $row["city"],
                    "comments"      => $row["comments"],
                    "product_price" => $row["product_price"],
                    "quantity"      => $row["quantity"],
                    "subtotal"      => $row["subtotal"],
                    "tax_amount"    => $row["tax_amount"],
                    "total"         => $row["total"]);
                $this->add($row["orderId"], $orderFromFilteredView);
            }
        }
    }
}
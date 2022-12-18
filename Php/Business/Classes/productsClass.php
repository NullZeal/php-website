<?php
#-------------------------------------------------------------------
#Revision History
#
#DEVELOPER                      DATE             COMMENTS
#Julien Pontbriand (2135020)    Dec. 5, 2022     File creation.
#Julien Pontbriand (2135020)    Dec. 7, 2022     Added content to the class
#Julien Pontbriand (2135020)    Dec. 12, 2022     Connection is now fetched from a parent class
#Julien Pontbriand (2135020)    Dec. 12, 2022     Style refactoring
#-------------------------------------------------------------------
require_once FILE_CLASSES_PRODUCT;
require_once FILE_CLASSES_COLLECTION;

class Products extends Collection {
    public function __construct() {
        parent::__construct();
        
        $SQLquery = Database2135020_Procedures_Products::SELECT_ALL . "();";
        
        $rows = $this->getConnection()->prepare($SQLquery);
        
        if($rows->execute())
        {
            while($row = $rows->fetch()) {
                $product = new Product(
                    $row["id"],
                    $row["pcode"],
                    $row["pdescription"],
                    $row["price"],
                    $row["cost"],
                    $row["datetime_created"],
                    $row["datetime_updated"]);
                $this->add($row["id"], $product);
            }
        }
    }
}

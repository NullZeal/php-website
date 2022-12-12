<?php
#-------------------------------------------------------------------
#Revision History
#
#DEVELOPER                      DATE             COMMENTS
#Julien Pontbriand (2135020)    Nov. 29, 2022     File creation.
#
#-------------------------------------------------------------------
require_once FILE_CONNECTION;
require_once FILE_PRODUCT;
require_once FILE_COLLECTION;

class Products extends Collection
{
    public function __construct(){
        
        global $currentDatabaseConnection;
        
        $SQLquery = Database2135020_Procedures_Products::SELECT_ALL . "();";
        
        $rows = $currentDatabaseConnection->prepare($SQLquery);
        
        if($rows->execute())
        {
            while($row = $rows->fetch())
            {
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

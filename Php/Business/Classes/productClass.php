<?php
#-------------------------------------------------------------------
#Revision History
#
#DEVELOPER                      DATE             COMMENTS
#Julien Pontbriand (2135020)    Dec. 5, 2022     File creation.
#Julien Pontbriand (2135020)    Dec. 7, 2022     Added content to the class
#Julien Pontbriand (2135020)    Dec. 12, 2022     Added the database connection through a parent class
#Julien Pontbriand (2135020)    Dec. 18, 2022     Style refactoring
#-------------------------------------------------------------------

require_once FILE_CLASSES_DATABASE_CONNECTED_OBJECT;

class Product extends DatabaseConnectedObject {
    private $id                 = "";
    private $pcode              = "";
    private $pdescription       = "";
    private $price              = "";
    private $cost               = "";
    private $datetime_created   = "";
    private $datetime_updated   = "";
    
    public function __construct (
        $id                 = "",
        $pcode              = "",
        $pdescription       = "",
        $price              = "",
        $cost               = "",
        $datetime_created   = "",
        $datetime_updated   = ""
    ) {
        parent::__construct();
        $this->setId($id);
        $this->setPdocde($pcode);
        $this->setPdescription($pdescription);
        $this->setPrice($price);
        $this->setCost($cost);
        $this->setDatetime_created($datetime_created);
        $this->setDatetime_updated($datetime_updated);
    }
    
    function getId() {
        return $this->id;
    }
    
    function setId($input) {
        $this->id = $input;
    }

    function getPcode() {
        return $this->pcode;
    }
    
    function setPdocde($input) {
        $this->pcode = $input;
    }
    
    function getPdescription() {
        return $this->pdescription;
    }   
    
    function setPdescription($input) {
        $this->pdescription = $input;
    }

    function getPrice() {
        return $this->price;
    }
    
    function setPrice($input) {
        $this->price = $input;
    }
    
    function getCost() {
        return $this->cost;
    }
    
    function setCost($input) {
        $this->cost = $input;
    }
    
    function getDatetime_created() {
        return $this->datetime_created;
    } 
    
    function setDatetime_created($input) {
        $this->datetime_created = $input;
    } 
    
    function getDatetime_updated() {
        return $this->datetime_updated;
    } 
    
    function setDatetime_updated($input) {
        $this->datetime_updated = $input;
    }
    
    static function getProductPrice($productId) {
        global $currentDatabaseConnection;
        $SQLquery = Database2135020_Procedures_Products::SELECT_ONE . "(:id)";
        $rows = $currentDatabaseConnection->prepare($SQLquery);
        $rows->bindParam(":id", $productId, PDO::PARAM_STR);

        if ($rows->execute()) {
            while ($row = $rows->fetch()) {
                if ($row["id"] == $productId) {
                    return $row["price"];
                }
            }
        }
        return false;
    }
}
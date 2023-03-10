<?php
#-------------------------------------------------------------------
#Revision History
#
#DEVELOPER                      DATE             COMMENTS
#Julien Pontbriand (2135020)    Dec. 5, 2022     File creation.
#Julien Pontbriand (2135020)    Dec. 7, 2022     Copied most content from the customer class
#Julien Pontbriand (2135020)    Dec. 8, 2022     Modified the code to make it unique to an order
#Julien Pontbriand (2135020)    Dec. 9, 2022     Added features to support the subtotal, tax amount and total fields
#                                                Now gets the validations file functions
#Julien Pontbriand (2135020)    Dec. 12, 2022     Now get connection from a parent class, Class name change
#Julien Pontbriand (2135020)    Dec. 13, 2022     Added a delete function
#Julien Pontbriand (2135020)    Dec. 18, 2022     Style refactoring
#-------------------------------------------------------------------

require_once FILE_CLASSES_DATABASE_CONNECTED_OBJECT;
require_once FILE_BUSINESS_VALIDATIONS;

class Order extends DatabaseConnectedObject {
    //class constants
    const QUANTITY_MAX        = 99;
    const QUANTITY_MIN        = 1;
    const COMMENTS_CHAR_MAX   = 200;
    const PRODUCT_PRICE_MIN   = 0;
    const PRODUCT_PRICE_MAX   = 10000;
    const TAX_RATE_PERCENTAGE = 13.7;
    
    //variables
    private $id               = "";
    private $id_customer      = "";
    private $id_product       = "";
    private $quantity         = "";
    private $product_price    = "";
    private $subtotal         = "";
    private $taxAmount        = "";
    private $total            = "";
    private $comments         = "";
    private $datetime_created = "";
    private $datetime_updated = "";
    
    public function __construct (
        $id                 = "",
        $id_customer        = "",
        $id_product         = "",
        $quantity           = "",
        $product_price      = "",
        $subtotal           = "",
        $taxAmount          = "",
        $total              = "",
        $comments           = "",
        $datetime_created   = "",
        $datetime_upadated  = ""
    ) {
        parent::__construct();
        $this->setId($id);
        $this->setId_customer($id_customer);
        $this->setId_product($id_product);
        $this->setQuantity($quantity);
        $this->setProductPrice($product_price);
        $this->setSubtotal();
        $this->setTaxAmount();
        $this->setTotal();
        $this->setComments($comments);
    }
    
    function getId() {
        return $this->id;
    }
    
    function setId($input) {
        $this->id = $input;
    }
    
    function getId_customer() {
        return $this->id_customer;
    }
    
    function setId_customer($input) {
        $this->id_customer = $input;
    }

    function getId_product() {
        return $this->id_product;
    }
    
    function setId_product($input) {
        $this->id_product = $input;
    }
    
    function getQuantity() {
        return $this->quantity;
    } 

    function setQuantity($input) {
        if ( ! is_numeric($input)) {
            return "Quantity must be a numeric value";
        } elseif ( ! isAnInt($input)) {
            return "Quantity not integer-like over 0";
        } elseif ((int) $input < self::QUANTITY_MIN) {
            return "Quantity cannot be a under " . QUANTITY_MIN;
        } elseif ((int) $input > self::QUANTITY_MAX) {
            return "Quantity cannot be a over " . QUANTITY_MAX;
        } else{
            $this->quantity = $input;
            return false;
        }
    }
    
    function getProductPrice() {
        return $this->product_price;
    } 
    
    function setProductPrice($input) {
        if ( ! is_numeric($input)) {
            return "ProductPrice must be a numeric value";
        } elseif (!isCurrency($input)) {
            return "ProductPrice must be currency-like";
        } elseif ((float) $input < self::PRODUCT_PRICE_MIN) {
            return "Quantity cannot be a under " . self::PRODUCT_PRICE_MIN;
        } elseif ((float) $input > self::PRODUCT_PRICE_MAX) {
            return "Quantity cannot be a over " . self::PRODUCT_PRICE_MAX;
        } else{
            $this->product_price = $input;
            return false;
        }
    }
    
    function getSubtotal() {
        return $this->subtotal;
    } 
    
    function setSubtotal() {
        $this->subtotal = $this->quantity != "" && $this->product_price != "" 
            ? $this->calculateSubtotal($this->quantity, $this->product_price) : "";
    }
    
    function getTaxAmount() {
        return $this->taxAmount;
    } 
    
    function setTaxAmount() {
        $this->taxAmount = $this->subtotal != "" 
                ? $this->calculateTaxAmount($this->subtotal, self::TAX_RATE_PERCENTAGE) : "";
    }
    
    function getTotal() {
        return $this->total;
    } 
    
    function setTotal() {
        $this->total = 
            $this->getSubtotal() != "" && $this->getTaxAmount() != ""
                ? $this->calculateTotal($this->subtotal, $this->taxAmount) : "";
    }
    
    function getComments() {
        return $this->comments;
    } 
    
    function setComments($input) {
        if (mb_strlen($input) > self::COMMENTS_CHAR_MAX) {
            return "Max comments size = " . self::COMMENTS_CHAR_MAX . " characters";
        } else {
            $this->comments = $input;
            return false;
        }
    }

    function getDatetime_created() {
        return $this->datetime_created;
    } 
    
    function setDatetime_created($input) {
        if (empty($input)) {
            return "The datetime cannot be empty";
        } else {
            $this->datetime_created = $input;
            return false;
        }
    }
    
    function getDatetime_updated() {
        return $this->datetime_updated;
    } 
    
    function setDatetime_updated($input) {
        if (empty($input)) {
            return "The datetime cannot be empty";
        } else {
            $this->datetime_updated = $input;
            return false;
        }
    }
    
    function load($id, $connection) {
        $SQLquery = Database2135020_Procedures_Orders::INSERT_ONE . "(:id)";
        $rows = $connection->prepare($SQLquery);
        $rows->bindParam(":id", $id, PDO::PARAM_STR);

        if ($rows->execute()) {
            while ($row = $rows->fetch()) {
                if ($row["id"] == $id) {
                    $this->setId($row["id"]);
                    $this->setId_customer($row["id_customer"]);
                    $this->setId_product($row["id_product"]);
                    $this->setQuantity($row["quantity"]);
                    $this->setComments($row["comments"]);
                }
            }
        }
    }
    
    function save() {
        $SQLquery = Database2135020_Procedures_Orders::INSERT_ONE
            . "(:id_customer,"
            . ":id_product,"
            . ":quantity,"
            . ":product_price,"
            . ":subtotal,"
            . ":tax_amount,"
            . ":total,"
            . ":comments)";

        $rows = $this->getConnection()->prepare($SQLquery);

        $rows->bindParam(":id_customer", $this->id_customer, PDO::PARAM_STR);
        $rows->bindParam(":id_product", $this->id_product, PDO::PARAM_STR);
        $rows->bindParam(":quantity", $this->quantity, PDO::PARAM_STR);
        $rows->bindParam(":product_price", $this->product_price, PDO::PARAM_STR);
        $rows->bindParam(":subtotal", $this->subtotal, PDO::PARAM_STR);
        $rows->bindParam(":tax_amount", $this->taxAmount, PDO::PARAM_STR);
        $rows->bindParam(":total", $this->total, PDO::PARAM_STR);
        $rows->bindParam(":comments", $this->comments, PDO::PARAM_STR);

        $rows->execute();
    }
    
    function delete() {
        $SQLquery = Database2135020_Procedures_Orders::DELETE_ONE . "(:id)";
        $rows = $this->getConnection()->prepare($SQLquery);
        $rows->bindParam(":id", $this->id, PDO::PARAM_STR);
        $rows->execute();
    }
    
    function calculateSubtotal($quantity, $productPrice) {
        return ((float) $quantity) * ((float) $productPrice);
    }

    function calculateTaxAmount($subtotal, $taxRateInPercentage) {
        return round($subtotal * ($taxRateInPercentage / 100), 2);
    }

    function calculateTotal($subtotal, $taxAmount) {
        return round(($subtotal + $taxAmount), 2);
    }
}

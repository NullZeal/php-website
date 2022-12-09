<?php
#-------------------------------------------------------------------
#Revision History
#
#DEVELOPER                      DATE             COMMENTS
#Julien Pontbriand (2135020)    Nov. 29, 2022     File creation.
#
#-------------------------------------------------------------------

class order 
{
    //class constants

    const QUANTITY_MAX = 99;
    const QUANTITY_MIN = 1;
    const COMMENTS_CHAR_MAX = 200;
    const PRODUCT_PRICE_MIN = 0;
    const PRODUCT_PRICE_MAX = 10000;
    
    //variables
    
    private $id = "";
    private $id_customer = "";
    private $id_product = "";
    private $quantity = "";
    private $product_price = "";
    private $comments = "";
    private $datetime_created = "";
    private $datetime_upadated = "";
    
    public function __construct
    (
        $id = "",
        $id_customer = "",
        $id_product = "",
        $quantity = "",
        $product_price = "",
        $comments = "",
        $datetime_created = "",
        $datetime_upadated = ""
    )
    {
        $this->setId($id);
        $this->setId_customer($id_customer);
        $this->setId_product($id_product);
        $this->setComments($comments);
        $this->setQuantity($quantity);
        $this->setProductPrice($product_price);
    }
    
    function getId()
    {
        return $this->id;
    }
    
    function setId($input)
    {
        $this->id = $input;
    }
    
    function getId_customer()
    {
        return $this->id_customer;
    }
    
    function setId_customer($input)
    {
        $this->id_customer = $input;
    }

    function getId_product()
    {
        return $this->id_product;
    }
    
    function setId_product($input)
    {
        $this->id_product = $input;
    }
    
    function getQuantity()
    {
        return $this->quantity;
    } 

    function setQuantity($input)
    {
        if (!is_numeric($input)) {
            return "The quantity must be a numeric value";
        } elseif (!isAnInt($input)) {
            return "Quantity not integer-like over 0";
        } elseif ((int) $input < self::QUANTITY_MIN) {
            return "The quantity cannot be a under 1";
        } elseif ((int) $input > self::QUANTITY_MAX) {
            return "The quantity cannot be a over 99";
        } else{
            $this->quantity = $input;
            return false;
        }
    }
    
    function getComments()
    {
        return $this->comments;
    } 
    
    function setComments($input)
    {
        if (mb_strlen($input) > self::COMMENTS_CHAR_MAX) {
            return "Max comments size = " . self::COMMENTS_CHAR_MAX . " characters";
        } else {
            $this->comments = $input;
            return false;
        }
    }
    
    function getProductPrice()
    {
        return $this->product_price;
    } 
    
    function setProductPrice($input)
    {
        if (!is_numeric($input)) {
            return "The productPrice must be a numeric value";
        } elseif (!isCurrency($input)) {
            return "The productPrice must be currency-like";
        } elseif ((float) $input < self::PRODUCT_PRICE_MIN) {
            return "The quantity cannot be a under " . self::PRODUCT_PRICE_MIN;
        } elseif ((float) $input > self::PRODUCT_PRICE_MAX) {
            return "The quantity cannot be a over " . self::PRODUCT_PRICE_MAX;
        } else{
            $this->quantity = $input;
            return false;
        }
    }

    function getDatetime_created()
    {
        return $this->datetime_created;
    } 
    
    function setDatetime_created($input)
    {
        if (empty($input)) {
            return "The datetime cannot be empty";
        } else {
            $this->datetime_created = $input;
            return false;
        }
    }
    
    function getDatetime_updated()
    {
        return $this->datetime_updated;
    } 
    
    function setDatetime_updated($input)
    {
        if (empty($input)) {
            return "The datetime cannot be empty";
        } else {
            $this->datetime_updated = $input;
            return false;
        }
    }
    
    function load($id, $connection)
    {
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
    
    function save($connection)
    {
        $SQLquery = Database2135020_Procedures_Orders::INSERT_ONE
            . "(:id_customer,"
            . ":id_product,"
            . ":quantity,"
            . ":product_price,"
            . ":comments)";

        $rows = $connection->prepare($SQLquery);

        $rows->bindParam(":id_customer", $this->id_customer, PDO::PARAM_STR);
        $rows->bindParam(":id_product", $this->id_product, PDO::PARAM_STR);
        $rows->bindParam(":quantity", $this->quantity, PDO::PARAM_STR);
        $rows->bindParam(":product_price", $this->product_price);
        $rows->bindParam(":comments", $this->comments, PDO::PARAM_STR);

        $rows->execute();
    }
}
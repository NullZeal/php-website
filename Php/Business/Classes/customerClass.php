<?php
#-------------------------------------------------------------------
#Revision History
#
#DEVELOPER                      DATE             COMMENTS
#Julien Pontbriand (2135020)    Nov. 29, 2022     File creation.
#
#-------------------------------------------------------------------

require_once FILE_CLASSES_DATABASE_CONNECTED_OBJECT;

class Customer extends DatabaseConnectedObject
{
    //class constants
    const ID_MIN_LENGTH = 36;
    const ID_MAX_LENGTH = 36;
    const FIRSTNAME_MAX_LENGTH = 20;
    const LASTNAME_MAX_LENGTH = 20;
    const ADDRESS_MAX_LENGTH = 25;
    const CITY_MAX_LENGTH = 25;
    const PROVINCE_MAX_LENGTH = 25;
    const POSTALCODE_MAX_LENGTH = 7;
    const USERNAME_MAX_LENGTH = 15;
    const USER_PASSWORD_MAX_LENGTH = 255;
    const PICTURE_MAX_SIZE = 20000;
    
    //variables
    private $id = "";
    private $firstname = "";
    private $lastname = "";
    private $address = "";
    private $city = "";
    private $province = "";
    private $postalcode = "";
    private $username = "";
    private $user_password = "";
    private $picture = "";
    private $datetime_created = "";
    private $datetime_updated = "";
    
    public function __construct
    (
        $id = "",
        $connection = "",
        $firstname = "",
        $lastname = "",
        $address = "",
        $city = "",
        $province = "",
        $postalcode = "",
        $username = "",
        $user_password = "",
        $picture = "",
        $datetime_created = "",
        $datetime_updated = ""
    )
    {
        parent::__construct();
        $this->setId($id);
        $this->setFirstname($firstname);
        $this->setLastname($lastname);
        $this->setAddress($address);
        $this->setCity($city);
        $this->setProvince($province);
        $this->setPostalcode($postalcode);
        $this->setUsername($username);
        $this->setUser_password($user_password);
        $this->setPicture($picture);
        $this->setDatetime_created($datetime_created);
        $this->setDatetime_updated($datetime_updated);
    }
    
    function getId()
    {
        return $this->id;
    }
    
    function setId($input)
    {
        if (empty($input)) {
            return "The id cannot be empty";
        } elseif (mb_strlen($input) > $this::ID_MAX_LENGTH) {
            return "The id cannot have over "
                . $this::ID_MAX_LENGTH . " characters";
        } elseif (mb_strlen($input) < $this::ID_MAX_LENGTH) {
            return "The id cannot have under "
                . $this::ID_MAX_LENGTH . " characters";
        } else {
            $this->id = $input;
            return null;
        }
    }

    function getFirstname()
    {
        return $this->firstname;
    }
    
    function setFirstname($input)
    {
        if (empty($input)) {
            return "The firstname cannot be empty";
        } elseif (mb_strlen($input) > $this::FIRSTNAME_MAX_LENGTH) {
            return "The firstname cannot have over "
                . $this::FIRSTNAME_MAX_LENGTH . " characters";
        } else {
            $this->firstname = $input;
            return null;
        }
    }

    function getLastname()
    {
        return $this->lastname;
    } 

    function setLastname($input)
    {
        if (empty($input)) {
            return "The lastname cannot be empty";
        } elseif (mb_strlen($input) > $this::LASTNAME_MAX_LENGTH) {
            return "The lastname cannot have over "
                . $this::LASTNAME_MAX_LENGTH . " characters";
        } else {
            $this->lastname = $input;
            return null;
        }
    }

    function getAddress()
    {
        return $this->address;
    }   

    function setAddress($input)
    {
        if (empty($input)) {
            return "The address cannot be empty";
        } elseif (mb_strlen($input) > $this::ADDRESS_MAX_LENGTH) {
            return "The address cannot have over "
                . $this::ADDRESS_MAX_LENGTH . " characters";
        } else {
            $this->address = $input;
            return false;
        }
    }
    
    function getCity()
    {
        return $this->city;
    } 
    
    function setCity($input)
    {
        if (empty($input)) {
            return "The city cannot be empty";
        } elseif (mb_strlen($input) > $this::CITY_MAX_LENGTH) {
            return "The city cannot have over "
                . $this::CITY_MAX_LENGTH . " characters";
        } else {
            $this->city = $input;
            return false;
        }
    }
    
    function getProvince()
    {
        return $this->province;
    } 
    
    function setProvince($input)
    {
        if (empty($input)) {
            return "The province cannot be empty";
        } elseif (mb_strlen($input) > $this::PROVINCE_MAX_LENGTH) {
            return "The province cannot have over "
                . $this::PROVINCE_MAX_LENGTH . " characters";
        } else {
            $this->province = $input;
            return false;
        }
    }

    function getPostalcode()
    {
        return $this->postalcode;
    }  

    function setPostalcode($input)
    {
        if (empty($input)) {
            return "The postal code cannot be empty";
        } elseif (mb_strlen($input) > $this::POSTALCODE_MAX_LENGTH) {
            return "The postal code cannot have over "
                . $this::POSTALCODE_MAX_LENGTH. " characters";
        } else {
            $this->postalcode = $input;
            return false;
        }
    }
    
    function getUsername()
    {
        return $this->username;
    } 

    function setUsername($input)
    {
        if (empty($input)) 
        {
            return "The username code cannot be empty";
        } 
        elseif (mb_strlen($input) > $this::USERNAME_MAX_LENGTH) 
        {
            return "The username code cannot have over "
                . $this::USERNAME_MAX_LENGTH. " characters";
        }
        else
        {
            $this->username = $input;
            return false;
        }
    }

    function getUser_password()
    {
        return $this->user_password;
    } 
    
    function setUser_password($input)
    {
        if (empty($input)) {
            return "The password code cannot be empty";
        } elseif (mb_strlen($input) > $this::USER_PASSWORD_MAX_LENGTH) {
            return "The password code cannot have over "
                . $this::USER_PASSWORD_MAX_LENGTH. " characters";
        } else {
            $this->user_password = $input;
            return false;
        }
    }
    
    function getPicture()
    {
        return $this->picture;
    } 
    
    function setPicture($input)
    {
        if (empty($input)) {
        return "Please upload your profile picture";
        }
        else{
            $this->picture = $input;
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

    function load($id)
    {
        $SQLquery = Database2135020_Procedures_Customers::SELECT_ONE_FROM_ID . "(:id)";
        $rows = $this->getConnection()->prepare($SQLquery);
        $rows->bindParam(":id", $id, PDO::PARAM_STR);

        if ($rows->execute()) {
            while ($row = $rows->fetch()) {
                if ($row["id"] == $id) {
                    $this->setId($row["id"]);
                    $this->setFirstname($row["firstname"]);
                    $this->setLastname($row["lastname"]);
                    $this->setAddress($row["address"]);
                    $this->setCity($row["city"]);
                    $this->setProvince($row["province"]);
                    $this->setPostalcode($row["postalcode"]);
                    $this->setUsername($row["username"]);
                    $this->setUser_password($row["user_password"]);
                    $this->setPicture($row["picture"]);
                    $this->setDatetime_created($row["datetime_created"]);
                    $this->setDatetime_updated($row["datetime_updated"]);
                }
            }
        }
    }
    
    function save()
    {
        $SQLquery = Database2135020_Procedures_Customers::INSERT_ONE
            . "(:firstname,"
            . ":lastname,"
            . ":address,"
            . ":city,"
            . ":province,"
            . ":postalcode,"
            . ":username,"
            . ":user_password,"
            . ":picture )";

        $rows = $this->getConnection()->prepare($SQLquery);

        $rows->bindParam(":firstname", $this->firstname, PDO::PARAM_STR);
        $rows->bindParam(":lastname", $this->lastname, PDO::PARAM_STR);
        $rows->bindParam(":address", $this->address, PDO::PARAM_STR);
        $rows->bindParam(":city", $this->city, PDO::PARAM_STR);
        $rows->bindParam(":province", $this->province, PDO::PARAM_STR);
        $rows->bindParam(":postalcode", $this->postalcode, PDO::PARAM_STR);
        $rows->bindParam(":username", $this->username, PDO::PARAM_STR);
        $rows->bindParam(":user_password", $this->user_password, PDO::PARAM_STR);
        $rows->bindParam(":picture", $this->picture);

        $rows->execute();
    }
    
    function validateCredentials()
    {
        $SQLquery = Database2135020_Procedures_Customers::SELECT_ONE_FROM_USERNAME . "(:username)";
        $rows = $this->getConnection()->prepare($SQLquery);
        $rows->bindParam(":username", $this->username, PDO::PARAM_STR);

        if ($rows->execute()) {
            while ($row = $rows->fetch()) {
                if ($row["username"] == $this->username && password_verify($this->user_password, $row["user_password"]))                {
                    $this->setId($row["id"]);
                    return true;
                }
            }
        }
        return false;
    }
    
    function isUsernameDuplicate()
    {
        $SQLquery = Database2135020_Procedures_Customers::SELECT_ONE_FROM_USERNAME . "(:username)";
        $rows = $this->getConnection()->prepare($SQLquery);
        $rows->bindParam(":username", $this->username, PDO::PARAM_STR);

        if ($rows->execute()) {
            while ($row = $rows->fetch()) {
                if ($row["username"] == $this->username && !empty($row["username"])) {
                    return true;
                }
            }
            return false;
        }
    }
}

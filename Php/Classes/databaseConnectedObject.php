<?php
#-------------------------------------------------------------------
#Revision History
#
#DEVELOPER                      DATE             COMMENTS
#Julien Pontbriand (2135020)    Nov. 29, 2022     File creation.
#
#-------------------------------------------------------------------

require_once CONSTANTS_GLOBAL;
require_once FILE_CONNECTION;

class DatabaseConnectedObject
{
    //class constants
    const ID_MIN_LENGTH = 36;
    const ID_MAX_LENGTH = 36;
    
    //variables
    
    private $id = "";
    private $connection = "";
    
    public function __construct
    (
        $id = "",
        $connection = ""
    )
    {
        global $currentDatabaseConnection;
        
        $this->connection = $currentDatabaseConnection;
        $this->setId($id);
    }
    
    function getConnection()
    {
        return $this->connection;
    }
    
    function setConnection($input){
        $this->connection = $input;
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
}

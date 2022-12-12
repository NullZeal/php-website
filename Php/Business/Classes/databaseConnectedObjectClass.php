<?php
#-------------------------------------------------------------------
#Revision History
#
#DEVELOPER                      DATE             COMMENTS
#Julien Pontbriand (2135020)    Nov. 29, 2022     File creation.
#
#-------------------------------------------------------------------

require_once CONSTANTS_GLOBAL;
require_once FILE_BUSINESS_CONNECTION;

class DatabaseConnectedObject
{
    private $connection = "";
    
    public function __construct()
    {
        global $currentDatabaseConnection;
        $this->connection = $currentDatabaseConnection;
    }
    
    function getConnection()
    {
        return $this->connection;
    }
    
    function setConnection($input){
        $this->connection = $input;
    }
}

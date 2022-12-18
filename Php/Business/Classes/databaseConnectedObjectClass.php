<?php
#-------------------------------------------------------------------
#Revision History
#
#DEVELOPER                      DATE             COMMENTS
#Julien Pontbriand (2135020)    Dec. 9, 2022     File creation.
#Julien Pontbriand (2135020)    Dec. 12, 2022     Minor refactoring
#                                                 Removed the ID being care for by this class
#Julien Pontbriand (2135020)    Dec. 18, 2022     Minor refactoring (aesthetic)
#-------------------------------------------------------------------

require_once CONSTANTS_GLOBAL;
require_once FILE_BUSINESS_CONNECTION;

#This class offers a connection to all objects that extends it
class DatabaseConnectedObject {
    private $connection = "";
    
    public function __construct() {
        global $currentDatabaseConnection;
        $this->connection = $currentDatabaseConnection;
    }
    
    function getConnection() {
        return $this->connection;
    }
    
    function setConnection($input){
        $this->connection = $input;
    }
}
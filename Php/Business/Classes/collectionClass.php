<?php
#-------------------------------------------------------------------
#Revision History
#
#DEVELOPER                      DATE             COMMENTS
#Julien Pontbriand (2135020)    Dec. 7, 2022     Page creation
#Julien Pontbriand (2135020)    Dec. 17, 2022     Added page logic to the page
#Julien Pontbriand (2135020)    Dec. 18, 2022     Code refactoring                                    
#-------------------------------------------------------------------

require_once FILE_CLASSES_DATABASE_CONNECTED_OBJECT;

class Collection extends DatabaseConnectedObject {
    
    public $items = array();
    
    public function __construct() {
        parent::__construct();
    }
    
    public function add($primaryKey, $item) {
        $this->items[$primaryKey] = $item;
    }

    public function remove($primaryKey) {
        if (isset($this->items[$primaryKey])) {
            unset($this->items[$primaryKey]);
        }
    }

    public function get($primaryKey) {
        if (isset($this->items[$primaryKey])) {
            return($this->items[$primaryKey]);
        }
    }

    public function count() {
        return count($this->items);
    }
}

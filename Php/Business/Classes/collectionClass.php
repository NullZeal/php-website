<?php

require_once FILE_CLASSES_DATABASE_CONNECTED_OBJECT;

class Collection extends DatabaseConnectedObject
{
    public function __construct()
    {
        parent::__construct();
    }
    
    public $items = array();

    public function add($primaryKey, $item)
    {
        $this->items[$primaryKey] = $item;
    }

    public function remove($primaryKey)
    {
        if (isset($this->items[$primaryKey])) {
            unset($this->items[$primaryKey]);
        }
    }

    public function get($primaryKey)
    {
        if (isset($this->items[$primaryKey])) {
            return($this->items[$primaryKey]);
        }
    }

    public function count()
    {
        return count($this->items);
    }
}

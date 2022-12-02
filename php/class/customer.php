<?php
#-------------------------------------------------------------------
#Revision History
#
#DEVELOPER                      DATE             COMMENTS
#Julien Pontbriand (2135020)    Nov. 29, 2022     File creation.
#

#-------------------------------------------------------------------

class customer
{
    //class constants
    
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
        $this->set;
    }
    
    public function getId(){
        return $this->id;
    }
    
    public function setId($newId){
        $this->id = $newId;
    }
}

<?php
/**
 * Created by PhpStorm.
 * User: zainulabdeen
 * Date: 08/05/15
 * Time: 1:12 AM
 */

Abstract class Entity {

    public $date_created;

    public $date_modified;

    public function __construct($data = null){
        if (isset($data) && is_array($data)){
            foreach($data as $field => $value){
                $this->{$field} = $value;
            }
        }
        $this->setDateCreated(date('Y-m-d h:i:s',time()));
        $this->setDateModified(date('Y-m-d h:i:s',time()));
    }

    public function setDateCreated($date){
        $this->date_created = $date;
    }

    public function setDateModified($date){
        $this->date_modified = $date;
    }

    public function getDateCreated(){
        return $this->date_created;
    }

    public function getDateModified(){
        return $this->date_modified;
    }

    /**
     * prevent form cloning
     */
    private function __clone(){

    }
} 
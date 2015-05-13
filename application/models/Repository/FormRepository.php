<?php
/**
 * Created by PhpStorm.
 * User: zainulabdeen
 * Date: 08/05/15
 * Time: 1:50 AM
 */

class FormRepository extends Repository {

    protected $tableName = 'forms';
    public function getAll(){
        $query = "SELECT * FROM ".$this->getTableName()." ORDER BY date_created DESC LIMIT ".$this->getOffset().",".$this->getLimit();
        $stmt = $this->connection->prepare($query);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS,$this->getEntityName());
        return $stmt->fetchAll();

    }
    public function getFormCount(){
        $query = "SELECT count(*) as count FROM ".$this->getTableName();
        $stmt = $this->connection->prepare($query);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS,$this->getEntityName());
        $result = $stmt->fetchAll();
        return $result[0]->count;

    }

} 
<?php
/**
 * Created by PhpStorm.
 * User: zainulabdeen
 * Date: 08/05/15
 * Time: 1:50 AM
 */

class StreamRepository extends Repository {

    protected $tableName = 'streams';

    public function fetchAll(){
        $query = "SELECT * FROM " . $this->getTableName();
        $stmt = $this->connection->prepare($query);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS,$this->getEntityName());
        return $stmt->fetchAll();
    }

    public function updateStatus($id,$status){
        try{
            $entity = $this->find($id);
            $entity->setStatus($status);
            return $this->update($entity);
        } catch (PDOException $e){
            print_r($e);
            return false;
        }
    }

} 
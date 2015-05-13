<?php
/**
 * Created by PhpStorm.
 * User: zainulabdeen
 * Date: 08/05/15
 * Time: 1:48 AM
 */

class CallRepository extends Repository {

    protected $tableName = 'calls';

    public function getCallList(){

        $now = time();
        $query = "SELECT `c`.*,`s`.`keyword`,`s`.`is_phrase`,`s`.`status` FROM `" . $this->getTableName() ."` `c` LEFT JOIN `streams`  `s` ON (`c`.`stream_id` = `s`.`id`) WHERE `c`.`next_call_time` <= '".$now."' AND `s`.`status` = 'active' ";
        $stmt = $this->connection->prepare($query);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS,$this->getEntityName());
        return $stmt->fetchAll();
    }

    public function saveAll(array $data){

        #TODO: set this as a proper transaction thingy

        foreach($data as $entity){
            $this->save($entity);
        }
        return true;
    }

} 
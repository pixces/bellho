<?php
/**
 * Created by PhpStorm.
 * User: zainulabdeen
 * Date: 08/05/15
 * Time: 1:49 AM
 */

class PostRepository extends Repository {

    protected $tableName = 'posts';

    public function fetchPostByStatus(){

    }

    public function saveAll(array $data){
        #TODO: set this as a proper transaction thingy
        foreach($data as $entity){
            $this->save($entity);
        }
        return true;
    }

    /**
     * Method to create a custom query
     * to get counts of posts based on their status
     */
    public function getPostCount(){
        $summary = array(
            'all'       => 0,
            'new'       => 0,
            'approved'  => 0
        );

        $query = "SELECT count(`id`) as `total`,
                         `post_status` as `status`
                  FROM `". $this->getTableName() ."`
                  WHERE `post_status` IN ('new','approved')
                  GROUP BY `post_status`";

        $stmt = $this->connection->prepare($query);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $result = $stmt->fetchAll();

        if ($result){
            $sum = 0;
            foreach($result as $count){
                $sum += $count['total'];
                $summary[$count['status']] = $count['total'];
            }
            $summary['all'] = $sum;
            return $summary;
        } else {
            return false;
        }
    }

    public function getByStatus($status){

        $query = "SELECT `p`.*,`s`.`keyword` FROM " . $this->getTableName() ." `p` LEFT JOIN `streams` `s` ON (`p`.`stream_id` = `s`.`id` ) ";

        if ($status != 'all'){
            $query .= " WHERE `post_status` = :status ";
        } else {
            $query .= " WHERE `post_status` IN ('new','approved') ";
        }

        $query .= " ORDER BY date_published_ts DESC ";
        $query .= " LIMIT ".$this->getOffset().",".$this->getLimit();

        $stmt = $this->connection->prepare($query);
        if ($status !== 'all'){
            $stmt->bindParam(':status', $status, PDO::PARAM_STR);
        }

        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS,$this->getEntityName());
        return $stmt->fetchAll();
    }

    public function updateStatus($id,$status){
        try{
            $entity = $this->find($id);
            $entity->setPostStatus($status);
            return $this->update($entity);
        } catch (PDOException $e){
            print_r($e);
            return false;
        }
    }

    public function fetchPosts($aParams){

        $query = "SELECT * FROM " . $this->getTableName();
        $query .= " WHERE 1 = 1 AND `source` = :source ";
        $query .= "ORDER BY `date_published_ts` DESC ";
        $query .= "LIMIT ".$aParams['offset'].",".$aParams['limit'];

        $stmt = $this->connection->prepare($query);
        $stmt->bindParam(':source', $aParams['media'], PDO::PARAM_STR);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS,$this->getEntityName());
        return $stmt->fetchAll();
    }

} 
<?php
/**
 * Created by PhpStorm.
 * User: zainulabdeen
 * Date: 08/05/15
 * Time: 1:50 AM
 */

class UserRepository extends Repository {

    protected $tableName = 'users';

    public function doLogin($username,$password){

        $password = md5($password);
        $query = "SELECT * FROM " . $this->getTableName();
        $query .= " WHERE `username` = '" . trim($username) . "' AND";
        $query .= " `password` = '" . trim($password) ."'";

        $stmt = $this->connection->prepare($query);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS,$this->getEntityName());
        return $stmt->fetch();

    }

} 
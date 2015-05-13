<?php
/**
 * Created by PhpStorm.
 * User: zainulabdeen
 * Date: 08/05/15
 * Time: 1:48 AM
 */

Abstract class Repository {

    protected $connection;

    protected $result;

    protected $rows;

    protected $entityName;

    protected $tableName;

    protected $columnMap;

    protected $lastInsertedId;

    protected $limit = 50;

    protected $offset = 0;

    protected $whereClause;

    public function __construct($entity, Db $connection = null )
    {
        $this->connection = $connection;
        if ($this->connection === null) {
            $this->connection = Db::getInstance();
        }
        $this->entityName = $entity;
        $this->setLimit(50);
    }

    public function find($id){

        $query = "SELECT * FROM " . $this->getTableName();
        $query .= " WHERE `id` = :id";

        $stmt = $this->connection->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, $this->getEntityName());

        return $stmt->fetch();
    }

    /**
     * TODO:
     * Common function to perform all findAll method
     */
    public function search(){

        //prepare where clauses
        //prepare limit clause
        //prepare order clause
        //execute the fetchAll;
        //SELECT * FROM <table> WHERE <whereClause> ORDER BY <orderByClause> LIMIT <offest>,<limit>;

        $query = "SELECT * FROM " . $this->getTableName();
        $stmt = $this->connection->prepare($query);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS,$this->getEntityName());
        return $stmt->fetchAll();

    }


    public function findByField($field,$value){

    }

    public function save(Entity $entity)
    {
        // If the ID is set, we're updating an existing record
        if (isset($entity->id)) {
            return $this->update($entity);
        }

        //prepare the insert params
        $list = array();
        $fields = array();
        foreach($this->getColumnMap() as $key => $col){
            if (isset($entity->{$col})){
                $list[":".$col]=$entity->{$col};
                array_push($fields,$col);
            }
        }

        $query = "INSERT INTO ". $this->getTableName() . " (`". implode("`,`",$fields). "`) VALUES (". implode(',',array_keys($list)) .")";

        $stmt = $this->connection->prepare($query);

        foreach($list as $identity => $value){
            switch(gettype($value)){
                case 'integer':
                case 'double':
                    $stmt->bindValue($identity, $value, PDO::PARAM_INT);
                    break;
                default:
                    $stmt->bindValue($identity, $value, PDO::PARAM_STR);
                    break;
            }
        }

        return $stmt->execute();
    }

    public function update(Entity $entity)
    {
        if (!isset($entity->id)) {
            // We can't update a record unless it exists...
            throw new \LogicException(
                'Cannot update user that does not yet exist in the database.'
            );
            return false;
        }

        $query = "UPDATE " . $this->getTableName() . " SET ";

        $condition = "";
        foreach($this->getColumnMap() as $key => $column){
            if ($column != 'id' && $column != 'date_modified'){
                $condition .= $column . " = :".$column.",";
            }
        }
        $query .= rtrim($condition, ',') . " WHERE id = :id ";

        $stmt = $this->connection->prepare($query);

        foreach($this->getColumnMap() as $key => $col){
            if($col != 'date_modified'){
                switch(gettype($entity->{$col})){
                    case 'integer':
                    case 'double':
                        $stmt->bindParam(':' . $col, $entity->{$col}, PDO::PARAM_INT);
                        break;
                    default:
                        $stmt->bindParam(':' . $col, $entity->{$col}, PDO::PARAM_STR);
                        break;
                }
            }
        }
        return $stmt->execute();
    }

    /**
     * Save all the entities in
     * one transaction
     * Roll back in case of failure
     *
     * throw errors
     * @param array $data
     */
    public function saveAll(array $data){
    }

    /**
     * @param $id
     * @return mixed
     */
    public function delete($id){
        $query = "DELETE FROM " . $this->getTableName();
        $query .= " WHERE `id` = :id";
        $stmt = $this->connection->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    /**
     * @return mixed
     */
    protected function getEntityName(){
        return $this->entityName;
    }

    /**
     * @return mixed
     */
    protected function getTableName(){
        return $this->tableName;
    }

    /**
     * @return mixed
     */
    protected function getColumnMap(){
        if (!isset($this->columnMap)){
            $query = $this->connection->prepare("DESCRIBE ".$this->getTableName());
            $query->execute();
            $result = $query->fetchAll(PDO::FETCH_COLUMN);

            if ($result){
                foreach($result as $col){
                    $this->columnMap[] = $col;
                }
            }
        }
        return $this->columnMap;
    }

    public function getLastInsertedId(){
        return $this->connection->lastInsertId();
    }

    public function setLimit($limit){
        $this->limit = $limit;
    }

    public function getLimit(){
        return $this->limit;
    }

    public function setOffset($offset){
        $this->offset = $offset;
    }

    public function getOffset(){
        return $this->offset;
    }
} 
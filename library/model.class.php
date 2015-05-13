<?php
class Model
{
    private static $repositoryList = array();

    public static function getRepository($entityName){

        $entityName = strtolower($entityName);

        if (!isset(self::$repositoryList[$entityName])){

            $repositoryClassName = ucfirst($entityName).'Repository';
            self::$repositoryList[$entityName] = new $repositoryClassName(ucfirst($entityName));
        }
        return self::$repositoryList[$entityName];
    }

}

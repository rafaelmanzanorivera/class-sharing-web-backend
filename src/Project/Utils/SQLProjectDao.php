<?php
/**
 * Created by PhpStorm.
 * User: rafaelmanzano
 * Date: 2019-03-11
 * Time: 16:48
 */

namespace Project\Utils;
class SQLProjectDao implements ProjectDAO
{
    private $dbConnection;

    public function __construct(\PDO $connection)
    {
        $this->dbConnection = $connection;
    }

    public function fetchAll($sql, $params = null)
    {
        $stm = $this->dbConnection->prepare($sql);
        $stm->execute();
        return $stm->fetchAll();
    }

    public function insert($sql, $params = null)
    {
        $stm = $this->dbConnection->prepare($sql);
        $stm->execute($params);
        return $this->dbConnection->lastInsertId();
    }

    public function execute($sql, $params = null)
    {
        $stm = $this->dbConnection->prepare($sql);
        $stm->execute($params);
    }

    public function fetch($sql, $params = null)
    {
        $stm = $this->dbConnection->prepare($sql);
//        $stm->bindParam(1,$params[0]);
        $stm->execute($params);
        return $stm->fetch();
    }


}
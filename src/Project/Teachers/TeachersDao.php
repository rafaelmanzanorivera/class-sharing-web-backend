<?php
/**
 * Created by PhpStorm.
 * User: rafaelmanzano
 * Date: 2019-03-29
 * Time: 17:18
 */

namespace Project\Teachers;


class TeachersDao
{
    private $projectDao;

    public function __construct(\Project\Utils\ProjectDAO $projectDao)
    {
        $this->projectDao = $projectDao;
    }

    public function getAll()
    {
        $sql = "select * from Teachers";
        $users = $this->projectDao->fetchAll($sql);
        return $users;
    }

    public function getUserById($id)
    {
        $sql = "select * from Teachers where id_teacher = ?";

        return $this->projectDao->fetch($sql,array($id));
    }

    public function createUser($teacher)
    {
        $sql = "INSERT INTO Teachers (name,subjects,mail,phone,age,schedule,description) values (?,?,?,?,?,?,?)";
        $id = $this->projectDao->insert($sql,array($teacher['name'],$teacher['subjects'],$teacher['mail'],$teacher['phone'],$teacher['age'],$teacher['schedule'],$teacher['description']));

        return $this->getUserById($id);

    }

    public function updateUser($id,$user)
    {
        $sql = "UPDATE Teachers set name=?, subjects=?, mail=?, phone=?, age=?, schedule=?, description=? where id_teacher=?";
        $this->projectDao->execute($sql,array($user['name'],$user['subjects'],$user['mail'],$user['phone'],$user['age'],$user['schedule'],$user['description'],$id));
        return $this->getUserById($id);

    }

    public function deleteUser($id)
    {
        $sql = "delete from Teachers where id_teacher = ?";
        return $this->projectDao->execute($sql,array($id));
    }

}
<?php
/**
 * Created by PhpStorm.
 * User: rafaelmanzano
 * Date: 2019-03-29
 * Time: 17:18
 */

namespace Project\Students;


class StudentsDao
{
    private $projectDao;

    public function __construct(\Project\Utils\ProjectDAO $projectDao)
    {
        $this->projectDao = $projectDao;
    }

    public function getAll()
    {
        $sql = "select * from Students";
        $users = $this->projectDao->fetchAll($sql);
        return $users;
    }

    public function getUserById($id)
    {
        $sql = "select * from Students where id_student = ?";

        return $this->projectDao->fetch($sql,array($id));
    }

    public function createUser($teacher)
    {
        $sql = "INSERT INTO Students (name,subjects,mail,phone,age,schedule,description) values (?,?,?,?,?,?,?)";
        $id = $this->projectDao->insert($sql,array($teacher['name'],$teacher['subjects'],$teacher['mail'],$teacher['phone'],$teacher['age'],$teacher['schedule'],$teacher['description']));

        return $this->getUserById($id);

    }

    public function updateUser($id,$user)
    {
        $sql = "UPDATE Students set name=?, subjects=?, mail=?, phone=?, age=?, schedule=?, description=? where id_student=?";
        $this->projectDao->execute($sql,array($user['name'],$user['subjects'],$user['mail'],$user['phone'],$user['age'],$user['schedule'],$user['description'],$id));
        return $this->getUserById($id);
    }

    public function deleteUser($id)
    {
        $sql = "delete from Students where id_student = ?";
        return $this->projectDao->execute($sql,array($id));
    }

}
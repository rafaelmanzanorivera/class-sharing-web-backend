<?php

namespace Project\Users;

use Slim\Container;

class UsersDao
{
    private $proyectDao;

    public function __construct(\Project\Utils\ProjectDAO $proyectDao)
    {
        $this->proyectDao = $proyectDao;
    }

    public function getAll()
    {
        $sql = "select * from users";
        $users = $this->proyectDao->fetchAll($sql);
        return $users;
    }

    public function getUserById($id)
    {
        $sql = "select name,mail,token,phone,birth from users where id_user = ?";

        return $this->proyectDao->fetch($sql,array($id));
    }

    public function createUser($user)
    {
        $sql = "INSERT INTO USERS (name,mail,password,token,phone,birth) values (?,?,?,?,?,?)";
        $id = $this->proyectDao->insert($sql,array($user['name'],$user['mail'],hash('sha256', $user['password']),$user['token'],$user['phone'],$user['birth']));

        return $this->getUserById($id);

    }

    public function updateUser($id,$user)
    {
        $sql = "UPDATE users SET name=?, mail=?, password=?, token=?, phone=?, birth=? WHERE id_user=?";
        $this->proyectDao->execute($sql,array($user['name'],$user['mail'],$user['password'],$user['token'],$user['phone'],$user['birth'],$user['id_user']));
        return $this->getUserById($id);
    }

    public function deleteUser($id)
    {
        $sql = "delete from users where id = ?";
        return $this->proyectDao->execute($sql,array($id));
    }

    public function loginUser($userCredentials)
    {
        $sql = "SELECT id_user, password, token from USERS where mail = ?";
        $id_user = $this->proyectDao->fetch($sql,array($userCredentials['mail']));

        if($id_user['password'] == hash('sha256', $userCredentials['password']))
            return $this->getUserById($id_user['id_user']);

        return null;
    }

}

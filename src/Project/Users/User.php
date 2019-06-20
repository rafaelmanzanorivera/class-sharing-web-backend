<?php

namespace Project\Users;

class User
{
    public $id;
    public $name;
    public $mail;
    public $password;
    public $token;
    public $phone;
    public $birth;


    public function __construct( $id,$name,$mail,$password,$phone,$birth)
    {
        $this->id = $id;
        $this->name = $name;
        $this->mail = $mail;
        $this->password = $password;
        $this->phone = $phone;
        $this->birth = $birth;
    }

}
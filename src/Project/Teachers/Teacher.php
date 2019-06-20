<?php

namespace Project\Users;

class Teacher
{
    public $id_teacher;
    public $name;
    public $subject;
    public $mail;
    public $phone;
    public $age;
    public $schedule;
    public $description;

    public function __construct($id_teacher,$name,$subject,$mail,$phone,$age,$schedule,$description)
    {
        $this->id_teacher = $id_teacher;
        $this->name = $name;
        $this->subject = $subject;
        $this->mail = $mail;
        $this->phone = $phone;
        $this->age = $age;
        $this->schedule = $schedule;
        $this->description = $description;
    }



}
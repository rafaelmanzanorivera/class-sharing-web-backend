<?php

namespace Project\Users;

class Student
{
    public $id_student;
    public $name;
    public $subject;
    public $mail;
    public $phone;
    public $age;
    public $schedule;
    public $description;

    public function __construct($id_student,$name,$subject,$mail,$phone,$age,$schedule,$description)
    {
        $this->id_student = $id_student;
        $this->name = $name;
        $this->subject = $subject;
        $this->mail = $mail;
        $this->phone = $phone;
        $this->age = $age;
        $this->schedule = $schedule;
        $this->description = $description;
    }



}
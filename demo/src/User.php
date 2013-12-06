<?php

class User {
    private $age;
    private $money;
    private $name;

    public function __construct($name, $age, $money)
    {
        $this->age = (int) $age;
        $this->money = (float) $money;
        $this->name = (string) $name;
    }

    public function getAge()
    {
        return $this->age;
    }

    public function getMoney()
    {
        return $this->money;
    }

    public function getName()
    {
        return $this->name;
    }
}
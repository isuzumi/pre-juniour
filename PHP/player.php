<?php

class player
{
    private $name;
    private $city;

    public function __construct($name)
    {
        $this->name = $name;
    }

    public function setCity($city)
    {
        $this->city = '('.$city.')';
        return $this;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getCity()
    {
        return $this->city;
    }

}


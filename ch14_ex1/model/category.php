<?php

// Savier Osman
// 12/05/2022
// Modified class so contructor has zero attributes.

class Category {
    private $id;
    private $name;

    // Modified constructor to have zero attributes
    public function __construct() {
        $this->id = 0;
        $this->name = '';
    }

    public function getID() {
        return $this->id;
    }

    public function setID($value) {
        $this->id = $value;
    }

    public function getName() {
        return $this->name;
    }

    public function setName($value) {
        $this->name = $value;
    }
}
?>
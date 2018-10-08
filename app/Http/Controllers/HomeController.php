<?php

class HomeController {

    public function __construct($action) {
      $this->{ $action }();
    }

    public function frontpage() {
        echo "Welcome!";
    }

    public function error() {
        echo "Error!";
    }

}
<?php

class HomeController {

    public function __construct($action) {
      $this->{ $action }();
    }

    public function frontpage() {
        echo "Home/Welcome!";
    }

    public function error() {
        echo "Home/Error!";
    }

}
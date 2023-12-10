<?php

require_once("controllers/Functions.php");

abstract class MainController{
    private $functions;
    public function __construct(){
        $this->functions = new Functions();
    }

   
}
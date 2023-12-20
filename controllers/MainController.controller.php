<?php


require_once("controllers/Tools.php");
require_once("controllers/Functions.php");


//  tous les controllers héritent de cette classe
//  en cas de besoin global, une implémentation ici se répercutera sur tous les controllers

abstract class MainController{
    private $functions;
    public function __construct(){
        $this->functions = new Functions();
    }

   
}
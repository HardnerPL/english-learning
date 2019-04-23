<?php

session_start();

require "Database.php";
require "Router.php";

abstract class Framework {
    
    public function view($filename, $data) {
        include 'view/templates/'.$filename.'.php';
    }
    
    public function script($filename) {
        require_once 'view/scripts/'.$filename.'.php';
    }
    
    public function model($filename) {
        require_once 'model/'.$filename.'.php';
    }
    
    public function library($filename) {
        require_once 'library/'.$filename.'.php';
    }
}


<?php

abstract class Framework {
    
    public function view($filename, $data) {
        include ROOT . 'view/templates/'.$filename.'.php';
    }
    
    public function script($filename) {
        require_once ROOT . 'view/scripts/'.$filename.'.php';
    }
    
    public function model($filename) {
        require_once ROOT . 'model/'.$filename.'.php';
    }
    
    public function library($filename) {
        require_once ROOT . 'library/'.$filename.'.php';
    }
}




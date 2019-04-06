<?php

require "dejtabejs.php";

class Framework {
    
    public function view($filename, $data) {
        require 'view/templates/'.$filename.'.php';
    }
    
    public function script($filename) {
        require 'view/scripts/'.$filename.'.php';
    }
    
    public function model($filename) {
        require 'model/'.$filename.'.php';
    }
    
    public function library($filename) {
        require 'library/'.$filename.'.php';
    }
}


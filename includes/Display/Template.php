<?php

class Template {
    
    private $template;
    
    public function __construct($template) {
        $this->template = $template;
    }
    
    public function load() {
        require "templates/{$this->template}.php";
    }
}
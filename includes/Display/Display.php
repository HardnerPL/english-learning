<?php

require 'Template.php';
require 'Theme.php';

function issetor($string, $default) {
    if (isset($string)) {
        return $string;
    }
    return $default;
}

class Display {
    
    private $theme;
    private $content;
    
    public function __construct($theme = "default") {
        $this->theme = new Theme($theme);
        $this->content = array();
    }
    
    public function setContent($content) {
        $this->content = $content;
    }
    
    public function addTemplate($template) {
        array_push($this->content, new Template($template));
    }
    
    public function display() {
        $this->theme->load($this->content);
    }
    
    public static function url($url) {
        header("Location: $url");
        die();
    }
}


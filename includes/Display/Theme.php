<?php

class Theme {
    
    private $theme;
    
    public function __construct($theme) {
        $this->theme = $theme;
    }
    
    public function load($templates, $scripts) {
        require "themes/{$this->theme}/theme.php";
    }
}


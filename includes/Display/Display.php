<?php

require 'Script.php';
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
    private $templates;
    private $scripts;
    
    public function __construct($theme = "default") {
        $this->theme = new Theme($theme);
        $this->templates = array();
        $this->scripts = array();
    }
    
    public function setTemplates($templates) {
        $templateArr = explode(',', $templates);
        foreach($templateArr as $template) {
        array_push($this->templates, new Template(trim($template)));
        }
    }
    
    public function setScripts($scripts) {
        $scriptsArr = explode(',', $scripts);
        foreach($scriptsArr as $script) {
        array_push($this->scripts, new Script(trim($script)));
        }
    }
    
    public function display() {
        $this->theme->load($this->templates, $this->scripts);
    }
    
    public static function url($url) {
        header("Location: $url");
        die();
    }
}


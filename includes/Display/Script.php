<?php
class Script {
    
    private $script;
    
    public function __construct($script) {
        $this->script = $script;
    }
    
    public function load() {
        require "scripts/{$this->script}.php";
    }
}
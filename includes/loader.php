<?php

ob_start();

require 'database.php';
require 'user.php';
require 'word.php';

session_start();

class Loader {
    public static function loadHeader() {
        include 'header.php';
    }
    
    public static function loadScripts() {
        include 'scripts.php';
    }
    
    public static function loadFooter() {
        include 'footer.php';
    }
    
    public static function loadNavbar() {
        include 'navbar.php';
    }
    
    public static function url($url) {
        header("Location: $url");
        die();
    }
}


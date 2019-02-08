<?php

session_start();

require 'database.php';

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
}


<?php

require 'scripts/database.php';
require 'includes/Display/Display.php';

class Loader {
    
    public static function load($requires = 'all') {
        ob_start();
        $toLoad = explode(',', $requires);
        foreach($toLoad as $filename) {
            $filename = trim($filename);
            switch($filename) {
                case 'user':
                    require 'scripts/user.php';
                    break;
                case 'word':
                    require 'scripts/word.php';
                    break;
                default:
                    require 'scripts/user.php';
                    require 'scripts/word.php';
                    
            }
        }
        session_start();
    }
}


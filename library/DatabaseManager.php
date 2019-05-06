<?php

class DatabaseManager {

    public static $link;

    public static function link() {
        self::$link = mysqli_connect('localhost', 'root', '', 'english-learning');
        mysqli_set_charset(self::$link, 'utf8mb4');
    }

    public static function query($query) {
        $result = mysqli_query(self::$link, $query);
        if ($result) {
            return $result;
        } else {
            die("ERROR! " . mysqli_error(self::$link) . "<br> YOUR QUERY: " . $query);
        }
    }

    public static function escape($string) {
        return mysqli_real_escape_string(self::$link, $string);
    }

    public static function resultCount() {
        return mysqli_affected_rows(self::$link);
    }

    public static function fieldCount() {
        return mysqli_field_count(self::$link);
    }

    public static function getRow($result) {
        return mysqli_fetch_assoc($result);
    }
}

DatabaseManager::link();
<?php

class Database {

    private $link;

    function Database() {
        $this->link = mysqli_connect('localhost', 'root', '', 'english-learning');
        mysqli_set_charset($this->link, 'utf8');
    }

    function query($query) {
        $result = mysqli_query($this->link, $query);
        if ($result) {
            return $result;
        } else {
            die("ERROR! " . mysqli_error($this->link) . "<br> YOUR QUERY: " . $query);
        }
    }

    function escape($string) {
        return mysqli_real_escape_string($this->link, $string);
    }

    function resultCount() {
        return mysqli_affected_rows($this->link);
    }

    function fieldCount() {
        return mysqli_field_count($this->link);
    }

    function getRow($result) {
        return mysqli_fetch_assoc($result);
    }
}

$mysql = new Database();
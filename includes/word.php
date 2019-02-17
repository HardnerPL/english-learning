<?php

class Word {
    private $id;
    private $name;
    private $explanation;
    private $type;
    private $acceptable;
    private $difficulty;
    private $status;
    private $userId;
    
    function __construct($id, $name, $explanation, $type, $acceptable, $difficulty, $status, $userId) {
        $this->id = $id;
        $this->name = $name;
        $this->explanation = $explanation;
        $this->type = $type;
        $this->acceptable = $acceptable;
        $this->difficulty = $difficulty;
        $this->status = $status;
        $this->userId = $userId;
    }
    
    static function fromId($id) {
        global $mysql;
        $query = "SELECT * FROM words WHERE id = $id";
        $result = $mysql->query($query);
        $row = $mysql->getRow($result);
        return Word::fromRow($row);
    }
    
    static function fromRow($row) {
        return new Word($row['id'], $row['name'], $row['explanation'], $row['type'], $row['acceptable'], $row['difficulty'], $row['status'], $row['userId']);
    }
    
    function getId() {
        return $this->id;
    }
    
    function getName() {
        return $this->name;
    }

    function getExplanation() {
        return $this->explanation;
    }

    function getType() {
        return $this->type;
    }

    function getAcceptable() {
        return $this->acceptable;
    }

    function getDifficulty() {
        return $this->difficulty;
    }

    function getStatus() {
        return $this->status;
    }

    function getUserId() {
        return $this->userId;
    }
}
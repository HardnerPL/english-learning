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
    private $synonyms;
    private $related;

    function __construct($id, $name, $explanation, $type, $acceptable, $difficulty, $status, $userId, $synonyms, $related) {
        $this->id = $id;
        $this->name = $name;
        $this->explanation = $explanation;
        $this->type = $type;
        $this->acceptable = $acceptable;
        $this->difficulty = $difficulty;
        $this->status = $status;
        $this->userId = $userId;
        $this->synonyms = $synonyms;
        $this->related = $related;
    }

    static function fromId($id) {
        global $mysql;
        $id = $mysql->escape($id);
        $query = "SELECT * FROM words WHERE id = $id";
        $result = $mysql->query($query);
        if ($row = $mysql->getRow($result)) {
            return Word::fromRow($row);
        } return NULL;
    }

    static function fromName($name) {
        global $mysql;
        $name = $mysql->escape($name);
        $query = "SELECT * FROM words WHERE name = '$name'";
        $result = $mysql->query($query);
        if ($row = $mysql->getRow($result)) {
            return Word::fromRow($row);
        } return NULL;
    }

    static function fromRow($row) {
        return new Word($row['id'], $row['name'], $row['explanation'], $row['type'], $row['acceptable'], $row['difficulty'], $row['status'], $row['userId'], $row['synonyms'], $row['related']);
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

    function getSynonyms() {
        return $this->synonyms;
    }

    function getRelated() {
        return $this->related;
    }

}

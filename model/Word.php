<?php

class Word {

    private $id;
    private $name;
    private $explanation;
    private $type;
    private $use;
    private $difficulty;
    private $status;
    private $userId;
    private $synonyms;
    private $related;

    function __construct($id, $name, $explanation, $type, $use, $difficulty, $status, $userId, $synonyms, $related) {
        $this->id = $id;
        $this->name = $name;
        $this->explanation = $explanation;
        $this->type = $type;
        $this->use = $use;
        $this->difficulty = $difficulty;
        $this->status = $status;
        $this->userId = $userId;
        $this->synonyms = $synonyms;
        $this->related = $related;
    }

    static function fromId($id) {
        $id = Database::escape($id);
        $query = "SELECT * FROM words WHERE id = $id";
        $result = Database::query($query);
        if ($row = Database::getRow($result)) {
            return Word::fromRow($row);
        } return NULL;
    }

    static function fromName($name) {
        $name = Database::escape($name);
        $query = "SELECT * FROM words WHERE name = '$name'";
        $result = Database::query($query);
        if ($row = Database::getRow($result)) {
            return Word::fromRow($row);
        } return NULL;
    }

    static function fromRow($row) {
        return new Word($row['id'], $row['name'], $row['explanation'], $row['type'], $row['use'], $row['difficulty'], $row['status'], $row['userId'], $row['synonyms'], $row['related']);
    }

    function getId() {
        return $this->id;
    }

    function getName() {
        return trim($this->name);
    }

    function getExplanation() {
        return $this->explanation;
    }
    
    function getDefinition() {
        return explode(PHP_EOL, $this->explanation)[0];
    }

    function getType() {
        return $this->type;
    }

    function getUse() {
        return $this->use;
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
    
    public static function add($word) {
        $query = "INSERT INTO words (name, explanation, type, `use`, difficulty, synonyms, related, status, userId) VALUES "
                . "('{$word->getName()}', "
                . "'{$word->getExplanation()}', "
                . "'{$word->getType()}', "
                . "'{$word->getUse()}', "
                . "'{$word->getDifficulty()}', "
                . "'{$word->getSynonyms()}', "
                . "'{$word->getRelated()}', "
                . "'{$word->getStatus()}', "
                . "'{$word->getUserId()}')";
        Database::query($query);
    }
    
    public static function isWordCreated($name) {
        $name = Database::escape($name);
        $query = "SELECT * FROM words WHERE name = '$name'";
        Database::query($query);
        if (Database::resultCount() != 0) {
            return true;
        } return false;
    }

}

<?php

require_once 'framework/Framework.php';

class Controler extends Framework {

    public function __construct($page = NULL) {
        $this->model('User');
        $this->model('Word');
        $this->model('Session');
    }
    
    public function index() {
        $this->view('header', $data);
        $this->view('navbar', $data);
        
        $data['words'] = Word::getWords();
        
        $this->view('footer', $data);
    }
}

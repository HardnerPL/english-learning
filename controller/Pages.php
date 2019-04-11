<?php

require_once 'framework/Framework.php';

class Pages extends Framework {

    public function __construct($page = NULL) {
        $this->model('User');
        $this->model('Word');
        $this->library('SessionManager');
    }

    public function index() {
        $data = array();
        $data['words'] = Word::getWords($data);
        
        $this->view('header', $data);
        $this->view('navbar', $data);
        
        $this->view('table', $data);
        $this->view('sidebar', $data);

        $this->script('coreScripts');
        $this->view('footer', $data);
    }

}

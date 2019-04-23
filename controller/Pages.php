<?php

require_once 'framework/Framework.php';

class Pages extends Framework {

    public function __construct() {}

    public function index()
    {
        $this->model('User');
        $this->model('Word');
        $this->library('SessionManager');

        $data = array();
        $data['words'] = Word::getWords($data);
        $data['title'] = "English Learning";
        
        $this->view('header', $data);
        $this->view('navbar', $data);
        
        $this->view('table', $data);
        $this->view('sidebar', $data);

        $this->script('coreScripts');
        $this->view('footer', $data);
    }

    public function pageNotFound404() {
        $data['title'] = "404 Not Found";
        $this->view('header', $data);
        $this->view('404', array());
        $this->script('coreScripts');
        $this->view('footer', $data);
    }

}

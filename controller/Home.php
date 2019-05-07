<?php

require_once ROOT . "framework/Framework.php";

class Home extends Framework {

    public function __construct()
    {
        $this->library('DatabaseManager');
        $this->library('SessionManager');
    }

    public function index()
    {
        $this->model('User');
        $this->model('Word');
        sessionStart();

        $data = array();
        $data['user'] = User::getUser();
        $data['words'] = Word::getWords($data);
        $data['title'] = "English Learning";
        
        $this->view('header', $data);
        $this->view('navbar', $data);
        
        $this->view('table', $data);
        $this->view('sidebar', $data);

        $this->script('coreScripts');
        $this->script('tableScripts');

        $this->view('footer', $data);
    }

    public function login($mode = 'login')
    {
        $this->model('User');
        sessionStart();

        if ($mode == 'logout') {
            User::logout();
        } else {
            User::login();
            $data = array();
            $data['user'] = User::getUser();

            $this->view('header', $data);
            $this->view('navbar', $data);

            $this->view('loginForm', $data);

            $this->script('coreScripts');
            $this->view('footer', $data);
        }
    }

    public function pageNotFound404()
    {
        $data['title'] = "404 Not Found";
        $this->view('header', $data);
        $this->view('404', array());
        $this->script('coreScripts');
        $this->view('footer', $data);
    }

}

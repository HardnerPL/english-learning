<?php

require_once ROOT . "framework/Framework.php";

class Home extends Framework
{

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
        $data['title'] = "Home | English Learning";

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
            $data['title'] = "Log in | English Learning";
            $data['user'] = User::getUser();

            $this->view('header', $data);
            $this->view('navbar', $data);

            $this->view('loginForm', $data);

            $this->script('coreScripts');
            $this->view('footer', $data);
        }
    }

    public function register()
    {
        $this->model('user');

        $data = array();
        $data['title'] = "Register | English Learning";
        User::register();

        $this->view('header', $data);
        $this->view('navbar', $data);

        $this->view('registerForm', $data);

        $this->script('coreScripts');
        $this->view('footer', $data);
    }

    public function word()
    {
        $this->model('User');
        $this->model('Word');
        sessionStart();

        $data = array();
        $data['user'] = User::getUser();
        $data['word'] = Word::getSelectedWord();
        $data['title'] = "Words | English Learning";
        if (!empty($data['word'])) {
            $this->view('header', $data);
            $this->view('navbar', $data);

            $this->view('word', $data);
            $this->view('sidebar', $data);

            $this->script('coreScripts');
            $this->script('wordScripts');

            $this->view('footer', $data);
        } else {
            header("Location: index.php");
        }
    }

    public function pageNotFinished()
    {
        $data['title'] = "Work in progress | English Learning";
        $this->view('header', $data);
        $this->view('notFinished', $data);
        $this->script('coreScripts');
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

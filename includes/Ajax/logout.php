<?php
define("ROOT", $_SERVER['DOCUMENT_ROOT'] . '/english-learning/');
require_once ROOT . "controller/Home.php";

(new Home())->login('logout');
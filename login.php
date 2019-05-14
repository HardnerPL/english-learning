<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->

<?php
define("ROOT", $_SERVER['DOCUMENT_ROOT'] . '/english-learning/');
require_once ROOT . "controller/Home.php";

(new Home())->login();
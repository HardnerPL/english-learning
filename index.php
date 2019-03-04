<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->

<?php
require_once 'includes/Loader/Loader.php';

$loader = new Loader();
$loader->load();

$display = new Display();
$display->addTemplate('table');
$display->display();
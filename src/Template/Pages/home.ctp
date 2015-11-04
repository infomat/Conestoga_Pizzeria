<?php

use Cake\Cache\Cache;
use Cake\Core\Configure;
use Cake\Datasource\ConnectionManager;
use Cake\Error\Debugger;
use Cake\Network\Exception\NotFoundException;

$this->layout = false;

if (!Configure::read('debug')):
    throw new NotFoundException();
endif;

$pizzeriaDescription = 'Conestoga Pizzeria';
?>
<!DOCTYPE html>
<html>
<head>
    <title>
        <?= $pizzeriaDescription ?>
    </title>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

    <?= $this->Html->meta('icon') ?>
    <?= $this->Html->css('base.css') ?>
    <?= $this->Html->css('cake.css') ?>
    <?= $this->Html->css('style.css') ?>
</head>
<body>
    <header>
        <h1 id="maintitle">Conestoga Pizzeria</h1>
    </header>
    <nav>
        
    <ul class="pull-right">
        <li><a href="/users/signup/">Sign Up</a></li>
        <li><a href="/users/login/">Log In</a></li>
    </ul>
    </nav>
    <footer>
        <p>&copy; 2015 Conestoga Pizzeria All rights reserved.</p>
    </footer>
</body>
</html>

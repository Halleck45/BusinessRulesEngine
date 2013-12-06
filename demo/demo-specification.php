<?php

require_once __DIR__ . '/vendor/autoload.php';

$user = new User('jean-françois',27, 500);

$spec = (new UserIsAdult())
    ->orSpec(new UserHasEnoughMoney(200));

var_dump($spec->isSatisfiedBy($user)); // true



$spec = (new UserIsAdult())
    ->andSpec(new UserHasEnoughMoney(600));

var_dump($spec->isSatisfiedBy($user)); // false
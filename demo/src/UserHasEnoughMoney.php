<?php

class UserHasEnoughMoney extends Specification\Specification {

    private $required;

    public function __construct($required)
    {
        $this->required = (float) $required;
    }


    public function isSatisfiedBy($item) {
        return \BRE('user.money > required', ['user' => $item, 'required' => $this->required]);
    }

}
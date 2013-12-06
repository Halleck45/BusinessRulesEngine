<?php
class UserIsAdult extends Specification\Specification {

    public function isSatisfiedBy($item) {
        return \BRE('user.age > 18', ['user' => $item]);
    }
}
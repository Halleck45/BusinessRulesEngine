<?php

namespace Test\Hal\BusinessRulesEngine\CollectionFilterTest;

require_once __DIR__.'/../vendor/autoload.php';

class CollectionFilterTest extends \PHPUnit_Framework_TestCase {



    public function testCollectionIsFiltered() {
        $collection = new \Hal\BusinessRulesEngine\Collection(array(
            new User('jean-françois',27)
            , new User('bénédicte',28)
            , new User('bob',5) // is not adult
            , new User('alice',40) // is too old
        ));
        $request = $collection->where('user => user.age > 18 and user.age < 40');

        $result = array();
        foreach($request as $item) {
            $result[] = $item->name;
        }
        $this->assertEquals(array('jean-françois', 'bénédicte'), $result);
    }

    public function testCollectionAcceptsArgumentAfterFiltering() {
        $collection = new \Hal\BusinessRulesEngine\Collection(array(
            new User('jean-françois',27, 500)
            , new User('bénédicte',28, 500)
            , new User('bob',5, 0) // is not adult
            , new User('alice',40, 0) // is too old
        ));
        $request = $collection->where('user => user.age > 18 and user.age < 40');

        $collection->push(new User('isAddedAfter',30, 500));

        $this->assertEquals(3, sizeof($request));

    }
}

class User {
    public $name;
    public $age;

    public function __construct($name, $age)
    {
        $this->age = $age;
        $this->name = $name;
    }


}
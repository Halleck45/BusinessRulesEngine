<?php
namespace Test\Hal\BusinessRulesEngine\BusinessRuleEngineTest;

require_once __DIR__.'/../vendor/autoload.php';

class BusinessRuleEngineTest extends \PHPUnit_Framework_TestCase {


    /**
     * @dataProvider provideValidValues
     */
    public function testRuleIsEvaluated($expected, $expression) {
        $result = \BRE($expression, array('user' => new User));
        $this->assertEquals($expected, $result);
    }

    public function provideValidValues() {
        return array(
            array(true,'user.money > 300')
            , array(false,'user.money < 300')
            , array(true,'user.money > 300 and user.age > 18')
            , array(false,'user.money > 300 and user.age < 18')
        );
    }

    public function testICanUseShortExpressionToGiveVariables() {
        $result = \BRE('user => user.age > 18', new User);
        $this->assertEquals(true, $result);
    }
}

class User {
    public $age = 25;
    public $money = 400;
}
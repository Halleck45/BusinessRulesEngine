# BusinessRulesEngine

POC of minimalist BusinessRulesEngine with Symfony 2.4 ExpressionLanguage component.

This package contains two component:

+ `Hal\Component\BusinessRulesEngine\Collection`: collection filtered with business rules
+ `BRE`: evaluation function

# Installation

    curl -sS https://getcomposer.org/installer | php
    php composer.phar install

# Usage

### Business rules

```php
class User { public $age = 25; }
$user = new User;

BRE('user => user.age > 18', $user); // true
BRE('user => user.age > 18', $user); // false
BRE('user => user.age > 18 and user.age < 45', $user); // true

// you can provide multiple variables as following:
BRE('user.age > required', array('foo' => $user, 'required' 18); // true

```

### Collection

```php
use \Hal\Component\BusinessRulesEngine\Collection;
$collection = new \Hal\Component\BusinessRulesEngine\Collection(array(
    new User('jean-françois',27)
    , new User('bénédicte',28)
    , new User('bob',5) // is not adult
    , new User('alice',40) // is too old
));
$request = $collection->where('user => user.age > 18 and user.age < 40');

// you can add item after the filtering. Rule will be evaluated at least.
$collection->push(new User('isAddedAfter',30, 500));

foreach($request as $item) {
    echo $item->name;
}
//jean-françois
//bénédicte
//isAddedAfter
```

# Why this poc ?

This component comes with a light implementation of [Specification](http://blog.lepine.pro/php/gerer-des-regles-metiers-complexes-etou-changeantes)(fr) pattern. You'll fint it in the folder `demo`.

```php
$user = new User('jean-françois',27, 500);

$spec = (new UserIsAdult())
        ->orSpec(new UserHasEnoughMoney(200));
var_dump($spec->isSatisfiedBy($user));
// true


$spec = (new UserIsAdult())
        ->andSpec(new UserHasEnoughMoney(600));
// false
```
# Author

+ Jean-François Lépine <[blog.lepine.pro](http://blog.lepine.pro)>

# Licence

See the LICENCE file
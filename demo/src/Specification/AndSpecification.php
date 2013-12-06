<?php

namespace Specification;

class AndSpecification extends Specification implements SpecificationInterface
{

    private $specification1;
    private $specification2;

    function __construct(SpecificationInterface $specification1, SpecificationInterface $specification2)
    {
        $this->specification1 = $specification1;
        $this->specification2 = $specification2;
    }

    public function isSatisfiedBy($object)
    {
        return $this->specification1->isSatisfiedBy($object) && $this->specification2->isSatisfiedBy($object);
    }

}
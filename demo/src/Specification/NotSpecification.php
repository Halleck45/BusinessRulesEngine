<?php

namespace Specification;

class NotSpecification extends Specification implements SpecificationInterface
{

    private $specification;

    public function __construct($specification)
    {
        $this->specification = $specification;
    }

    public function isSatisfiedBy($object)
    {
        return !$this->specification->isSatisfiedBy($object);
    }

}
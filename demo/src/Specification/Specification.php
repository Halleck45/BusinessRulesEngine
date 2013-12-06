<?php

namespace Specification;

abstract class Specification implements SpecificationInterface
{

    public function andSpec(SpecificationInterface $specification)
    {
        return new AndSpecification($this, $specification);
    }

    public function orSpec(SpecificationInterface $specification)
    {
        return new OrSpecification($this, $specification);
    }

    public function notSpec(SpecificationInterface $specification)
    {
        return new NotSpecification($specification);
    }

}
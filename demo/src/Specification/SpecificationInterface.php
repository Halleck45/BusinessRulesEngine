<?php

namespace Specification;

interface SpecificationInterface
{

    public function isSatisfiedBy($object);

    public function andSpec(SpecificationInterface $specification);

    public function orSpec(SpecificationInterface $specification);

    public function notSpec(SpecificationInterface $specification);
}

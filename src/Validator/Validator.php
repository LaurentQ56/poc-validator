<?php

declare(strict_types=1);

namespace POCIterator\Validator;

interface Validator
{
    public function validate(object $entity): void;
}

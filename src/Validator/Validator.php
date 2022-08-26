<?php

declare(strict_types=1);

namespace POCValidator\Validator;

interface Validator
{
    public function validate(object $entity): array;
}

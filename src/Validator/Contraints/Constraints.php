<?php

declare(strict_types=1);

namespace POCValidator\Validator\Contraints;

interface Constraints
{
    public function support(string $constraint): bool;

    /**
     * @param string|int|string[] $value
     * @param string|int|string[] $constraintValue
     *
     * @return array|void
     */
    public function validate(string $constraint, $constraintValue, string $propertyPath, $value);
}

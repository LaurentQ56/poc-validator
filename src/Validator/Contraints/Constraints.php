<?php

declare(strict_types=1);

namespace POCIterator\Validator\Contraints;

interface Constraints
{
    public function support(string $constraint): bool;

    /**
     * @param string|int|string[] $value
     */
    public function constraint(string $constraint, string $propertyPath, $value): void;
}

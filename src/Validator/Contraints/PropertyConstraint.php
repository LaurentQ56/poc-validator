<?php

declare(strict_types=1);

namespace POCIterator\Validator\Contraints;

final class PropertyConstraint
{
    private iterable $validators;

    public function __construct(iterable $validators)
    {
        $this->validators = $validators;
    }

    public function constraint(string $constraint, string $propertyPath, $value): void
    {
        foreach ($this->validators as $validator) {
            if ($validator->support($constraint)) {
                $validator->constraint($constraint, $propertyPath, $value);
            }
        }
    }
}

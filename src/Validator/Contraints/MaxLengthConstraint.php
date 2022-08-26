<?php

declare(strict_types=1);

namespace POCValidator\Validator\Contraints;

use POCValidator\Validator\Entities\Exception\MaxLengthException;

final class MaxLengthConstraint implements Constraints
{
    public function support(string $constraint): bool
    {
        return 'maxLength' === $constraint;
    }

    /**
     * @inheritDoc
     */
    public function validate(string $constraint, $constraintValue, $propertyPath, $value)
    {
        if (strlen($value) > $constraintValue) {
            return sprintf(MaxLengthException::MESSAGE, $propertyPath, $constraintValue);
        }
    }
}

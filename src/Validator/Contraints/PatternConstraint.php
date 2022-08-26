<?php

declare(strict_types=1);

namespace POCValidator\Validator\Contraints;

use POCValidator\Validator\Entities\Exception\FieldPatternException;

final class PatternConstraint implements Constraints
{

    public function support(string $constraint): bool
    {
        return 'pattern' === $constraint;
    }

    /**
     * @inheritDoc
     */
    public function validate(string $constraint, $constraintValue, $propertyPath, $value)
    {
        if (!preg_match($constraintValue, $value)) {
            return sprintf(FieldPatternException::MESSAGE, $propertyPath);
        }
    }
}

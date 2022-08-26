<?php

declare(strict_types=1);

namespace POCValidator\Validator\Contraints;

final class PropertyConstraint
{
    private iterable $validators;

    public function __construct(iterable $validators)
    {
        $this->validators = $validators;
    }

    /**
     * @param string|int|string[] $value
     * @param string|int|string[] $constraintValue
     *
     * @return array|void
     */
    public function validate(string $constraint, $constraintValue, string $propertyPath, $value)
    {
        foreach ($this->validators as $validator) {
            if ($validator->support($constraint)) {
                return $validator->validate($constraint, $constraintValue, $propertyPath, $value);
            }
        }
    }
}

<?php

declare(strict_types=1);

namespace POCValidator\Validator\Entities\Exception;

final class FieldPatternException extends EntitiesDomainException
{
    public const MESSAGE = 'the %s field is invalid.';

    public function __construct(string $field, \Throwable $previousException = null)
    {
        parent::__construct(
            sprintf(self::MESSAGE, $field),
            self::INVALID_PATTERN,
            $previousException
        );
    }
}

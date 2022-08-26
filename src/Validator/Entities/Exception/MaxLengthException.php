<?php

namespace POCValidator\Validator\Entities\Exception;

final class MaxLengthException extends EntitiesDomainException
{
    public const MESSAGE = 'the %s field must not exceed %d characters.';

    public function __construct(STRING $field, int $length, \Throwable $previousException = null)
    {
        parent::__construct(
            sprintf(self::MESSAGE, $field, $length),
            self::INVALID_LENGTH,
            $previousException
        );
    }
}

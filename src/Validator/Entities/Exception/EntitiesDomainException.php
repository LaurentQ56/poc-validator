<?php

namespace POCValidator\Validator\Entities\Exception;

abstract class EntitiesDomainException extends \DomainException
{
    public const INVALID_LENGTH = 1500;
    public const INVALID_PATTERN = 1501;

    public function __construct($message = "", $code = 0, \Throwable $previousException = null)
    {
        parent::__construct($message, $code, $previousException);
    }
}

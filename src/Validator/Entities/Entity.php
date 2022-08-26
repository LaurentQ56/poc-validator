<?php

declare(strict_types=1);

namespace POCValidator\Validator\Entities;

final class Entity
{
    private string $name;
    private string $streetNumber;
    private string $postalCode;

    /**
     * @param string $name
     * @param string $streetNumber
     * @param string $postalCode
     */
    private function __construct(string $name, string $streetNumber, string $postalCode)
    {
        $this->name = $name;
        $this->streetNumber = $streetNumber;
        $this->postalCode = $postalCode;
    }

    public static function create(string $name, string $streetNumber, string $postalCode): self
    {
        return new self($name, $streetNumber, $postalCode);
    }

    public function name(): string
    {
        return $this->name;
    }

    public function streetNumber(): string
    {
        return $this->streetNumber;
    }

    public function postalCode(): string
    {
        return $this->postalCode;
    }
}

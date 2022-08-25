<?php

declare(strict_types=1);

namespace Tests\Unit\Validator\UseCases\CreateEntity;

use POCIterator\Validator\UseCases\CreateEntity\CreateEntityRequest;

final class FakeCreateEntityRequest implements CreateEntityRequest
{
    private string $name;
    private string $streetNumber;
    private string $postalCode;

    public function __construct(
        string $name,
        string $streetNumber,
        string $postalCode
    ) {

        $this->name = $name;
        $this->streetNumber = $streetNumber;
        $this->postalCode = $postalCode;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function streetNumber(): string
    {
        return $this->streetNumber;
    }

    public function setStreetNumber(string $streetNumber): void
    {
        $this->streetNumber = $streetNumber;
    }

    public function postalCode(): string
    {
        return $this->postalCode;
    }

    public function setPostalCode(string $postalCode): void
    {
        $this->postalCode = $postalCode;
    }
}

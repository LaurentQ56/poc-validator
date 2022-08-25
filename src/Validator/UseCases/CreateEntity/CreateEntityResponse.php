<?php

declare(strict_types=1);

namespace POCIterator\Validator\UseCases\CreateEntity;

use POCIterator\Validator\Entities\Entity;

final class CreateEntityResponse
{
    private string $name;
    private string $streetNumber;
    private string $postalCode;

    public function __construct(Entity $entity)
    {
        $this->name = $entity->name();
        $this->streetNumber = $entity->streetNumber();
        $this->postalCode = $entity->postalCode();
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

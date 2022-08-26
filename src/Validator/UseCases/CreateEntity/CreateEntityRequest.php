<?php

declare(strict_types=1);

namespace POCValidator\Validator\UseCases\CreateEntity;

interface CreateEntityRequest
{
    public function name(): string;

    public function streetNumber(): string;

    public function postalCode(): string;
}

<?php

declare(strict_types=1);

namespace POCValidator\Validator\UseCases\CreateEntity;

interface CreateEntityPresenter
{
    public function present(CreateEntityResponse $createEntityResponse): void;

    public function addError(array $exception): void;

    public function getError(): array;
}

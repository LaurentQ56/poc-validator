<?php

declare(strict_types=1);

namespace POCIterator\Validator\UseCases\CreateEntity;

interface CreateEntityPresenter
{
    public function present(CreateEntityResponse $createEntityResponse): void;

    public function addError(\Throwable $exception): void;

    public function getError(): \Throwable;
}

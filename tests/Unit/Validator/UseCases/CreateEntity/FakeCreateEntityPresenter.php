<?php

declare(strict_types=1);

namespace Tests\Unit\Validator\UseCases\CreateEntity;

use POCIterator\Validator\UseCases\CreateEntity\CreateEntityPresenter;
use POCIterator\Validator\UseCases\CreateEntity\CreateEntityResponse;

final class FakeCreateEntityPresenter implements CreateEntityPresenter
{
    private CreateEntityResponse $response;
    private \Throwable $errorException;

    public function present(CreateEntityResponse $createEntityResponse): void
    {
        $this->response = $createEntityResponse;
    }

    public function response(): CreateEntityResponse
    {
        return $this->response;
    }

    public function addError(\Throwable $exception): void
    {
        $this->errorException = $exception;
    }

    public function getError(): \Throwable
    {
        return $this->errorException;
    }
}

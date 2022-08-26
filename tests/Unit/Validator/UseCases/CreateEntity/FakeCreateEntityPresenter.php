<?php

declare(strict_types=1);

namespace Tests\Unit\Validator\UseCases\CreateEntity;

use POCValidator\Validator\UseCases\CreateEntity\CreateEntityPresenter;
use POCValidator\Validator\UseCases\CreateEntity\CreateEntityResponse;

final class FakeCreateEntityPresenter implements CreateEntityPresenter
{
    private CreateEntityResponse $response;
    private array $errorException = [];

    public function present(CreateEntityResponse $createEntityResponse): void
    {
        $this->response = $createEntityResponse;
    }

    /**
     * @return CreateEntityResponse|array
     */
    public function response()
    {
        if (!empty($this->errorException )) {
            return $this->getError();
        }

        return $this->response;
    }

    public function addError(array $exception): void
    {
        $this->errorException = $exception;
    }

    public function getError(): array
    {
        return $this->errorException;
    }
}

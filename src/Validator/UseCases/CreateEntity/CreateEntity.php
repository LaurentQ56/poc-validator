<?php

declare(strict_types=1);

namespace POCIterator\Validator\UseCases\CreateEntity;

use POCIterator\Validator\Entities\Entity;
use POCIterator\Validator\EntityValidator;

final class CreateEntity
{
    private EntityValidator $entityValidator;

    public function __construct(EntityValidator $entityValidator)
    {
        $this->entityValidator = $entityValidator;
    }

    public function execute(
        CreateEntityRequest   $createEntityRequest,
        CreateEntityPresenter $createEntityPresenter
    ): void
    {
        try {
            $entity = Entity::create(
                $createEntityRequest->name(),
                $createEntityRequest->streetNumber(),
                $createEntityRequest->postalCode()
            );

            $this->entityValidator->validate($entity);
        } catch (\Exception $exception) {
            $createEntityPresenter->addError($exception);
        }
    }
}

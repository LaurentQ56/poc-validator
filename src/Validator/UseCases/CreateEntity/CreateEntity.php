<?php

declare(strict_types=1);

namespace POCValidator\Validator\UseCases\CreateEntity;

use POCValidator\Validator\Entities\Entity;
use POCValidator\Validator\EntityValidator;

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
        $entity = Entity::create(
            $createEntityRequest->name(),
            $createEntityRequest->streetNumber(),
            $createEntityRequest->postalCode()
        );

        $errors = $this->entityValidator->validate($entity);

        if (!empty($errors)) {
            $createEntityPresenter->addError($errors);
        }
        $createEntityPresenter->present(new CreateEntityResponse($entity));
    }
}

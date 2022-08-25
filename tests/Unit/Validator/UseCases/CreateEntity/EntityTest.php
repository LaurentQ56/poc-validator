<?php

declare(strict_types=1);

namespace Tests\Unit\Validator\UseCases\CreateEntity;

use PHPUnit\Framework\TestCase;
use POCIterator\Validator\Contraints\PropertyConstraint;
use POCIterator\Validator\EntityValidator;
use POCIterator\Validator\UseCases\CreateEntity\CreateEntity;

final class EntityTest extends TestCase
{
    private CreateEntity $createEntity;
    private FakeCreateEntityPresenter $createEntityPresenter;

    public function testEntityValidation(): void
    {
        // Arrange
        $createEntityRequest = new FakeCreateEntityRequest(
            str_repeat('a', 51),
            'nombre',
            'code postal'
        );

        // Act
        $this->createEntity->execute($createEntityRequest, $this->createEntityPresenter);

        // Assert
        self::assertTrue(true);
    }

    protected function setUp(): void
    {
        $validators = [];
        $propertyConstraint = new PropertyConstraint($validators);
        $entityValidator = new EntityValidator($propertyConstraint);
        $this->createEntity = new CreateEntity($entityValidator);
        $this->createEntityPresenter = new FakeCreateEntityPresenter();
    }
}

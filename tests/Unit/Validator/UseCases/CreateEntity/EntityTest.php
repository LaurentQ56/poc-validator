<?php

declare(strict_types=1);

namespace Tests\Unit\Validator\UseCases\CreateEntity;

use PHPUnit\Framework\TestCase;
use POCValidator\Validator\Contraints\MaxLengthConstraint;
use POCValidator\Validator\Contraints\PatternConstraint;
use POCValidator\Validator\Contraints\PropertyConstraint;
use POCValidator\Validator\EntityValidator;
use POCValidator\Validator\UseCases\CreateEntity\CreateEntity;

final class EntityTest extends TestCase
{
    private CreateEntity $createEntity;
    private FakeCreateEntityPresenter $createEntityPresenter;

    public function testEntityValidationSuccess(): void
    {
        // Arrange
        $createEntityRequest = new FakeCreateEntityRequest(
            'Name requested',
            '65',
            '45000'
        );

        // Act
        $this->createEntity->execute($createEntityRequest, $this->createEntityPresenter);
        $response = $this->createEntityPresenter->response();

        // Assert
        self::assertSame('Name requested', $response->name());
        self::assertSame('65', $response->streetNumber());
        self::assertSame('45000', $response->postalCode());
    }

    public function testEntityValidationFailWithTooLongName(): void
    {
        // Arrange
        $createEntityRequest = new FakeCreateEntityRequest(
            str_repeat('a', 51),
            '65',
            '45000'
        );

        // Act
        $this->createEntity->execute($createEntityRequest, $this->createEntityPresenter);
        $response = $this->createEntityPresenter->response();

        // Assert
        self::assertSame('the name field must not exceed 50 characters.', $response[0]);
    }

    public function testEntityValidationFailWithInvalidStreetNumber(): void
    {
        // Arrange
        $createEntityRequest = new FakeCreateEntityRequest(
            'Name requested',
            'soixante cinq',
            '45000'
        );

        // Act
        $this->createEntity->execute($createEntityRequest, $this->createEntityPresenter);
        $response = $this->createEntityPresenter->response();

        // Assert
        self::assertSame('the streetNumber field is invalid.', $response[0]);
    }

    public function testEntityValidationFailWithInvalidPostalCode(): void
    {
        // Arrange
        $createEntityRequest = new FakeCreateEntityRequest(
            'Name requested',
            '65',
            'Loiret'
        );

        // Act
        $this->createEntity->execute($createEntityRequest, $this->createEntityPresenter);
        $response = $this->createEntityPresenter->response();

        // Assert
        self::assertSame('the postalCode field must not exceed 5 characters.', $response[0]);
    }

    public function testEntityValidationFailWithMultipleErrors(): void
    {
        // Arrange
        $createEntityRequest = new FakeCreateEntityRequest(
            str_repeat('a', 51),
            'soixante cinq',
            'Loiret'
        );

        // Act
        $this->createEntity->execute($createEntityRequest, $this->createEntityPresenter);
        $response = $this->createEntityPresenter->response();

        // Assert
        self::assertSame('the name field must not exceed 50 characters.', $response[0]);
        self::assertSame('the streetNumber field is invalid.', $response[1]);
        self::assertSame('the postalCode field must not exceed 5 characters.', $response[2]);
    }

    protected function setUp(): void
    {
        $validators = [
            new MaxLengthConstraint(),
            new PatternConstraint(),
        ];
        $propertyConstraint = new PropertyConstraint($validators);
        $entityValidator = new EntityValidator($propertyConstraint);
        $this->createEntity = new CreateEntity($entityValidator);
        $this->createEntityPresenter = new FakeCreateEntityPresenter();
    }
}

<?php

declare(strict_types=1);

namespace POCValidator\Validator;

use POCValidator\Validator\Contraints\PropertyConstraint;

final class EntityValidator implements Validator
{
    private PropertyConstraint $propertyConstraint;

    public function __construct(PropertyConstraint $propertyConstraint)
    {
        $this->propertyConstraint = $propertyConstraint;
    }

    public function validate(object $entity): array
    {
        $errors = [];
        $namespace = get_class($entity);
        $filename = ucfirst(array_reverse(explode('\\', $namespace))[0]);
        $constraintsConfig = $this->parseData($namespace, $filename);

        foreach ($constraintsConfig['properties'] as $property) {
            $propertyPath = $property['name'];
            $constraints = $property['constraints'];
            foreach ($constraints as $constraint) {
                $error = $this->propertyConstraint->validate($constraint['name'], $constraint['value'], $propertyPath, $entity->$propertyPath());

                if (!empty($error)) {
                    $errors[] = $error;
                }
            }
        }

        return $errors;
    }

    private function parseData(string $namespace, string $filename): array
    {
        $data = $this->getFileData($filename);

        if (strpos($data [0], $namespace) !== 0) {
            throw new \RuntimeException('config file error');
        }

        unset($data[0]);

        if (strpos($data [1], 'properties') !== 2) {
            throw new \RuntimeException('config file error');
        }
        $validationConstraints = [];
        $key = 0;

        unset($data[1]);
        foreach ($data as $datum) {
            preg_match('/^\s{4}([a-zA-Z]+):$/', $datum, $property);
            if (!empty($property)) {
                $validationConstraints['properties'][$key] = ['name' => $property[1]];
                $key++;
            }

            preg_match('/^\s{6}-\s([\w]+):\s(.+)$/', $datum, $constraint);
            if (!empty($constraint)) {
                $validationConstraints['properties'][$key - 1]['constraints'][] =
                    ['name' => $constraint[1], 'value' => $constraint[2]];
            }
        }


        return $validationConstraints;
    }

    private function getFileData(string $filename): array
    {
        $dir = dirname(__DIR__);

        $fileToParse = sprintf('%s/config/%s.yaml', $dir, $filename);

        return explode("\n", \file_get_contents($fileToParse, true));
    }
}

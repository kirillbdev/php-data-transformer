<?php

namespace kirillbdev\PhpDataTransfer\Attributes;

use kirillbdev\PhpDataTransfer\Contracts\DataObjectInterface;
use kirillbdev\PhpDataTransfer\Contracts\PropertyAttributeInterface;

class CastAttribute implements PropertyAttributeInterface
{
    /**
     * @var string
     */
    private $castType;

    public function __construct(string $castType)
    {
        $this->castType = $castType;
    }

    public function applyTo(object $dto, DataObjectInterface $dataObject, \ReflectionProperty $property)
    {
        $value = $dto->{$property->name};

        switch ($this->castType) {
            case 'int':
                $dto->{$property->name} = (int)$value;
                break;
            case 'float':
                $dto->{$property->name} = (float)$value;
                break;
            case 'bool':
                $dto->{$property->name} = (bool)$value;
                break;
        }
    }
}
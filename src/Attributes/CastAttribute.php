<?php

namespace kirillbdev\PhpDataTransformer\Attributes;

use kirillbdev\PhpDataTransformer\Contracts\DataObjectInterface;
use kirillbdev\PhpDataTransformer\Contracts\PropertyAttributeInterface;

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

    public function applyTo(object $obj, DataObjectInterface $dataObject, \ReflectionProperty $property)
    {
        $value = $obj->{$property->name};

        switch ($this->castType) {
            case 'int':
                $obj->{$property->name} = (int)$value;
                break;
            case 'float':
                $obj->{$property->name} = (float)$value;
                break;
            case 'bool':
                $obj->{$property->name} = (bool)$value;
                break;
        }
    }
}
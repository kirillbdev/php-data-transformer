<?php

namespace kirillbdev\PhpDataTransformer\Attributes;

use kirillbdev\PhpDataTransformer\Contracts\DataObjectInterface;
use kirillbdev\PhpDataTransformer\Contracts\PropertyAttributeInterface;
use kirillbdev\PhpDataTransformer\DataObject\ArrayDataObject;
use kirillbdev\PhpDataTransformer\DataTransformer;

class ObjectCastAttribute implements PropertyAttributeInterface
{
    /**
     * @var string
     */
    private $className;

    public function __construct(string $className)
    {
        $this->className = $className;
    }

    public function applyTo(object $obj, DataObjectInterface $dataObject, \ReflectionProperty $property)
    {
        $obj->{$property->name} = DataTransformer::transform(
            $this->className,
            new ArrayDataObject($obj->{$property->name})
        );
    }
}
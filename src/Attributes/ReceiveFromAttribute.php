<?php

namespace kirillbdev\PhpDataTransformer\Attributes;

use kirillbdev\PhpDataTransformer\Contracts\DataObjectInterface;
use kirillbdev\PhpDataTransformer\Contracts\PropertyAttributeInterface;

class ReceiveFromAttribute implements PropertyAttributeInterface
{
    /**
     * @var string
     */
    private $fromKey;

    public function __construct(string $fromKey)
    {
        $this->fromKey = $fromKey;
    }

    public function applyTo(object $obj, DataObjectInterface $dataObject, \ReflectionProperty $property)
    {
        $obj->{$property->name} = $dataObject->get($this->fromKey);
    }
}